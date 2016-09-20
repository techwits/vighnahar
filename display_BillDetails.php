<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SVL Invoice Print</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover" rel="stylesheet" type="text/css">
    <link href="assets/css/print_bill.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/fixed_header.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/datatables_extension_fixed_header.js"></script>
    <script type="text/javascript" src="assets/js/layout_sidebar_sticky.js"></script>
    <!-- /theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/gallery.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="assets/js/pages/invoice_template.js"></script>
    <!-- /theme JS files -->

</head>



<?php
$error_msg="";
$CurrentDate = date('Y-m-d h:i:s');

$BillNo = $_GET['BillNo'];
$ViewPrint = $_GET['ViewPrint'];
//    echo("BillNo :- $BillNo </br>");
//    echo("ViewPrint :- $ViewPrint </br>");
//    die();


    $cols=" `bill`.BillingDate, `bill`.caid, `bill`.Amount, `bill`.Discount, `bill`.ServiceTax, `bill`.BillAmount ";
    $cols.=" , `outwardlr`.`iid`";

    $sqlQry= "select $cols from `bill`";

    $sqlQry.= "inner join `billlr`";
    $sqlQry.= "on `bill`.`bid` = `billlr`.`bid`";

    $sqlQry.= "inner join `outwardlr`";
    $sqlQry.= "on `billlr`.`olrid` = `outwardlr`.`olrid`";

    $sqlQry.= " where 1=1";

    $sqlQry.= " and bill.bid = $BillNo";

    $sqlQry.= " and `bill`.Active=1";
    $sqlQry.= " and `billlr`.Active=1";


//    echo ("Check sqlQry :- $sqlQry </br>");
//    die();


    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    $result = mysqli_query($con, $sqlQry);
    if (mysqli_num_rows($result)!=0)
    {
        $inc=0;
        $BillDate=Get_BillDate($con, $BillNo);

        $ConsignorID=Get_ConsignorIDONBillNo($con, $BillNo);
//        echo("ConsignorID :- $ConsignorID </br>");

        $ConsignorPanNo=Get_ConsignorPanNo($con, $ConsignorID);


        $ConsignorCompanyName=Get_ConsignorName($con, $ConsignorID);
//        echo("ConsignorCompanyName :- $ConsignorCompanyName </br>");
        $ConsignorPersonAddress=Get_Consignor_PersonAddress($con, $ConsignorID);
//        echo("ConsignorAddress :- $ConsignorAddress </br>");

        $Split_ConsignorPersonAddress = explode("~~~", $ConsignorPersonAddress);
		$ConsignorPerson=$Split_ConsignorPersonAddress[0];

        $ConsignorAddress=$Split_ConsignorPersonAddress[1];
        $Split_ConsignorAddress = explode("|||", $ConsignorAddress);
        $ConsignorAdd=$Split_ConsignorAddress[0];
        $ConsignorArea=$Split_ConsignorAddress[1];
        $ConsignorPincode=$Split_ConsignorAddress[2];
        $ConsignorCity=$Split_ConsignorAddress[3];




        $ConsignorTelephoneEmailWebsite=Get_Consignor_TelephoneEmailWebsite($con, $ConsignorID);
//        echo("ConsignorTelephoneEmailWebsite :- $ConsignorTelephoneEmailWebsite </br>");
        $Split_ConsignorTelephoneEmailWebsite = explode("|", $ConsignorTelephoneEmailWebsite);
        $ConsignorTelephone=$Split_ConsignorTelephoneEmailWebsite[0];
        $ConsignorEmail=$Split_ConsignorTelephoneEmailWebsite[1];
        $ConsignorWebsite=$Split_ConsignorTelephoneEmailWebsite[2];

        $BillAmount=0;
        $Receipt=0;
        $BillAmount=Get_BillAmount($con, $ConsignorID, $BillNo);
        $Receipt=Get_Receipt($con, $ConsignorID);
//        echo("BillAmount :- $BillAmount </br>");
//        echo("Receipt :- $Receipt </br>");
//        die();
        $OverallDue=0;
        $OverallDue=$BillAmount-$Receipt;
        $OverallDue = number_format((float)$OverallDue, 2, '.', '');

//        die();

?>
    <body class="print-mode print-paper-a4">
    <div class="print-papers print-preview">
        <div class="print-paper">

            <!-- Invoice template -->

            <div class="invoice-top">
                <!--<div class="row">
                  <div class="invoice-button">
                      <div class="heading-btn text-right">
                          <button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-file-check position-left"></i> Save</button>
                          <button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</button>
                      </div>
                  </div>
                </div>-->
                <div class="row">
                    <div class="invoice-head">
                        <div class="content-add">
                            <span class="text-bold">Shree Vighnahar Logistics</span><br>
                            <span class="text-bold">Time To Time</span><br>
                            Shed No.1, Gala No.1, Arihant Complex,<br>
                            Kopar Bus Stop, Purna Village, Bhiwandi,<br>
                            Dist:-Thane-421302. Ph: 9272217794/95<br>
                            <span>web:<a href="#">www.shreevighnaharlogistics.com</a><br></span>
                            <span>Email:<a href="#">chetan@shreevighnaharlogistics.com</a></span>
                        </div>
                        <div class="invoice-logo">
                            <div class="heading-btn text-right">
                                <img src="assets/images/logo_ttt.png" class="content-group mt-10" alt="" style="hight: 20px;">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="content-party text-left">
                        <span class="text-muted">Invoice To:</span>
                        <ul class="list-condensed list-unstyled">
                            <li><h6 class="no-margin text-semibold"><?php echo $ConsignorPerson ?></h6></li>
                            <li><h6 class="no-margin text-semibold"><?php echo $ConsignorCompanyName; ?></h6></li>
                            <li><?php echo $ConsignorAdd; ?></li>
                            <li><?php echo $ConsignorArea.", ".$ConsignorPincode.", ".$ConsignorCity; ?></li>
                            <li><?php echo $ConsignorTelephone; ?></li>
                            <li><?php echo $ConsignorEmail; ?></li>
                            <li><?php echo $ConsignorWebsite; ?></li>
                        </ul>
                    </div>
                    <div class="content-date">
                        <h5 class="text-uppercase text-semibold">Invoice #<?php echo $BillNo;?></h5>
                        <ul class="list-condensed list-unstyled">
                            <li>Date: <span class="text-semibold"><?php echo $BillDate; ?></span></li>
                            <li>Pan No.: <span class="text-semibold"><?php echo $ConsignorPanNo; ?></span></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="invoice-detail">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 30px">No</th>
                                <th style="width: 300px;">Company Name</th>
                                <th class="col-sm-1">Qty</th>
                                <th class="col-sm-1">Shiping</th>
                                <th class="col-sm-1">Warai</th>
                                <th class="col-sm-1">Return</th>
                                <th class="col-sm-1">Other</th>
                                <th class="col-sm-1">Total</th>
                            </tr>
                            </thead>
                            <tbody>
<?php
    while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
                {
                    $inc=$inc+1;
                $BillingDate = $row[0];
                $caid = $row[1];
                $Amount = $row[2];
                $Discount = $row[3];
                $ServiceTax = $row[4];
                $BillAmount = $row[5];
                $iid = $row[6];


                $LRDetails = Get_LRDetails($con, $iid);
//                echo("LRDetails :- $LRDetails </br>");
                $Split_LRDetails = explode("|/|~|/|", $LRDetails);
                //		0 financialyear_master.FinancialYear ,
                //		1 inward.ReceivedDate,
                // 		2 inward.InvoiceNumber ,
                //		3 vehicle_master.VehicleNumber ,
                //		4 consignoraddress_master.Address,
                // 		5 area_master.AreaName,
                // 		6 consignoraddress_master.Pincode,
                // 		7 consignoraddress_master.City ,
                //		8 consignor_master.ConsignorName,
                // 		9 consignor_master.Pancard ,
                //		10 consignee_master.ConsigneeName ,
                //		11 consigneeaddress_master.Address,
                // 		12 a.AreaName,
                // 		13 consigneeaddress_master.Pincode,
                // 		14 consigneeaddress_master.City ,
                //		15 product_master.ProductName ,
                //		16 inward.PakageType,
                // 		17 inward.Rate,
                //		18 inward.Quantity,
                // 		19 inward.Amount,
                //		20 inward.Active
                //      21 consignoraddress_master.Person,


                $AdditionalCharges = Get_AdditionalCharges($con, $iid);
                $Split_AdditionalCharges = explode(",", $AdditionalCharges);
                // 0 - Road Expense (Road Exp.)
                // 1 - Bilty Charges (B. C.)
                // 2 - PhotocopyCharges (Xerox)
                // 3 - Warai (Warai)
                // 4 - Goods Return
                // 5 - Delivery Charges
                // 6 - Insurance
                // 7 - Product Charges

                //        echo("AdditionalCharges :- $AdditionalCharges </br>");
                //        die();
                //        echo("iid :- $iid </br>");
                $a0 = 0;
                $a1 = 0;
                $a2 = 0;
                $a3 = 0;
                $a4 = 0;
                $a5 = 0;
                $a6 = 0;
                $a7 = 0;

                $a0 = number_format((float)$Split_AdditionalCharges[0], 2, '.', '');
                $a1 = number_format((float)$Split_AdditionalCharges[1], 2, '.', '');
                $a2 = number_format((float)$Split_AdditionalCharges[2], 2, '.', '');
                $a3 = number_format((float)$Split_AdditionalCharges[3], 2, '.', '');
                $a4 = number_format((float)$Split_AdditionalCharges[4], 2, '.', '');
                $a5 = number_format((float)$Split_AdditionalCharges[5], 2, '.', '');
                $a6 = number_format((float)$Split_AdditionalCharges[6], 2, '.', '');
                $a7 = number_format((float)$Split_AdditionalCharges[7], 2, '.', '');


                $Shipping = 0;
                $Warai = 0;
                $Return = 0;
                $Other = 0;
                $Total = 0;

                $Shipping = $a7;
                $Warai = $a3;
                $Return = $a4;
                $Other = $a0 + $a1 + $a2 + $a4 + $a5 + $a6;
                $Other = number_format((float)$Other, 2, '.', '');

                $Total = $Shipping + $Warai + $Return + $Other;
                $Total = number_format((float)$Total, 2, '.', '');

                ?>

                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin"><?php echo $inc;?></h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#"
                                       class="display-inline-block text-default text-semibold letter-icon-title"><?php echo $Split_LRDetails[10]; ?></a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a
                                                href="#"></a>LR No.: <?php echo $iid; ?></span>
                                        <span class="media-annotation list-inline mt-10"><a
                                                href="#"></a>LR Date: <?php echo $Split_LRDetails[1]; ?></span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.: <?php echo $Split_LRDetails[2]; ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Split_LRDetails[18]; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Shipping; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Warai; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Return; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Other; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold"><?php echo $Total; ?></span>
                            </td>
                        </tr>
                <?
                }
                ?>
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="invoice-payment">
                            <div class="content-payment">
                                <h6>Authorized person</h6>
                                <div class="mb-15 mt-15">
                                    <img src="assets/images/signature.png" class="display-block" style="width: 120px;" alt="">
                                </div>

                                <ul class="list-condensed list-unstyled text-muted">
                                    <li>Eugene Kopyov</li>
                                </ul>
                            </div>

                            <div class="Prior-Balance">
                                <h5><span class="text-highlight">Prior Balance</span></h5>
                                <h3><span class="bg-indigo-400 text-highlight"><?php echo $OverallDue;?></span></h3>
                            </div>

                            <div class="content-payment-total">
                                <div class="table no-border">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Subtotal:</th>
                                            <td class="text-right"><?php echo $Amount; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td class="text-right"><?php echo $Discount; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Service Tax: <span class="text-regular"></span></th>
                                            <td class="text-right"><?php echo $ServiceTax; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td class="text-right text-primary"><h5 class="text-semibold"><?php echo $BillAmount; ?></h5></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <?php
                                        $TotalDues=0;
                                        $TotalDues=$OverallDue+$BillAmount;
                                        $TotalDues=round($TotalDues,0);
                                        $TotalDues = number_format((float)$TotalDues, 2, '.', '');

//                                        $TotalDues=1215781.25;
                                        $AmountinWords=AmountinWords($TotalDues);
//                                        echo("AmountinWords :- $AmountinWords </br>");
                                    ?>
                                    <h5>Amount Payble <span class="bg-indigo-400 text-highlight"><?php echo $TotalDues; ?></span></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="amount-word text-left">
                                    <h6 class="media-heading"><a>Amount Payble in words: <?php echo $AmountinWords; ?></a></h6>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row hidden-lg-up">
                        <div class="disclaimer text-left">
                            <h6 class="no-margin">Other information</h6>
                            <p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
                        </div>
                    </div>
                </div

            </div>
            </body>
                <?php

                if($ViewPrint==2){
                    ?>
                        <script type="text/javascript">
                            window.print();
                        </script>
                    <?php
                }
        }
        else{
            echo("Bill No. does not exit. Please check......");
            die();
        }