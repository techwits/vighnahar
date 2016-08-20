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
    <title>Login / User Entry</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
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
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/autosize.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/formatter.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/typeahead/handlebars.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/passy.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/inputs/maxlength.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_controls_extended.js"></script>

    <script type="text/JavaScript" src="assets/js/search/search.js"></script>
    <script type="text/JavaScript" src="assets/js/sha512.js"></script>

    <!-- /theme JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/core/libraries/jquery_ui/full.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
    <!-- /theme JS files -->



</head>

<body>

<!-- Main navbar -->
<?php
$PageHeaderName="Add Login Users";
$EntryToday=2345;
$EntryWeek=5364;
$EntryMonth=9546;
$EntryTillDate=9957;

include('page_header.php');

$php_page=basename(__FILE__);
$get_return_value=login_check($con, $php_page);
include_once("assets/inc/handle_error.php");

//		mysqli_close($con);
log_pageaccess($con, $_SESSION["pageid"], basename(__FILE__));
//		mysqli_close($con);
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
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <form name="login_form" id="login_form" action="#">
                        <input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
                        <input type="hidden" name="AddEdit" id="AddEdit" value="0">
                        <div id="div_merchantcontrols" class="panel panel-flat">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group form-group-material">
                                            <label>User Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="username" id="username"  required="required" autofocus onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group form-group-material">
                                            <label>User ID <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="userid" id="userid"  required="required" autofocus onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group form-group-material">
                                            <label>User Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="userpassword" id="userpassword"  required="required" autofocus onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group form-group-material">
                                            <label>User Designation <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="designation" id="designation" data-placeholder="Select a Designation..." class="select" required="required">
                                                    <option value=""></option>
                                                    <?php
                                                    Fill_Designation($con)
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-default" onclick="return ClearAllControls(0);">Reset <i class="icon-reload-alt position-right"></i></button>
                                            <button type="submit" class="btn bg-teal-400" onclick="return add_login();">Submit form <i class="icon-arrow-right14 position-right"></i></button>

                                        </div>
                                    </div>

                                </div>
                                <div id="div_login"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">

                    <!-- Search field -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Search</h6>
                        </div>

                        <?php include('add_login_1.php'); ?>


                        <!-- Basic datatable -->
                        <div class="panel-heading" id="div_searchlogin">
                            <?php include('add_login_2.php'); ?>
                            <div/>
                            <!-- /basic datatable -->
                        </div>

                        <!-- /search field -->
                    </div>
                </div>
            </div>

            <!-- /form actions -->

        </div>
        <!-- /content wrapper -->

    </div>
    <!-- /page content -->


    <!-- Footer -->
    <div class="navbar navbar-inverse navbar-sm navbar-fixed-bottom">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i class="icon-circle-up2"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-second">
            <div class="navbar-text">
                &copy; 2015.
                <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
            </div>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="#">Help center</a></li>
                    <li><a href="#">Policy</a></li>
                    <li><a href="#" class="text-semibold">Upgrade your account</a></li>

                </ul>
            </div>
        </div>
    </div>



    <!-- /footer -->

</div>
<!-- /page container -->

</body>
</html>
