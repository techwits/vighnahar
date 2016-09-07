
<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
        ?>
            <!-- Theme JS files -->
                <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
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

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Lorry Receipt</h5>
    </div>

    <table class="table datatable-scroll-y" width="100%">
        <thead>
        <tr>
            <th>LR Number</th>
            <th>Financial Year</th>
            <th>LR Date</th>
            <th>Invoice No.</th>
            <th>Truck Number</th>
            <th>Consignor</th>
            <th>Consignee</th>
            <th>Product</th>
            <th>Package Type</th>
            <th>Rate</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>


            <?php
                $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
                $cols.=" , `vehicle_master`.`VehicleNumber`";
                $cols.=" , `consignor_master`.`ConsignorName`";
                $cols.=" , `consignee_master`.`ConsigneeName`";
                $cols.=" , `product_master`.`ProductName`";
                $cols.=" , `inward`.fyid, `inward`.Rate, `inward`.Quantity";



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
                    $sqlQry.= " and $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
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
                            $TransitDate=$row[1];
                            $InvoiceNo=$row[2];
                            $PakageType=$row[3];
                            $Amount=$row[4];
                            $VehicleNumber=$row[5];
                            $ConsignorName=$row[6];
                            $ConsigneeName=$row[7];
                            $ProductName=$row[8];

                            $FinancialYear=$row[9];
                            $Rate=$row[10];
                            $Quantity=$row[11];

                            $LRIDExist_ForRM=Check_LRIDExist_ForRM($con, $lrid);
//                            echo("$lrid) LRIDExist_ForRM :- $LRIDExist_ForRM </br>");
                        ?>

                        <tr>
                            <td><a href="#" onclick="return editlrentry(<?php echo $lrid; ?>, <?php echo $LRIDExist_ForRM; ?>);"><?php echo $lrid; ?></a> </td>
                            <td><?php echo $FinancialYear; ?></td>
                            <td><?php echo $TransitDate; ?></td>
                            <td><?php echo $InvoiceNo; ?></td>

                            <td><?php echo $VehicleNumber; ?></td>
                            <td><?php echo $ConsignorName; ?></td>
                            <td><?php echo $ConsigneeName; ?></td>
                            <td><?php echo $ProductName; ?></td>

                            <td><?php echo $PakageType; ?></td>
                            <td><?php echo $Rate; ?></td>
                            <td><?php echo $Quantity; ?></td>

                            <td><?php echo $Amount; ?></td>
                        </tr>
                        <?php
                    }
                }
            ?>


        </tbody>
    </table>
</div>
<!-- /single row selection -->