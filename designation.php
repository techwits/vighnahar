<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Designation Entry</title>

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


</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Form actions -->
                <h6 class="content-group text-semibold">
                    Master Entry
                    <small class="display-block">Designation</small>
                </h6>

                <div class="row">


                    <div class="col-md-4">
                        <form class="form-horizontal form-validate-jquery" name="designation" id="designation" action="#">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Create Designation</h6>
                                </div>

                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Designation Name <span class="text-danger">*</span></label>
                                        <input type="text" name="designation" id="designation" class="form-control" required="required">
                                    </div>

                                    <div class="form-group">
                                        <label>Designation Encryption <span class="text-danger">*</span></label>
                                        <input type="text" name="designationencryption" id="designationencryption" class="form-control" required="required">
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn bg-teal-400" onclick="return add_designation();">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>
                                <div id="div_designation"></div>
                            </div>
                        </form>
                    </div>


                </div>
                <!-- /form actions -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /content wrapper -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
