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
//    echo("BillNo :- $BillNo </br>");
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
    while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
    {
        $BillingDate=$row[0];
        $caid=$row[1];
        $Amount=$row[2];
        $Discount=$row[3];
        $ServiceTax=$row[4];
        $BillAmount=$row[5];
        $iid=$row[6];


        $LRDetails=Get_LRDetails($con, $iid);
        $Split_LRDetails = explode(",", $LRDetails);
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


        $AdditionalCharges=Get_AdditionalCharges($con, $iid);
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
        echo("iid :- $iid </br>");
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
                        <li><h6 class="no-margin text-semibold"><?php echo $Split_LRDetails[21]; ?></h6></li>
                        <li><h6 class="no-margin text-semibold">Normand axis LTD</h6></li>
                        <li>3 Goodman Street</li>
                        <li>London E1 8BF United Kingdom</li>
                        <li>888-555-2311</li>
                        <li><a href="#">rebecca@normandaxis.ltd</a></li>
                    </ul>
                </div>
                <div class="content-date">
                    <h5 class="text-uppercase text-semibold">Invoice #49029</h5>
                    <ul class="list-condensed list-unstyled">
                        <li>Date: <span class="text-semibold">January 12, 2015</span></li>
                        <li>Due date: <span class="text-semibold">May 12, 2015</span></li>
                        <li>Pan No.: <span class="text-semibold">ABYFS5696M</span></li>
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
                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">1</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">2</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">3</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">4</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">5</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <h6 class="no-margin">6</h6>
                            </td>
                            <td>
                                <div class="media-body">
                                    <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">Annabelle Doney</a>
                                    <div class="text-left">
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR No.:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>LR Date:</span>
                                        <span class="media-annotation list-inline mt-10"><a href="#"></a>Invoice No.:</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                            <td class="text-center">
                                <span class="text-semibold">$2,170</span>
                            </td>
                        </tr>
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
                    <h3><span class="bg-indigo-400 text-highlight">Balance</span></h3>
                </div>

                <div class="content-payment-total">
                    <h6>Total due</h6>
                    <div class="table no-border">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">$7,000</td>
                            </tr>
                            <tr>
                                <th>Tax: <span class="text-regular">(25%)</span></th>
                                <td class="text-right">$1,750</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <h5>Total Dues <span class="bg-indigo-400 text-highlight">Balance</span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="amount-word text-left">
                        <h6 class="media-heading"><a>Amount In Word : </a></h6>
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
<?
}
}
else{
    echo("Bill No. does not exit. Please check......");
    die();
}