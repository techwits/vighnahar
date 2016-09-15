<?php
$error_msg="";
$CurrentDate = date('Y-m-d h:i:s');
$StartDate=date("Y-m-d")." 00:00:00";
$EndDate=date("Y-m-d")." 23:59:59";

$searchvalue="";
$searchin=1;
if(isset($_REQUEST["searchvalue"])) {
    ?>
    <!-- Theme JS files -->
        <script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
    <!-- /theme JS files -->
    <?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');

    $searchvalue = sanitize($con, $_REQUEST["searchvalue"]);
    $searchin = sanitize($con, $_REQUEST["searchin"]);
}

if (strlen($searchvalue)==0){
    $searchvalue="";
    $searchin=1;
    $TableHeading="Last Top 5 Records..";
}
else{
    $TableHeading=$searchvalue." Results..";
}

$columnname="";
$pre_wildcharacter="";
$post_wildcharacter="";
if ($searchin==1){
    $columnname="oid =";
    $pre_wildcharacter="";
    $post_wildcharacter="";
}
//    elseif ($searchin==2){
//        $columnname="Telephone like";
//        $pre_wildcharacter="%";
//        $post_wildcharacter="%";
//    }
//    echo ("CurrentDate:- ".$CurrentDate."</br>");
//    echo ("searchvalue:- ".$searchvalue."</br>");
//    die();
?>



<div>
    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>RM Date</th>
            <th>RM No</th>
            <th>Vehicle No.</th>
            <th>Driver</th>
            <th>LR Count</th>
            <th>Packages</th>
        </tr>
        </thead>
        <tbody>
    
    
        <?php
        $cols=" oid, CreationDate, ModificationDate, Creator, ip, TransitDate, fyid, vmid, tmid, Active ";
    
        $sqlQry= "select $cols from `outward` where 1=1";
        if(strlen(trim($searchvalue))>0) {
            $sqlQry .= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        }
        else{
            $sqlQry.= " and (TransitDate  BETWEEN  '$StartDate' AND '$EndDate')";
        }
        $sqlQry.= " and Active=1";
        $sqlQry.= " order by oid desc";
//        echo ("Check sqlQry :- $sqlQry </br>");
    //    die();
        //        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                    $oid=$row[0];
                    $CreationDate=$row[1];
                    $CreationDate=substr($CreationDate,0,strpos($CreationDate," "));
                    $ModificationDate=$row[2];
                    $Creator=$row[3];
                    $ip=$row[4];
                    $TransitDate=$row[5];
                    $fyid=$row[6];
                    $vmid=$row[7];
                    $tmid=$row[8];
                    $Active=$row[9];
    
                    $TransitDate = implode("/", array_reverse(explode("-", $TransitDate)));
    //                echo("TransitDate :- $TransitDate </br>");
    
                    $FinancialYear=Get_FinancialYearOnID($con, $fyid);
    //                echo("FinancialYear :- $FinancialYear </br>");
    
                    $VehicleNumber=Get_VehicleNumber($con, $vmid);
    //                echo("VehicleNumber :- $VehicleNumber </br>");
    
                    $TransporterName=Get_TransporterName($con, $tmid);
    //                echo("TransporterName :- $TransporterName </br>");

                    $RoadMemoLR="";
                    $RoadMemoLR=Get_RoadMemoLR($con, $oid);

                    $RoadMemoLRCount=0;
                    $RoadMemoLRCount=Get_RoadMemoLRCount($con, $oid);
    //                echo("RoadMemoLR :- $RoadMemoLR </br>");

                    $RoadMemoLRPackageCount=0;
                    $RoadMemoLRPackageCount=Get_RoadMemoLRPackageCount($con, $oid);
                    
                    ?>
                        <tr>
                            <td><?php echo $TransitDate; ?></td>
                            <td><a href="#" onclick="return editrmentry(<?php echo $oid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $TransitDate; ?>', '<?php echo $fyid; ?>', '<?php echo $vmid; ?>', '<?php echo $tmid; ?>', '<?php echo $Active; ?>', '<?php echo $TransitDate; ?>', '<?php echo $FinancialYear; ?>', '<?php echo $VehicleNumber; ?>', '<?php echo $TransporterName; ?>', '<?php echo $RoadMemoLR; ?>');"><?php echo $oid; ?></a> </td>
                            <td><?php echo $VehicleNumber; ?></td>
                            <td><?php echo $TransporterName; ?></td>
                            <td><?php echo $RoadMemoLRCount; ?></td>
                            <td><?php echo $RoadMemoLRPackageCount; ?></td>
                        </tr>
                    <?php

                }

            }
        ?>
        </tbody>
    </table>
</div>