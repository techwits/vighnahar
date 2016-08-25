<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
<!-- /theme JS files -->

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
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
        $columnname="ConsignorName like";
        $pre_wildcharacter="";
        $post_wildcharacter="%";
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




<!-- Single row selection -->
    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Name</th>
            <th>Creation date</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols="`consignor_master`.`cid`, `consignor_master`.`ConsignorName`, `consignor_master`.`PanCard`, `consignor_master`.`ServiceTax`, `consignor_master`.`Remark`, ";
        $cols.="`consignoraddress_master`.`caid`, `consignoraddress_master`.`Address`, `consignoraddress_master`.`amid`, `consignoraddress_master`.`Pincode`, `consignoraddress_master`.`City` ";
        $cols.=", `consignor_master`.`CreationDate`";

        $sqlQry= " select $cols from `consignor_master` ";
        $sqlQry.= " inner join `consignoraddress_master`";
        $sqlQry.= " on `consignor_master`.`cid`=`consignoraddress_master`.`cid`";

        $sqlQry.= " where 1=1";
        $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        $sqlQry.= " and `consignor_master`.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();

        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                    $cid=$row[0];
                    $ConsignorName=$row[1];
                    $Pancard=$row[2];
                    $ServiceTax=$row[3];
                    $Remark=$row[4];

                    $caid=$row[5];
                    $Address=$row[6];
                    $amid=$row[7];
                    $Pincode=$row[8];
                    $City=$row[9];
                    $Creationdate=$row[10];
                    $Creationdate=substr($Creationdate,0,strpos($Creationdate," "));

                    $AreaName=Get_AreaName($con, $amid);
//                    echo("AreaName :- $AreaName </br>");

                    $ConsignorTelephone=Get_ConsignorDetails($con, $caid, 1);
                    $Split_Telephone = explode(",", $ConsignorTelephone);
                    $Telephone1=$Split_Telephone[0];
                    $Telephone2=$Split_Telephone[1];
                    $Telephone3=$Split_Telephone[2];

//                    echo("ConsignorTelephone :- $ConsignorTelephone </br>");
//                    echo("ConsignorTelephone1 :- $Telephone1 </br>");
//                    echo("ConsignorTelephone2 :- $Telephone2 </br>");
//                    echo("ConsignorTelephone3 :- $Telephone3 </br>");
//                    die();

                    $ConsignorEmail=Get_ConsignorDetails($con, $caid, 2);
//                    echo("ConsignorEmail :- $ConsignorEmail </br>");

                    $ConsignorWebsite=Get_ConsignorDetails($con, $caid, 3);
//                    echo("ConsignorWebsite :- $ConsignorWebsite </br>");

                    $ConsignorProduct=Get_ConsignorProduct($con, $caid);
//                    echo("ConsignorProduct :- $ConsignorProduct </br>");

                ?>
                <tr>
                    <td><a href="#" onclick="return editconsignee(<?php echo $cid; ?>, '<?php echo $ConsignorName; ?>', '<?php echo $Pancard; ?>', '<?php echo $ServiceTax; ?>', '<?php echo $Remark; ?>', '<?php echo $caid; ?>', '<?php echo $Address; ?>', '<?php echo $amid; ?>', '<?php echo $Pincode; ?>', '<?php echo $City; ?>', '<?php echo $AreaName; ?>', '<?php echo $Telephone1; ?>', '<?php echo $Telephone2; ?>', '<?php echo $Telephone3; ?>', '<?php echo $ConsignorEmail; ?>', '<?php echo $ConsignorWebsite; ?>', '<?php echo $ConsignorProduct; ?>');"><?php echo $ConsignorName; ?></a> </td>
                    <td><?php echo $Creationdate; ?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
<!-- /single row selection -->