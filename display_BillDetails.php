<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api.js"></script>
<!-- /theme JS files -->

<?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
?>

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $BillID = $_GET['BillID'];
//    echo("BillID :- $BillID </br>");
//    die();

    $cols="";
    $cols.=" bill.bid, bill.CreationDate, bill.ModificationDate, bill.Creator, bill.ip, bill.fyid, bill.BillingDate, bill.caid, bill.Amount, bill.Discount, bill.ServiceTax, bill.BillAmount, bill.Active";
    $cols.=" , billlr.olrid";
    $cols.=" , outwardlr.iid";

    $sqlQry= "select $cols from `bill`";

    $sqlQry.= "inner join `billlr`";
    $sqlQry.= "on `bill`.`bid` = `billlr`.`bid`";

    $sqlQry.= "inner join `outwardlr`";
    $sqlQry.= "on `billlr`.`olrid` = `outwardlr`.`olrid`";

    $sqlQry.= " where 1=1";

    $sqlQry.= " and bill.bid = $BillID";

    $sqlQry.= " and `bill`.Active=1";
    $sqlQry.= " and `billlr`.Active=1";
    $sqlQry.= " and `outwardlr`.Active=1";

//    echo ("Check sqlQry :- $sqlQry </br>");
//    die();


    unset($con);
    include('assets/inc/db_connect.php');
    $result = mysqli_query($con, $sqlQry);
    if (mysqli_num_rows($result)!=0)
    {
        $inc=0;
        $LRID_List="";
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            $bid=$row[0];
            $CreationDate=$row[1];
            $ModificationDate=$row[2];
            $Creator=$row[3];
            $ip=$row[4];
            $fyid=$row[5];
            $BillingDate=$row[6];
            $caid=$row[7];
            $Amount=$row[8];
            $Discount=$row[9];
            $ServiceTax=$row[10];
            $BillAmount=$row[11];
            $Active=$row[12];

            $olrid=$row[13];
            $LRID=$row[14];

            $inc=$inc+1;
            $inc==1?$LRID_List=$row[14]:$LRID_List=$LRID_List.",".$row[14];
        }
        $ConsignorName=Get_ConsignorNameOnLRID($con, $caid);
        $ConsignorAddress=Get_ConsignorAddressOnLRID($con, $caid);
//    echo("ConsignorAddress :- $ConsignorAddress </br>");
        $Split_Address = explode("||" , $ConsignorAddress);
    }
    else{
        echo("Bill No. does not exit. Please check......");
        die();
    }


//    echo("LRID_List :- $LRID_List </br>");

?>

<!-- Modal -->
<div class="modal-dialog">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><i class="icon-menu7"></i> Bill No. - <?php echo $bid; ?></h5>
            </div>

            <div class="modal-body">
                <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-group-material">
                                <h6 class="text-semibold">Consignor Name</h6>
                                <div class="input-group">
                                    <?php echo $ConsignorName; ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group form-group-material">
                                <h6 class="text-semibold">Address</h6>
                                <div class="input-group">
                                    <?php echo $Split_Address[0]." - ".  $Split_Address[1]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group form-group-material">
                                <h6 class="text-semibold">Bill Date</h6>
                                <div class="input-group">
                                    <?php echo $BillingDate; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-body">
                    <div class="row">
                        <table class="table datatable-selection-single">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>LR No</th>
                                <th>LR Date</th>
                                <th>Invoice No</th>
                                <th>Consignor Name</th>
                                <th>Consignee Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
                                $Total_LRBillAmount=0;
                                $j=0;
                                $Split_LIList = explode(",", $LRID_List);
                                foreach ($Split_LIList as $SingleLR)
                                {
                                    $LRDetails=Get_LRDetails($con, $SingleLR);
                                    $Split_LRDetails = explode("|/|~|/|", $LRDetails);
                                    // 0 FinancialYear
                                    // 1 ReceivedDate
                                    // 2 InvoiceNumber
                                    // 3 VehicleNumber
                                    // 4 Address
                                    // 5 AreaName
                                    // 6 Pincode
                                    // 7 City
                                    // 8 ConsignorName
                                    // 9 Pancard
                                    // 10 ConsigneeName
                                    // 11 Address
                                    // 12 AreaName
                                    // 13 Pincode
                                    // 14 City
                                    // 15 ProductName
                                    // 16 PakageType
                                    // 17 Rate
                                    // 18 Quantity
                                    // 19 Amount
                                    // 20 Active

//                                    echo("LRDetails :- $Split_LRDetails[19] </br>");
//                                    die();
                                    $j=$j+1;
                                    $LRBillAmount=Get_LRBillAmount($con, $SingleLR);
//                                    echo("LRBillAmount :- $LRBillAmount </br>");

                                    $Total_LRBillAmount=$Total_LRBillAmount+$LRBillAmount;

                             ?>

                                    <tr>
                                        <td><?php echo $j; ?></td>
                                        <td><?php echo $SingleLR; ?></td>
                                        <td><?php echo $Split_LRDetails[1]; ?></td>
                                        <td><?php echo $Split_LRDetails[2]; ?></td>
                                        <td><?php echo $Split_LRDetails[8]; ?></td>
                                        <td><?php echo $Split_LRDetails[10]; ?></td>
                                        <td><?php echo $Split_LRDetails[15]; ?></td>
                                        <td><?php echo $Split_LRDetails[18]; ?></td>
                                        <td><?php echo $LRBillAmount; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>

                        <div class="modal-body">
                            <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-material">
                                            <h6 class="text-semibold">Amount</h6>
                                            <div class="input-group">
                                                <?php echo $Amount; ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group form-group-material">
                                            <h6 class="text-semibold">Service tax</h6>
                                            <div class="input-group">
                                                <?php echo $ServiceTax; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group form-group-material">
                                            <h6 class="text-semibold">Bill Amount</h6>
                                            <div class="input-group">
                                                <?php echo $BillAmount; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
            </div>





            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
        </div>
    </div>
</div><!-- /.modal-dialog -->

