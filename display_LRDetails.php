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

            $FinancialYear=$row[9];
            $Rate=$row[10];
            $Quantity=$row[11];
            ?>

            <!-- Modal -->
            <div class="modal-dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h6 class="modal-title">Primary header</h6>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-material">
                                        <label>LR Number</label>
                                        <div class="input-group">
                                            <?php echo $lrid; ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group form-group-material">
                                        <label>LR Date</label>
                                        <div class="input-group">
                                            <?php echo $TransitDate; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-group-material">
                                        <label>Invoice No.</label>
                                        <div class="input-group">
                                            <?php echo $InvoiceNo; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-dialog -->




            <?php
        }
    }

?>


<!-- Primary modal -->
<div id="modal_theme_primary" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Primary header</h6>
            </div>

            <div class="modal-body">
                <h6 class="text-semibold">Text in a modal</h6>
                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>

                <hr>

                <h6 class="text-semibold">Another paragraph</h6>
                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /primary modal -->

