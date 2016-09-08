<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>
<!-- /theme JS files -->

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $LRID = $_GET['LRID'];
//    echo("LRID :- $LRID </br>");
//    die();


    $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
    $cols.=" , `vehicle_master`.`VehicleNumber`";
    $cols.=" , `consignor_master`.`ConsignorName`";
    $cols.=" , `consignee_master`.`ConsigneeName`";
    $cols.=" , `product_master`.`ProductName`";
    $cols.=" , `inward`.fyid, `inward`.Rate, `inward`.Quantity";
    $cols.=" , `inward`.CreationDate, `inward`.Creator, `inward`.ip, `inward`.vmid, `inward`.caid, `inward`.cnid, `inward`.pmid";
    $cols.=" , `login_master`.UserName";
    $cols.=" , `financialyear_master`.FinancialYear";

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

    $sqlQry.= "inner join `login_master`";
    $sqlQry.= "on `inward`.`Creator` = `login_master`.`loginid`";

    $sqlQry.= "inner join `financialyear_master`";
    $sqlQry.= "on `inward`.`fyid` = `financialyear_master`.`fyid`";


    $sqlQry.= " where 1=1";

    $sqlQry.= " and LRID = $LRID";

    $sqlQry.= " and `inward`.Active=1";


//    echo ("Check sqlQry :- $sqlQry </br>");
//    die();


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

            $fyid=$row[9];
            $Rate=$row[10];
            $Quantity=$row[11];

            $CreationDate=$row[12];
            $Creator=$row[13];
            $ip=$row[14];
            $vmid=$row[15];
            $caid=$row[16];
            $cnid=$row[17];
            $pmid=$row[18];

            $UserName=$row[19];
            $FinancialYear=$row[20];

            ?>

            <!-- Modal -->
            <div class="modal-dialog">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title"><i class="icon-menu7"></i> Lorry Receipt No. - <?php echo $lrid; ?></h5>
                        </div>

                        <div class="modal-body">
                            <div class="alert alert-info alert-styled-left text-blue-800 content-group">
                                Creation Date - <span class="text-semibold"><?php echo $CreationDate; ?></span>  Creator  <span class="text-semibold"><?php echo $UserName; ?></span>
<!--                                <button type="button" class="close" data-dismiss="alert">×</button>-->
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Financial year</h6>
                                        <div class="input-group">
                                            <?php echo $FinancialYear; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">LR Date</h6>
                                        <div class="input-group">
                                            <?php echo $TransitDate; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Invoice Number</h6>
                                        <div class="input-group">
                                            <?php echo $InvoiceNo; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Vehicle Number</h6>
                                        <div class="input-group">
                                            <?php echo $VehicleNumber; ?>
                                        </div>
                                    </div>
                                </div>


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
                                        <h6 class="text-semibold">Consignee Name</h6>
                                        <div class="input-group">
                                            <?php echo $ConsigneeName; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Product Name</h6>
                                        <div class="input-group">
                                            <?php echo $ProductName; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Package Type</h6>
                                        <div class="input-group">
                                            <?php echo $PakageType; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Rate</h6>
                                        <div class="input-group">
                                            <?php echo $Rate; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Quantity</h6>
                                        <div class="input-group">
                                            <?php echo $Quantity; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group form-group-material">
                                        <h6 class="text-semibold">Amount</h6>
                                        <div class="input-group">
                                            <?php echo $Amount; ?>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="col-md-4">-->
<!--                                    <div class="form-group form-group-material">-->
<!--                                        <h6 class="text-semibold">Rate</h6>-->
<!--                                        <div class="input-group">-->
<!--                                            --><?php //echo $Rate; ?>
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>





                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->




            <?php
        }
    }
    else{
        echo("LR No. does not exit. Please check......");
        die();
    }

?>

