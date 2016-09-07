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

    $sqlQry.= " and bill.oid = $RMID";

    $sqlQry.= " and `bill`.Active=1";
    $sqlQry.= " and `billlr`.Active=1";
    $sqlQry.= " and `outwardlr`.Active=1";

    echo ("Check sqlQry :- $sqlQry </br>");
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
            $inc==1?$LRID_List=$row[10]:$LRID_List=$LRID_List.",".$row[10];
        }
    }

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
                                <h6 class="text-semibold">Road Memo No.</h6>
                                <div class="input-group">
                                    <?php echo $oid; ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group form-group-material">
                                <h6 class="text-semibold">RM Date</h6>
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
                                <th>LRNumber</th>
                                <th>Consignor Name</th>
                                <th>Consignee Name</th>
                                <th>Destination</th>
                                <th>Cases</th>
                                <th>Bill</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                                $j=0;
                                $Split_LIList = explode(",", $LRID_List);
                                foreach ($Split_LIList as $SingleLR)
                                {
                                    $j=$j+1;
                                    $ConsignorName=Get_ConsignorNameOnLRID($con, $SingleLR);
                                    $ConsigneeName=Get_ConsigneeNameOnLRID($con, $SingleLR);
                                    $ConsigneeArea=Get_ConsigneeAreaOnLRID($con, $SingleLR);
                                    $LR_RateQuantity=Get_LRRate_LRQuantityCount($con, $SingleLR);
                                    $Split_RateQuantity = explode(",", $LR_RateQuantity);
                                    $Rate=$Split_RateQuantity[0];
                                    $Quantity=$Split_RateQuantity[1];

                                    $BillStat="";
                                    $BillStatus=Get_BillStatusOnLRID($con, $SingleLR);
//                                    echo("BillStatus :- $BillStatus </br>");
                                    $BillStatus==0?$BillStat="No":$BillStat="Yes";

                             ?>
                                    <tr>
                                        <td><?php echo $j; ?></td>
                                        <td><?php echo $SingleLR; ?></td>
                                        <td><?php echo $ConsignorName; ?></td>
                                        <td><?php echo $ConsigneeName; ?></td>
                                        <td><?php echo $ConsigneeArea; ?></td>
                                        <td><?php echo $Quantity; ?></td>
                                        <td><?php echo $BillStat; ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>

                            </tbody>
                        </table>

                    </div>
            </div>





            <div class="modal-footer">
                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
        </div>
    </div>
</div><!-- /.modal-dialog -->

