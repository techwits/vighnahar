
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
        $columnname="LRID = ";
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




<!-- Single row selection -->


    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>


        <?php
        $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
        $cols.=" , `vehicle_master`.`VehicleNumber`";
        $cols.=" , `consignor_master`.`ConsignorName`";
        $cols.=" , `consignee_master`.`ConsigneeName`";

        $sqlQry= "select $cols from `inward`";

        $sqlQry.= "inner join `vehicle_master`";
        $sqlQry.= "on `inward`.`vmid` = `vehicle_master`.`vmid`";

        $sqlQry.= "inner join `consignoraddress_master`";
        $sqlQry.= "on `inward`.`caid` = `consignoraddress_master`.`caid`";
        $sqlQry.= "inner join `consignor_master`";
        $sqlQry.= "on `consignoraddress_master`.`cid` = `consignor_master`.`cid`";

        $sqlQry.= "inner join `consignee_master`";
        $sqlQry.= "on `inward`.`cnid` = `consignee_master`.`cnid`";

        $sqlQry.= "inner join `product_master`";
        $sqlQry.= "on `inward`.`pmid` = `product_master`.`pmid`";

        $sqlQry.= " where 1=1";

        if($searchvalue!="") {
            $sqlQry.= " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
        }

        $sqlQry.= " and `inward`.Active=1";
//        echo ("Check sqlQry :- $sqlQry </br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $sqlQry);
        if (mysqli_num_rows($result)!=0)
        {
            while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
            {
                    $lrid=$row[0];
                ?>
                <tr>
                    <td><a href="#" onclick="return editlrentry(<?php echo $lrid; ?>);"><?php echo $lrid; ?></a> </td>
                    <td>Sachin</td>
                    <td>12</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                    <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
                                    <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php
            }
        }
        ?>


        </tbody>
    </table>

<!-- /single row selection -->