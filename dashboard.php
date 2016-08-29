<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    include('assets/inc/functions.php');
    sec_session_start();
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate Entry</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" data-pace-options='{"ajax": false}' src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>

    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/full.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>

    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_api.js"></script>

    <!-- /theme JS files -->

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>
    <script type="text/JavaScript" src="assets/js/sha512.js"></script>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
    $PageHeaderName="Manage Rate";
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
            <h4><i class="icon-display4 position-left"></i> <span class="text-semibold"> Dashboard</span> </h4>
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

            <!-- TRial Content Om -->

            <div class="row">
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-primary panel-bordered animated bounceIn">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3 text-left">
                                            <i class="fa fa-bus fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">LR Entry</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-6 text-center border-right">
                                                <div class="huge1">
                                                    <?php
                                                        $StartDate=date("Y-m-d")." 00:00:00";
                                                        $EndDate=date("Y-m-d")." 23:59:59";
                                                        $TableName="inward";
                                                        $ColumnName="CreationDate";
                                                        $TodaysLR=Get_Count($con, $TableName, $ColumnName, $StartDate, $EndDate);
                                                        echo("$TodaysLR");
                                                    ?>
                                                </div>
                                                <div>Today's LR </div>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <div class="huge1">
                                                    <?php
                                                        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
                                                        $last_day_this_month  = date('Y-m-t');
                                                        $StartDate=$first_day_this_month." 00:00:00";
                                                        $EndDate=$last_day_this_month." 23:59:59";
                                                        $TableName="inward";
                                                        $ColumnName="CreationDate";
                                                        $MonthsLR=Get_Count($con, $TableName, $ColumnName, $StartDate, $EndDate);
                                                        echo("$MonthsLR");
                                                    ?>
                                                </div>
                                                <div>Month's LR </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="col-xs-12 text-center">
                                        <i class="icon-hammer-wrench text-size-base"></i> <a href="lrentry.php"> Mangage / Update / Print : LR</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-success panel-bordered animated bounceIn">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3 text-left">
                                            <i class="fa fa-truck fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Road Memo</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-6 text-center border-right">
                                                <div class="huge1">
                                                    <?php
                                                        $StartDate=date("Y-m-d")." 00:00:00";
                                                        $EndDate=date("Y-m-d")." 23:59:59";
                                                        $TableName="outward";
                                                        $ColumnName="CreationDate";
                                                        $TodaysRM=Get_Count($con, $TableName, $ColumnName, $StartDate, $EndDate);
                                                        echo("$TodaysRM");
                                                    ?>
                                                </div>
                                                <div>Today's RM </div>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <div class="huge1">
                                                    <?php
                                                        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
                                                        $last_day_this_month  = date('Y-m-t');
                                                        $StartDate=$first_day_this_month." 00:00:00";
                                                        $EndDate=$last_day_this_month." 23:59:59";
                                                        $TableName="outward";
                                                        $ColumnName="CreationDate";
                                                        $MonthsRM=Get_Count($con, $TableName, $ColumnName, $StartDate, $EndDate);
                                                        echo("$MonthsRM");
                                                    ?>
                                                </div>
                                                <div>Month's RM </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="col-xs-12 text-center">
                                        <i class="icon-cogs text-size-base"></i> <a href="rmentry.php"> Mangage / Update / Print : RM</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-danger panel-bordered animated bounceIn">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3 text-left">
                                            <i class="fa fa-file-text-o fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">Manage Bills</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="col-xs-6 text-center border-right">
                                                <div class="huge1">200</div>
                                                <div>last Bill Count </div>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <div class="huge1">250</div>
                                                <div> Bills to be Generated </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="col-xs-12 text-center">
                                        <i class="icon-compose text-size-base"></i> <a href="rmentry.php"> Generate / Update / Print : Bills</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Trail COntent Om  ... ->





                    <!-- Header and footer fixed -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel panel-flat" style="border-color: #F44336; border-top-width: 4px;">
                                <div class="panel-heading" style="background-color:<?php echo $SearchHeadingColor; ?>;">
                                    <h6 class="panel-title" style="text-align: center;"> <span class="label label-danger" style="font-size:14px;" >Update Delivery Status</span></h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><i class="icon-spinner4 spinner no-edge-top"></i></li>
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <table class="table datatable-header-footer">
                                    <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Job Title</th>
                                        <th>DOB</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Job Title</th>
                                        <th>DOB</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <tr>
                                        <td>Marth</td>
                                        <td><a href="#">Enright</a></td>
                                        <td>Traffic Court Referee</td>
                                        <td>22 Jun 1972</td>
                                        <td><span class="label label-success">Active</span></td>
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
                                    <tr>
                                        <td>Jackelyn</td>
                                        <td>Weible</td>
                                        <td><a href="#">Airline Transport Pilot</a></td>
                                        <td>3 Oct 1981</td>
                                        <td><span class="label label-default">Inactive</span></td>
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
                                    <tr>
                                        <td>Aura</td>
                                        <td>Hard</td>
                                        <td>Business Services Sales Representative</td>
                                        <td>19 Apr 1969</td>
                                        <td><span class="label label-danger">Suspended</span></td>
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
                                    <tr>
                                        <td>Nathalie</td>
                                        <td><a href="#">Pretty</a></td>
                                        <td>Drywall Stripper</td>
                                        <td>13 Dec 1977</td>
                                        <td><span class="label label-info">Pending</span></td>
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
                                    <tr>
                                        <td>Sharan</td>
                                        <td>Leland</td>
                                        <td>Aviation Tactical Readiness Officer</td>
                                        <td>30 Dec 1991</td>
                                        <td><span class="label label-default">Inactive</span></td>
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
                                    <tr>
                                        <td>Maxine</td>
                                        <td><a href="#">Woldt</a></td>
                                        <td><a href="#">Business Services Sales Representative</a></td>
                                        <td>17 Oct 1987</td>
                                        <td><span class="label label-info">Pending</span></td>
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
                                    <tr>
                                        <td>Sylvia</td>
                                        <td><a href="#">Mcgaughy</a></td>
                                        <td>Hemodialysis Technician</td>
                                        <td>11 Nov 1983</td>
                                        <td><span class="label label-danger">Suspended</span></td>
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
                                    <tr>
                                        <td>Lizzee</td>
                                        <td><a href="#">Goodlow</a></td>
                                        <td>Technical Services Librarian</td>
                                        <td>1 Nov 1961</td>
                                        <td><span class="label label-danger">Suspended</span></td>
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
                                    <tr>
                                        <td>Kennedy</td>
                                        <td>Haley</td>
                                        <td>Senior Marketing Designer</td>
                                        <td>18 Dec 1960</td>
                                        <td><span class="label label-success">Active</span></td>
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
                                    <tr>
                                        <td>Chantal</td>
                                        <td><a href="#">Nailor</a></td>
                                        <td>Technical Services Librarian</td>
                                        <td>10 Jan 1980</td>
                                        <td><span class="label label-default">Inactive</span></td>
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
                                    <tr>
                                        <td>Delma</td>
                                        <td>Bonds</td>
                                        <td>Lead Brand Manager</td>
                                        <td>21 Dec 1968</td>
                                        <td><span class="label label-info">Pending</span></td>
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
                                    <tr>
                                        <td>Roland</td>
                                        <td>Salmos</td>
                                        <td><a href="#">Senior Program Developer</a></td>
                                        <td>5 Jun 1986</td>
                                        <td><span class="label label-default">Inactive</span></td>
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
                                    <tr>
                                        <td>Coy</td>
                                        <td>Wollard</td>
                                        <td>Customer Service Operator</td>
                                        <td>12 Oct 1982</td>
                                        <td><span class="label label-success">Active</span></td>
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
                                    <tr>
                                        <td>Maxwell</td>
                                        <td>Maben</td>
                                        <td>Regional Representative</td>
                                        <td>25 Feb 1988</td>
                                        <td><span class="label label-danger">Suspended</span></td>
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
                                    <tr>
                                        <td>Cicely</td>
                                        <td>Sigler</td>
                                        <td><a href="#">Senior Research Officer</a></td>
                                        <td>15 Mar 1960</td>
                                        <td><span class="label label-info">Pending</span></td>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Header and footer fixed -->



                    <!-- Yooyubes -->

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="thumbnail">
                                    <div class="video-container">
                                        <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/127628756?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                                    </div>

                                    <div class="caption">
                                        <h6 class="no-margin-top text-semibold"><a href="#" class="text-default">Wholly coming</a> <a href="#" class="text-muted"><i class="icon-cog5 pull-right"></i></a></h6>
                                        Own hence views two ask right whole ten seems. What near kept met call old west announcing
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="thumbnail">
                                    <div class="video-container">
                                        <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/126136408?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                                    </div>

                                    <div class="caption">
                                        <h6 class="no-margin-top text-semibold"><a href="#" class="text-default">Offending delivered</a> <a href="#" class="text-muted"><i class="icon-cog5 pull-right"></i></a></h6>
                                        Preserved defective offending he daughters on. Rejoiced prospect yet material servants out
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="thumbnail">
                                    <div class="video-container">
                                        <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/125791075?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                                    </div>

                                    <div class="caption">
                                        <h6 class="no-margin-top text-semibold"><a href="#" class="text-default">Much did had call</a> <a href="#" class="text-muted"><i class="icon-cog5 pull-right"></i></a></h6>
                                        Add stairs admire all answer the nearer length. Advantages prosperous remarkably inhabiting
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





        </div>
        <!-- /content wrapper -->




                <!-- Side Bar -->

                    <div class="col-lg-2">
                        <!-- Secondary sidebar -->
                        <div class="sidebar sidebar-secondary sidebar-default">
                            <div class="sidebar-content">

                                <!-- Actions -->
                                <div class="sidebar-category sidebar-category-visible">
                                    <div class="category-title">
                                        <span>Masters Entry</span>
                                        <ul class="icons-list">
                                            <li><a href="#" data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                    <div class="category-content">
                                        <div class="row row-condensed">
                                            <div class="col-xs-6">

                                                <button href="add_vehicel.php" type="button" class="btn bg-teal-400 btn-block btn-float btn-float-sm">
                                                    <a href="index.html"><i class="icon-bus"></i> Archive</a></button>
                                                <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-sm">
                                                    <i class="icon-archive"></i> <span>Archive</span></button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" class="btn bg-warning-400 btn-block btn-float btn-float-sm ">
                                                    <i class="icon-stats-bars"></i> <span>Statistics</span></button>
                                                <button type="button" class="btn bg-blue btn-block btn-float btn-float-sm">
                                                    <i class="icon-cog3"></i> <span>Settings</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="navigation navigation-alt navigation-accordion">
                                        <li class="navigation-divider"></li>
                                        <li><a href="#"><i class="icon-googleplus5"></i> Create invoice</a></li>
                                        <li><a href="#"><i class="icon-compose"></i> Edit invoice</a></li>
                                        <li><a href="#"><i class="icon-archive"></i> Archive <span class="badge badge-default">190</span></a></li>
                                    </ul>
                                </div>
                                <!-- /actions -->
                            </div>
                        </div>
                        <!-- /secondary sidebar -->

                    </div>

                    <div class="col-lg-2 col-sm-6">
                        <div class="thumbnail">
                            <div class="video-container">
                                <iframe allowfullscreen="" frameborder="0" mozallowfullscreen="" src="https://player.vimeo.com/video/126580704?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen=""></iframe>
                            </div>

                            <div class="caption">
                                <h6 class="no-margin-top text-semibold"><a href="#" class="text-default">Two differed</a> <a href="#" class="text-muted"><i class="icon-cog5 pull-right"></i></a></h6>
                                Welcomed stronger if steepest.
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Share your thoughts</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                                <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                            <div class="panel-body">
                                <form action="#">
                                    <div class="form-group">
                                        <textarea name="enter-message" class="form-control mb-15" rows="3" cols="1" placeholder="What's on your mind?"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <ul class="icons-list icons-list-extended mt-10">
                                                <li><a href="#" data-popup="tooltip" title="" data-container="body" data-original-title="Add photo"><i class="icon-images2"></i></a></li>
                                            </ul>
                                        </div>

                                        <div class="col-sm-8 text-center">
                                            <button type="button" class="btn btn-primary btn-labeled btn-labeled-right">Share <b><i class="icon-circle-right2"></i></b></button>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>

                                            <p>Add stairs admire all answer the nearer length.</p>
                                        </div>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Side Bar -->

    </div>
    <!-- /page content -->
    <?php include('footer.php'); ?>
</div>
<!-- /page container -->
</body>
</html>
