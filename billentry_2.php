<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php

include('assets/inc/db_connect.php');
include('assets/inc/common-function.php');


    if(!isset($_REQUEST["session_userid"])) {
        $UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
        $AccessingPage=basename(__FILE__); //"add_society.php";
        //			echo("UrlPage :- $UrlPage </br>");
        //			echo("AccessingPage :- $AccessingPage </br>");
        if(trim($UrlPage)==trim($AccessingPage)){
            header("Location: /login.php");
        }
    }

    $session_userid = sanitize($con, $_REQUEST["session_userid"]);
    $session_ip = sanitize($con, $_REQUEST["session_ip"]);
    $ConsignorID = sanitize($con, $_REQUEST["ConsignorID"]);
    $LRList=Get_LROnConsignor($con, $ConsignorID);

//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//    echo("ConsignorID :- $ConsignorID </br>");
//    echo("LRList :- $LRList </br>");
//    die();

?>


<!-- Single row selection -->


        <table class="table datatable-scroll-y" width="100%">
            <thead>
            <tr>
                <th>LR Number</th>
                <th>LR Date</th>
                <th>Invoice No</th>
                <th>Consignor</th>
                <th>Product</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $cols=" `inward`.iid, `inward`.CreationDate, `inward`.ModificationDate, `inward`.Creator, `inward`.ip, `inward`.LRID, `inward`.fyid, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.vmid, `inward`.caid, `inward`.cnid, `inward`.pmid, `inward`.PakageType, `inward`.Rate, `inward`.Quantity, `inward`.Amount, `inward`.Active ";
            $cols.= " ,`outwardlr`.`RMStatus`";
            $cols.= " ,`outwardlr`.`olrid`";

            $sqlQry= "";
            $sqlQry.= "select $cols from `inward`";

            $sqlQry.= "inner join `outwardlr`";
            $sqlQry.= "on `inward`.LRID=`outwardlr`.`iid`";

            $sqlQry.= " where `inward`.LRID IN ($LRList)";
            $sqlQry.= " and `outwardlr`.RMStatus>0";
            $sqlQry.= " and `inward`.Active=1";
            $sqlQry.= " and `outwardlr`.Active=1";

//            echo ("Check sqlQry :- $sqlQry </br>");
//            die();

            unset($con);
            include('assets/inc/db_connect.php');
            $result = mysqli_query($con, $sqlQry);
            if (mysqli_num_rows($result)!=0)
            {
                $inc=0;
                $olrid_List="";
                $BillAmount=0;
                $GrandTotal=0;
                ?>
                    <input type="text" class="form-control daterange-single" name="lrlist" id="lrlist" value="<?php echo $LRList;?>">
                <?php
                while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
                {
                    $iid=$row[0];
                    $CreationDate=$row[1];
                    $ModificationDate=$row[2];
                    $Creator=$row[3];
                    $ip=$row[4];
                    $LRID=$row[5];
                    $fyid=$row[6];
                    $ReceivedDate=$row[7];
                    $InvoiceNumber=$row[8];
                    $vmid=$row[9];
                    $caid=$row[10];
                    $cnid=$row[11];
                    $pmid=$row[12];
                    $PakageType=$row[13];
                    $Rate=$row[14];
                    $Quantity=$row[15];
                    $Amount=$row[16];
                    $Active=$row[17];

                    $RMStatus=$row[18];
                    $olrid=$row[19];


                    $ConsignorName=Get_ConsignorName($con, $caid);
                    $ProductName=Get_ProductName($con, $pmid);

                    $inc=$inc+1;

                    if($inc==1) {
                        $ServiceTax = 0;
                        $ServiceTaxApplicable = 0;
                        $ServiceTaxApplicable = Check_ServiceTaxApplicable($con, $caid);
//                        echo("ServiceTaxApplicable :- $ServiceTaxApplicable </br>");
                        if ($ServiceTaxApplicable == 1) {
                            $ServiceTax = Get_ServiceTax($con);
//                            echo("ServiceTax  :- $ServiceTax  </br>");
                        }
                        $olrid_List=$olrid;
                    }
                    else{
                        $olrid_List=$olrid_List.",".$olrid;
                    }


                    if($RMStatus==1) {
                        $LRGrandTotal=0;
                        $LRGrandTotal=Get_LRGrandTotal($con, $LRID, 1, 0);
                        ?>
                            <tr>
                                <td><a href="#"
                                       onclick="return editmenu();"><?php echo $LRID; ?></a>
                                </td>
                                <td><?php echo $ReceivedDate; ?></td>
                                <td><?php echo $InvoiceNumber; ?></td>
                                <td><?php echo $ConsignorName; ?></td>
                                <td><?php echo $ProductName; ?></td>
                                <td><?php echo $LRGrandTotal; ?></td>
                            </tr>
                        <?php
                        $GrandTotal=$GrandTotal+$LRGrandTotal;
                    }
                    elseif ($RMStatus==2){
                        for($j=1; $j<=2; $j++){
                            if($j==1){
                                $LRGrandTotal=0;
                                $LRGrandTotal=Get_LRGrandTotal($con, $LRID, 2, $j);
                                $GrandTotal=$GrandTotal+$LRGrandTotal;
                            }
                            elseif($j==2){
                                $LRGrandTotal=0;
                                $LRGrandTotal=Get_LRGrandTotal($con, $LRID, 2, $j);
                                $GrandTotal=$GrandTotal+$LRGrandTotal;
                            }
                            ?>
                                <tr>
                                    <td><a href="#"
                                           onclick="return editmenu();"><?php echo $LRID; ?></a>
                                    </td>
                                    <td><?php echo $ReceivedDate; ?></td>
                                    <td><?php echo $InvoiceNumber; ?></td>
                                    <td><?php echo $ConsignorName; ?></td>
                                    <td><?php echo $ProductName; ?></td>
                                    <td><?php echo $LRGrandTotal; ?></td>
                                </tr>
                            <?php
                        }
                    }
                }
            }
            ?>

            </tbody>
        </table>
        <?php
//            echo("GrandTotal :- $GrandTotal </br>");
            $ServiceTaxAmount=0;
            if($ServiceTax>0){
                $ServiceTaxAmount= ($GrandTotal*$ServiceTax)/100;
            }
            $BillAmount=$GrandTotal+$ServiceTaxAmount; //$olrid_List
        ?>

        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-8">
                    <div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-flat" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">
                        <input type="text" class="form-control" name="olrid_List" id="olrid_List" value="<?php echo $olrid_List;?>">
                        <div class="panel-body" style="margin-top:15px;">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group form-group-material">
                                        <label>Total <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="total" id="total" required="required" value="<?php echo $GrandTotal;?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
                                                    <span class="input-group-addon">
                                                        <i class="icon-location4"></i>
                                                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group form-group-material">
                                        <label>Discount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="discount" id="discount" autofocus required="required" value="0" onblur="return billDiscount(this.value, <?php echo $GrandTotal; ?>, <?php echo $ServiceTax; ?>);" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
                                                <span class="input-group-addon">
                                                    <i class="icon-location4"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group form-group-material">
                                        <label>Service Tax <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                              <input type="text" class="form-control" name="servicetax" id="servicetax" value="<?php echo $ServiceTaxAmount; ?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
                                                <span class="input-group-addon">
                                                    <i class="icon-location4"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group form-group-material">
                                        <label>Grand Total <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="billtotal" id="billtotal"value="<?php echo $BillAmount; ?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
                                                <span class="input-group-addon">
                                                    <i class="icon-location4"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button type="button" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_billentry();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
                                    </div>
                                </div>
                                <div id="div_savebillentry"></div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
<!-- /single row selection -->