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
        $columnname="ConsigneeName like";
        $pre_wildcharacter="";
        $post_wildcharacter="%";
    }
    elseif ($searchin==2){
        $columnname="Telephone like";
        $pre_wildcharacter="%";
        $post_wildcharacter="%";
    }
//        echo ("searchin:- ".$searchin."</br>");
//        echo ("searchvalue:- ".$searchvalue."</br>");
    //    die();
?>




<!-- Single row selection -->

    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Consignee Name</th>
            <th>Area</th>
        </tr>
        </thead>
        <tbody>


        <?php
       $cols="`consignee_master`.`cnid`, `consignee_master`.`ConsigneeName`, `consignee_master`.`Website`, ";
       $cols.="`consigneeaddress_master`.`cnaid`, `consigneeaddress_master`.`Address`, `consigneeaddress_master`.`Pincode`, `consigneeaddress_master`.`City`, `consigneeaddress_master`.`Telephone`, `consigneeaddress_master`.`Email`, `consigneeaddress_master`.`amid`";
        $cols.=" , `area_master`.`AreaName`, `consignee_master`.`caid`, `consignor_master`.`ConsignorName`";

        $sqlQry= " select $cols from `consignee_master` ";
        $sqlQry.= " inner join `consigneeaddress_master`";
        $sqlQry.= " on `consignee_master`.`cnid`=`consigneeaddress_master`.`cnid`";

        $sqlQry.= " inner join `consignoraddress_master`";
        $sqlQry.= " on `consignee_master`.`caid`=`consignoraddress_master`.`caid`";

        $sqlQry.= " inner join `consignor_master`";
        $sqlQry.= " on `consignoraddress_master`.`cid`=`consignor_master`.`cid`";

        $sqlQry.=" left join `area_master`";
        $sqlQry.=" on `consigneeaddress_master`.`amid`=`area_master`.`amid`";

        $sqlQry.= " where 1=1";
        if ($searchin==1) {
            $sqlQry.= " and consignee_master.ConsigneeName like '$searchvalue%'";
        }
        elseif ($searchin==2) {
            $sqlQry.= " and consignor_master.ConsignorName like '$searchvalue%'";
        }
        elseif ($searchin==3) {
            $sqlQry.= " and area_master.AreaName like '$searchvalue%'";
        }
        $sqlQry.= " and `consignee_master`.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                $cnid=$row[0];
                $ConsigneeName=$row[1];
                $Website=$row[2];
                $cnaid=$row[3];
                $Address=$row[4];
                $Pincode=$row[5];
                $City=$row[6];
                $Telephone=$row[7];
                $Email=$row[8];
                $amid=$row[9];
                $AreaName=$row[10];
                $ConsignorID=$row[11];
                $ConsignorName=$row[12];
                ?>

                <tr>
                    <td><a href="#" onclick="return editconsignee(<?php echo $cnid; ?>, '<?php echo $ConsigneeName; ?>', '<?php echo $Website; ?>', '<?php echo $cnaid; ?>', '<?php echo $Address; ?>', '<?php echo $Pincode; ?>', '<?php echo $City; ?>', '<?php echo $Telephone; ?>', '<?php echo $Email; ?>', '<?php echo $amid; ?>', '<?php echo $AreaName; ?>', '<?php echo $ConsignorID; ?>', '<?php echo $ConsignorName; ?>');"><?php echo $ConsigneeName; ?></a> </td>
                    <td><?php echo $AreaName; ?></td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>

<!-- /single row selection -->