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
    <title>User Dashboard</title>

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
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/notifications/jgrowl.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/anytime.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/legacy.js"></script>

    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>


    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/notifications/bootbox.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_modals.js"></script>
    <!-- /theme JS files -->


    <script type="text/JavaScript" src="assets/js/search/search.js"></script>


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
                                                <div class="huge1">
                                                    <?php

                                                    $CYear=date("Y");
                                                    $CMonth=date("m");
                                                    if($CMonth<4){
                                                        $CYear=$CYear-1;
                                                    }
                                                    $FinancialYearID=Get_FinancialYear($con, $CYear);
                                                    $BillCountFinancialYear=Get_BillCountFinancialYear($con, $FinancialYearID);


                                                    echo($BillCountFinancialYear);
                                                    ?>
                                                </div>
                                                <div>last Bill Count </div>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <div class="huge1">
                                                    <?php
                                                    $UnbillCount=Get_UnbillCount($con);
                                                    echo("$UnbillCount </br>");
                                                    ?>
                                                </div>
                                                <div> Bills to be Generated </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="col-xs-12 text-center">
                                        <i class="icon-compose text-size-base"></i> <a href="billentry.php"> Generate / Update / Print : Bills</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Trail COntent Om  ... ->
                    <!-- Road Memo table -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel panel-flat" style="border-color: #F44336; border-top-width: 4px;">
                                <div class="panel-heading" style="background-color:<?php echo $SearchHeadingColor; ?>;">
                                    <h6 class="panel-title" style="text-align: center;"> <span class="label label-danger" style="font-size:14px;" >Update Delivery Status</span></h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <!--                                            <li><i class="icon-spinner4 spinner no-edge-top"></i>asas</li>-->
                                            <li><a data-action="reload" onclick="return refreshpage(0);"></a></li>
                                            <li><a data-action="collapse"></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="content">
                                    <!-- Editable inputs -->
                                    <div class="panel panel-flat">
                                        <?php
                                        define("_SessionUserID_", $_SESSION['user_id']);
                                        define("_SessionIP_", $_SESSION['ip']);
                                        include('rmstatus.php');
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Road Memo table -->
                    <div class="col-lg-12">
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
                                    <span>Manage Masters</span>
                                    <ul class="icons-list">
                                        <li><a href="#" data-action="collapse"></a></li>
                                    </ul>
                                </div>
                                <div class="category-content">
                                    <div class="row row-condensed">
                                        <div class="col-xs-6">
                                            <button type="button" class="btn bg-teal-400 btn-block btn-float btn-float-sm" onclick="window.open('add_vehicle.php','_self');">
                                                <i class="icon-truck"></i> <span>Vehicle</span></button>
                                            <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-sm" onclick="window.open('add_transporter.php','_self');">
                                                <i class="icon-steering-wheel"></i> <span>Driver</span></button>
                                        </div>
                                        <div class="col-xs-6">
                                            <button type="button" class="btn bg-warning-400 btn-block btn-float btn-float-sm" onclick="window.open('add_consignee.php','_self');">
                                                <i class="icon-stats-bars"></i> <span>Dealer</span></button>
                                            <button type="button" class="btn bg-blue btn-block btn-float btn-float-sm"  onclick="window.open('warai.php','_self');">
                                                <i class="icon-cog3"></i> <span>Warai</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /actions -->
                        </div>
                    </div>
                    <!-- /secondary sidebar -->

                </div>


                <div class="col-lg-2 col-sm-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">View LR / Rm / Bill</h6>
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


                                    <!--                                        <button type="button" class="btn btn-info btn-xs" onclick="return displaylr(document.getElementById('show_lrno').value);">Submit</button>-->
                                    <button type="button" class="btn btn-info btn-xs" onclick="return displaylr(document.getElementById('show_lrno').value);">Submit</button>

                                </div>
                            </form>
                        </div>


                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control input-micro" type="text" placeholder="View RM" name="show_rmno" id="show_rmno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                </div>
                                <div class="col-sm-2 text-center">

                                    <!--                                    <a href="#modal_full" data-toggle='modal' class='modalButton2' data-teacherid="1" >-->
                                    <button type="button" class="btn btn-success btn-xs" onclick="return displayrm(document.getElementById('show_rmno').value);">Submit</button>
                                    <!--                                        </a>-->
                                </div>
                            </form>
                        </div>


                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <input class="form-control input-micro" type="text" placeholder="View Bill" name="show_billno" id="show_billno" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                </div>
                                <div class="col-sm-2 text-center">

                                    <a href="#modal_full" data-toggle='modal' class='modalButton3' data-teacherid="1" >
                                        <button type="button" class="btn btn-danger btn-xs">Submit</button></a>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>


                <div class="col-lg-2 col-sm-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Share a Problem</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                            <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

                        <div class="panel-body">
                            <form action="#">
                                <div class="form-group">
                                    <textarea name="enter-message" class="form-control mb-15" rows="3" cols="1" placeholder="Enter Details"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="icons-list icons-list-extended mt-10">
                                            <li><a href="#" data-popup="tooltip" title="Attach Image" data-container="body" data-original-title="Add photo"><i class="icon-images2"></i></a></li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-8 text-center">
                                        <button type="button" class="btn btn-primary btn-labeled btn-labeled-right">Email <b><i class="icon-circle-right2"></i></b></button>
                                    </div>
                                    <div class="col-sm-12">
                                        <hr>

                                        <p>Share Your problems with Admin</p>
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

<!-- Modal -->
<div id="modal_full" class="modal fade" style="font-weight: normal;">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php header("refresh:0; url=billentry_2.php"); ?>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $('.modalButton1').click(function(){
        var teacherid = $(this).attr('data-teacherid');
        var LRNumber=document.getElementById("show_lrno").value;
        $.ajax({url:"display_LRDetails.php?LRID="+LRNumber,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
</script>

<script>
    $('.modalButton2').click(function(){
        var teacherid = $(this).attr('data-teacherid');
        var RMNumber=document.getElementById("show_rmno").value;
        $.ajax({url:"display_RMDetails.php?RMID="+RMNumber,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
</script>

<script>
    $('.modalButton3').click(function(){
        var teacherid = $(this).attr('data-teacherid');
        var BillNumber=document.getElementById("show_billno").value;
        $.ajax({url:"display_BillDetails.php?BillID="+BillNumber,cache:false,success:function(result){
            $(".modal-content").html(result);
        }});
    });
</script>