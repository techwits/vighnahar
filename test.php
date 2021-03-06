<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shree Vighnahar Logistics ( Time To Time ) A leading name in Logistics , Transportation , Warehousing , C &F</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="invoice/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/hover" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Global stylesheets  Invoice-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
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
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/dashboard.js"></script>
    <!-- /theme JS files -->



</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
$PageHeaderName="Dashboard";
$icon="icon-address-book";

include('page_header.php');

//    $php_page=basename(__FILE__);
//    $get_return_value=login_check($con, $php_page);
//    include_once("assets/inc/handle_error.php");
//
//    //		mysqli_close($con);
//    log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
//    //		mysqli_close($con);
//    include_once('assets/inc/db_connect.php');

?>
<!-- /main navbar -->

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-display4 position-left"></i> <span class="text-semibold"> Admin Dashboard</span> </h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Dashboard content -->

            <div class="row">
                <div class="col-lg-10">
                    <!-- Quick stats boxes -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Current LR Details -->
                            <div class="panel bg-teal-400">
                                <div class="bg-teal-600 text-center"><span>LR </span></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-4 text-center border-right ">
                                                <h3 class="no-margin">200</h3>
                                                Day
                                                <div class="text-muted text-size-small">489 avg</div>
                                            </div>
                                            <div class="col-xs-4 text-center border-right">
                                                <h3 class="no-margin">3,450</h3>
                                                Month
                                                <div class="text-muted text-size-small">489 avg</div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h3 class="no-margin">54,800</h3>
                                                Year
                                                <div class="text-muted text-size-small">489 avg</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /members online -->
                        </div>



                        <div class="col-md-6">

                            <!-- Current RM detail -->
                            <div class="panel bg-pink-400">
                                <div class="bg-pink-800 text-center"><span>RM </span></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-4 text-center border-right">
                                                <h3 class="no-margin">15</h3>
                                                Day
                                                <div class="text-muted text-size-small">34.6% avg</div>
                                            </div>
                                            <div class="col-xs-4 text-center border-right">
                                                <h3 class="no-margin">300</h3>
                                                Month
                                                <div class="text-muted text-size-small">34.6% avg</div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <h3 class="no-margin">3400</h3>
                                                Year
                                                <div class="text-muted text-size-small">34.6% avg</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /current server load -->

                        </div>

                    </div>





                    <div class="row">
                        <div class="col-md-6">

                            <!-- Members online -->
                            <div class="panel bg-teal-400">
                                <div class="panel-body">


                                    <div id="google-bar"></div>


                                </div>
                            </div>
                            <!-- /members online -->

                        </div>

                        <div class="col-md-6">

                            <!-- Current server load -->
                            <div class="panel bg-pink-400">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 col-xs-offset-1">
                                            <div class="col-xs-2 text-center">
                                                <span class="heading-text badge bg-pink-800"> 12 </span>
                                                <div class="text-muted text-size-small">Trips</div>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <span class="heading-text badge bg-pink-800"> 53 </span>
                                                <div class="text-muted text-size-small">Areas</div>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <span class="heading-text badge bg-pink-800"> 53 </span>
                                                <div class="text-muted text-size-small">Consignors</div>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <span class="heading-text badge bg-pink-800"> 53 </span>
                                                <div class="text-muted text-size-small">Consignees</div>
                                            </div>
                                            <div class="col-xs-2 text-center">
                                                <span class="heading-text badge bg-pink-800"> 53 </span>
                                                <div class="text-muted text-size-small">Packages</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /current server load -->

                        </div>

                    </div>
                    <!-- /quick stats boxes -->



                    <!-- Support tickets -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Invoice archive -->
                            <div class="panel panel-white">
                                <div class="panel-heading ">
                                    <div class="bg-grey-800 text-center"><span>Invoice Details </span></div>

                                </div>
                                <table class="table table-xlg text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-cart5"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    1,132 <small class="display-block no-margin">Bill Value</small>
                                                </h5>
                                            </div>
                                        </td>

                                        <td class="col-md-2">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class=" icon-cart-add"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    1,132 <small class="display-block no-margin">Bill Pending Value</small>
                                                </h5>
                                            </div>
                                        </td>

                                        <td class="col-md-2">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-cart-add2"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    200 <small class="display-block no-margin">Receivables</small>
                                                </h5>
                                            </div>
                                        </td>

                                        <td class="col-md-2">
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class=" icon-cart4"></i></a>
                                            </div>

                                            <div class="media-left">
                                                <h5 class="text-semibold no-margin">
                                                    12 <small class="display-block no-margin">Consignors-Debtors</small>
                                                </h5>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-lg invoice-archive">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Period</th>
                                        <th>Issued to</th>
                                        <th>Status</th>
                                        <th>Issue date</th>
                                        <th>Due date</th>
                                        <th>Amount</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>#0025</td>
                                        <td>February 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Rebecca Manes</a>
                                                <small class="display-block text-muted">Payment method: Skrill</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold" selected="selected">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 18, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Mar 16, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$17,890 <small class="display-block text-muted text-size-small">VAT $4,890</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0024</td>
                                        <td>February 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">James Alexander</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 17, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">5 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$2,769 <small class="display-block text-muted text-size-small">VAT $2,839</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0023</td>
                                        <td>February 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Jeremy Victorino</a>
                                                <small class="display-block text-muted">Payment method: Payoneer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 17, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">27 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$1,500 <small class="display-block text-muted text-size-small">VAT $1,984</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0022</td>
                                        <td>January 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Margo Baker</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel" selected="selected">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            January 15, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">12 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$4,580 <small class="display-block text-muted text-size-small">VAT $992</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0021</td>
                                        <td>January 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Beatrix Diaz</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue" selected="selected">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            January 10, 2015
                                        </td>
                                        <td>
                                            <span class="label label-danger">- 3 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$7,990 <small class="display-block text-muted text-size-small">VAT $1,294</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0020</td>
                                        <td>January 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Richard Vango</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid" selected="selected">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            January 10, 2015
                                        </td>
                                        <td>
                                            <span class="label label-default">On hold</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$12,120 <small class="display-block text-muted text-size-small">VAT $3,278</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0019</td>
                                        <td>January 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Will Baker</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold" selected="selected">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            December 26, 2014
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Feb 25, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$5,390 <small class="display-block text-muted text-size-small">VAT $2,880</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0018</td>
                                        <td>January 2015</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Joseph Mills</a>
                                                <small class="display-block text-muted">Payment method: Skrill</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending" selected="selected">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            June 17, 2015
                                        </td>
                                        <td>
                                            <span class="label label-default">On hold</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$10,280 <small class="display-block text-muted text-size-small">VAT $2,190</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0017</td>
                                        <td>December 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Buzz Brenson</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending" selected="selected">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            May 6, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">2 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$43,320 <small class="display-block text-muted text-size-small">VAT $1,299</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0016</td>
                                        <td>December 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Zachary Willson</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue" selected="selected">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            March 7, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">15 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$7,100 <small class="display-block text-muted text-size-small">VAT $1,450</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0015</td>
                                        <td>December 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Bastian Miller</a>
                                                <small class="display-block text-muted">Payment method: Payoneer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid" selected="selected">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            March 23, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">6 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$1,030 <small class="display-block text-muted text-size-small">VAT $229</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0014</td>
                                        <td>December 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">William Samuel</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel" selected="selected">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            March 2, 2015
                                        </td>
                                        <td>
                                            <span class="label label-default">On hold</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$800 <small class="display-block text-muted text-size-small">VAT $189</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0013</td>
                                        <td>November 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Monica Smith</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending" selected="selected">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            February 25, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Feb 15, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$6,300 <small class="display-block text-muted text-size-small">VAT $1,200</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0012</td>
                                        <td>November 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Jordana Miles</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            February 26, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">12 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$2,200 <small class="display-block text-muted text-size-small">VAT $689</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0011</td>
                                        <td>November 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">John Craving</a>
                                                <small class="display-block text-muted">Payment method: Payoneer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            May 9, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Jan 28, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$2,600 <small class="display-block text-muted text-size-small">VAT $370</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0010</td>
                                        <td>November 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">James Basel</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue" selected="selected">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            June 1, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">5 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$6,800 <small class="display-block text-muted text-size-small">VAT $2,118</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0009</td>
                                        <td>November 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Lucy Johnson</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 10, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Jan 17, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$900 <small class="display-block text-muted text-size-small">VAT $199</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0008</td>
                                        <td>October 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Kinga Wallace</a>
                                                <small class="display-block text-muted">Payment method: Skrill</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending" selected="selected">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 12, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">12 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$1,200 <small class="display-block text-muted text-size-small">VAT $298</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0007</td>
                                        <td>October 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Anna Zuniga</a>
                                                <small class="display-block text-muted">Payment method: Payoneer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            March 29, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Jan 14, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$13,000 <small class="display-block text-muted text-size-small">VAT $4,290</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0006</td>
                                        <td>October 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Nicolette Grey</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending" selected="selected">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            February 23, 2015
                                        </td>
                                        <td>
                                            <span class="label label-default">On hold</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$5,200 <small class="display-block text-muted text-size-small">VAT $1,300</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0005</td>
                                        <td>October 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Vanessa Aurelius</a>
                                                <small class="display-block text-muted">Payment method: Wire transfer</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            January 10, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">9 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$3,000 <small class="display-block text-muted text-size-small">VAT $789</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0004</td>
                                        <td>October 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Hanna Walden</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            May 2, 2015
                                        </td>
                                        <td>
                                            <span class="label label-primary">20 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$2,830 <small class="display-block text-muted text-size-small">VAT $600</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0003</td>
                                        <td>September 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Dori Laperriere</a>
                                                <small class="display-block text-muted">Payment method: Skrill</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold" selected="selected">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            May 1, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Jan 10, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$12,850 <small class="display-block text-muted text-size-small">VAT $3,590</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0002</td>
                                        <td>September 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Jordano Diressimo</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid" selected="selected">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            June 22, 2015
                                        </td>
                                        <td>
                                            <span class="label label-success">Paid on Jan 9, 2015</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$10,900 <small class="display-block text-muted text-size-small">VAT $3,690</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>#0001</td>
                                        <td>September 2014</td>
                                        <td>
                                            <h6 class="no-margin">
                                                <a href="#">Patrick Muller</a>
                                                <small class="display-block text-muted">Payment method: Paypal</small>
                                            </h6>
                                        </td>
                                        <td>
                                            <select name="status" class="select" data-placeholder="Select status">
                                                <option value="overdue" selected="selected">Overdue</option>
                                                <option value="hold">On hold</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                                <option value="invalid">Invalid</option>
                                                <option value="cancel">Canceled</option>
                                            </select>
                                        </td>
                                        <td>
                                            April 4, 2015
                                        </td>
                                        <td>
                                            <span class="label label-warning">5 days</span>
                                        </td>
                                        <td>
                                            <h6 class="no-margin text-bold">$9,390 <small class="display-block text-muted text-size-small">VAT $2,548</small></h6>
                                        </td>
                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li><a href="#" data-toggle="modal" data-target="#invoice"><i class="icon-file-eye"></i></a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                                                        <li><a href="#"><i class="icon-printer"></i> Print</a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#"><i class="icon-file-plus"></i> Edit</a></li>
                                                        <li><a href="#"><i class="icon-cross2"></i> Remove</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /invoice archive -->
                        </div>
                    </div>
                    <!-- /support tickets -->
                </div>

                <div class="col-lg-2">
                    <!-- Secondary sidebar -->
                    <div class="sidebar sidebar-secondary sidebar-default">
                        <div class="sidebar-content">

                            <!-- Actions -->
                            <div class="sidebar-category">
                                <div class="bg-blue-800 text-center"><span>Manage Masters </span></div>

                                <ul class="navigation navigation-alt navigation-accordion">
                                    <li><a href="#" onclick="window.open('add_login.php','_self');"><i class="icon-user-lock"></i> User <span class="badge badge-info">8</span></a></li>
                                    <li><a href="#" onclick="window.open('add_consignor.php','_self');"><i class="icon-user-check"></i> Consignor <span class="badge badge-info">74</span></a></li>
                                    <li><a href="#" onclick="window.open('add_product.php','_self');"><i class="icon-cart-add2"></i> Products <span class="badge badge-info">180</span></a></li>
                                    <li><a href="#" onclick="window.open('add_rate.php','_self');"><img src="assets/images/rupee_bag-512.png" height="20" width="20"> &nbsp;&nbsp;Rate </a></li>
                                    <li><a href="#" onclick="window.open('add_additionalcharge.php','_self');"><i class="icon-coin-dollar"></i> Additional Charges</a></li>
                                    <li><a href="#" onclick="window.open('add_transporter.php','_self');"><i class="icon-steering-wheel"></i> Driver <span class="badge badge-success">165</span></a></li>
                                    <li><a href="#" onclick="window.open('add_vehicle.php','_self');"><i class="icon-truck"></i> Vehicle <span class="badge badge-success">165</span></a></li>
                                    <li><a href="#" onclick="window.open('add_undeliveredreason.php','_self');"><i class="icon-location3"></i> Undelivered Reason </a></li>

                                    <li><a href="#" onclick="window.open('add_area.php','_self');"><i class="icon-location4"></i> Area <span class="badge badge-info">8</span></a></li>
                                    <li><a href="#" onclick="window.open('add_vehicleownership.php','_self');"><i class="icon-bus"></i>Vehicle Ownership</a></li>
                                    <li><a href="#" onclick="window.open('add_pageaccess.php','_self');"><i class="icon-file-check"></i>Page Access</a></li>
                                    <li><a href="#" onclick="window.open('add_pages.php','_self');"><i class="icon-stack"></i>Pages </a></li>
                                    <li><a href="#" onclick="window.open('add_merchant.php','_self');"><i class="icon-user-tie"></i> Merchant</a></li>
                                    <li><a href="#" onclick="window.open('add_contacttype.php','_self');"><i class="icon-address-book"></i> Contact Type</a></li>
                                    <li><a href="#" onclick="window.open('add_deliverystatus.php','_self');"><i class="icon-diff"></i> Delivery Status</a></li>




                                </ul>
                            </div>
                            <!-- /actions -->


                            <!-- Navigation -->
                            <div class="sidebar-category">
                                <div class="category-content no-padding">

                                </div>
                            </div>
                            <!-- /navigation -->

                        </div>


                    </div>
                    <!-- /secondary sidebar -->

                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="content-group text-semibold">View LR</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control input-micro" type="text" placeholder="View LR" name="show_lrno" id="show_lrno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                </div>
                                <div class="col-sm-2 text-center">

                                    <a href="#modal_full" data-toggle="modal" class="modalButton1">
                                        <button type="button" class="btn btn-info btn-xs">Submit</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">View RM</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control input-micro" type="text" placeholder="View LR" name="show_lrno" id="show_lrno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                </div>
                                <div class="col-sm-2 text-center">

                                    <a href="#modal_full" data-toggle="modal" class="modalButton1">
                                        <button type="button" class="btn btn-info btn-xs">Submit</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">View Bill</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control input-micro" type="text" placeholder="View LR" name="show_lrno" id="show_lrno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                </div>
                                <div class="col-sm-2 text-center">

                                    <a href="#modal_full" data-toggle="modal" class="modalButton1">
                                        <button type="button" class="btn btn-info btn-xs">Submit</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /dashboard content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- /footer -->

</div>
<!-- /page container -->

</body>
</html>
