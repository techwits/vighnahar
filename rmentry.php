<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');
    include('assets/inc/functions.php');
    sec_session_start();
    $Area=Fill_LRForJS($con);
    //		echo("</br></br></br></br></br></br></br></br></br></br></br> Area :- $Area </br>");
    $Area="[".$Area."]";
    $vals=$Area;
    mysqli_close($con);
    include('assets/inc/db_connect.php');
    //		echo("</br></br></br></br></br></br></br></br></br></br></br> Area :- $Area </br>");
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Merchant Entry</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/fontawesome/fonts/styles.min.css" rel="stylesheet" type="text/css">
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

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/picker_date.js"></script>
    <!-- /theme JS files -->


    <!-- Theme JS files -->
        <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

        <script type="text/javascript" src="assets/js/core/app.js"></script>

    <!-- /theme JS files -->


    <!-- Javascript dropdown list functions-->
    <script type="text/javascript">
        var area=<?php echo $vals;?>;
    </script>

    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/autosize.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/handlebars.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/passy.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/maxlength.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/form_controls_extended.js"></script>
    <!-- Javascript dropdown list functions-->

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>
    <script type="text/JavaScript" src="assets/js/sha512.js"></script>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
    $PageHeaderName="Road Receipt Entry";
    $icon="icon-address-book";

    include('page_header.php');

    $php_page=basename(__FILE__);
    $get_return_value=login_check($con, $php_page);
    include_once("assets/inc/handle_error.php");
    log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
    include_once('assets/inc/db_connect.php');


?>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">



            <!-- Form actions -->
            <div class="row">
                <div class="col-sm-10 col-md-10 col-lg-10 col-lg-10 col-lg-offset-1">
                    <form name="rmentry_form" id="rmentry_form" action="#">
                        <input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
                        <input type="hidden" name="AddEdit" id="AddEdit" value="0">

                        <div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-flat" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

                            <div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
                                <h5 class="panel-title"><i class="icon-user-tie position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload" onclick="return ClearAllControls(0);"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body" style="margin-top:15px;">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group form-group-material">
                                            <label>Select Vehicle Number </label>
                                            <div class="input-group">
                                                <?php
                                                    $CYear=date("Y");
                                                    $CMonth=date("m");
                                                    if($CMonth<4){
                                                        $CYear=$CYear-1;
                                                    }
                                                    $FinancialYear_C=Get_FinancialYear($con, $CYear);
                                                    //														echo("FinancialYear :- $FinancialYear </br>");
                                                    $FinancialYear_P=$FinancialYear_C-1;
                                                ?>
                                                    <select name="financialyear" id="financialyear" class="form-control" required="required">
                                                        <?php
                                                            Fill_FinancialYear($con, $FinancialYear_P, $FinancialYear_C);
                                                        ?>
                                                    </select>
												<span class="input-group-addon">
                                                    <i class="icon-truck"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group form-group-material">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <div class="content-group-lg">
                                                <div class="input-group">
                                                    <input type="hidden" class="form-control daterange-single"  name="todaysdate" id="todaysdate" required="required">
                                                    <input type="text" class="form-control daterange-single"  name="rmdate" id="rmdate" required="required">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group form-group-material">
                                            <label>Select Vehicle Number <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="vehicleid" id="vehicleid" class="form-control" autofocus onblur="return lrentry_disabled(this.value, 'vehicleid');">
                                                    <option></option>
                                                    <?php
                                                        $TableName="vehicle_master";
                                                        $ColumnName="vmid, VehicleNumber";
                                                        $OrderBy="VehicleNumber";
                                                        Fill_Master($con, $TableName, $ColumnName, $OrderBy);
                                                    ?>
                                                </select>
												<span class="input-group-addon">
                                                    <i class="icon-truck"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group form-group-material">
                                            <label>Select Driver <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="transporterid" id="transporterid" class="form-control" onblur="return lrentry_disabled(this.value, 'transporterid');">
                                                    <option></option>
                                                    <?php
                                                        $TableName=" transporter_master";
                                                        $ColumnName="tmid, TransporterName";
                                                        $OrderBy="TransporterName";
                                                        Fill_Master($con, $TableName, $ColumnName, $OrderBy);
                                                    ?>
                                                </select>
												<span class="input-group-addon">
                                                    <i class="icon-truck"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-lg-offset-4">
                                        <form class="form-horizontal">
                                            <div class="form-group form-group-material">
                                                <label class="col-sm-3 control-label" style=" font-size:18px;">LR No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control typeahead-basic" name="lrno" id="lrno" onkeyup="return fill_rmtable(event, this.value);" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;" style="border: 1px solid black; float: left; border-top: 0px; border-left: 0px; border-right: 0px; margin: 0; padding: 0; font-size:24px;">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form class="form-horizontal">
                                            <div class="form-group form-group-material">
                                                <div class="col-sm-9">
                                                    <input type="hidden" name="lrid_list" id="lrid_list">
                                                    <input type="hidden" name="lrid_list1" id="lrid_list1">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="panel-footer">-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="text-right">-->
<!--                                        <button type="button" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_merchant();"><span class="text-semibold" id="--><?php //echo $span_pageButton; ?><!--">Submit</span></button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div id="div_merchant"></div>-->
<!--                            </div>-->
                        </div>
                    </form>
                </div>
            </div>




    <div class="row">
        <div class="col-sm-10 col-md-10 col-lg-10 col-lg-10 col-lg-offset-1">

            <div class="panel-body">
                <div class="tabbable tab-content-bordered">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="active"><a href="#bordered-tab1" data-toggle="tab">Lorry Receipt</a></li>
                        <li><a href="#bordered-tab2" data-toggle="tab">Search / Update Road Memo</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane has-padding active" id="bordered-tab1">
                            <form name="search_menu" action="#" class="main-search">
                                <div class="row" id="div_lrlisttable">
                                    <?php include('rmentry_1.php'); ?>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane has-padding" id="bordered-tab2">
                            <form name="search_menu" action="#" class="main-search">
                                <div class="row" id="div_lrlisttable">


                                    <!-- Search field -->

                                    <div class="col-lg-6">
                                        <div class="panel panel-flat" style="border-color:<?php echo $Search_BorderColor; ?>; border-top-width:<?php echo $Search_BorderTopWidth; ?>;">
                                            <div class="panel-heading" style="background-color:<?php echo $SearchHeadingColor; ?>;">
                                                <h5 class="panel-title"><i class="icon-search4 text-size-base"></i> <span class="text-semibold"><?php echo $SearchPageHeading; ?></h5>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload" onclick="return ClearAllControls(0);"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                                    <?php include('rmentry_2.php'); ?>
                                            <!-- Basic datatable -->
                                                <div class="panel-heading" id="div_searchroadmemo">
                                                    <?php include('rmentry_3.php'); ?>
                                                <div/>
                                                <!-- /basic datatable -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /search field -->


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



            <!-- /form actions -->
        </div>
        <!-- /content wrapper -->
    </div>
    <!-- /page content -->
    <?php include('footer.php'); ?>
</div>
<!-- /page container -->
</body>
</html>
