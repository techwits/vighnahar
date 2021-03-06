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
	<title>Page Name Entry</title>

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
	<script type="text/javascript" src="assets/js/pages/datatables_api_2columns.js"></script>

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
		$PageHeaderName="Manage Page name";
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
					<div class="col-sm-8 col-md-8 col-lg-8">
						<form name="menu_form" id="menu_form" action="#">
							<input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
							<input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
							<input type="hidden" name="AddEdit" id="AddEdit" value="0">
							<div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-default" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

								<div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
									<h5 class="panel-title"><i class="icon-stack position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<li><a data-action="reload" onclick="return refreshpage(0);"></a></li>
										</ul>
									</div>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Page Name <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="menuname" id="menuname"  required="required" autofocus onkeypress="return only_Alpha_Numeric_underscore_dot(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-libreoffice"></i>
                                                    </span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Page Name Description <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="pagedescription" id="pagedescription"  required="required" autofocus onkeypress="return only_Alpha_Numeric_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-file-text"></i>
                                                    </span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="panel-footer">
									<div class="col-md-12">
										<div class="text-right">
											<button type="button" name="submit" id="submit" class="btn btn-primary heading-btn pull-right" onclick="return add_menu();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
										</div>
									</div>
									<div id="div_menu"></div>
								</div>
							</div>
						</form>
					</div>
                    <div class="col-lg-4">

						<!-- Search field -->
						<div class="panel panel-flat" style="border-color:<?php echo $Search_BorderColor; ?>; border-top-width:<?php echo $Search_BorderTopWidth; ?>;">
							<div class="panel-heading" style="background-color:<?php echo $SearchHeadingColor; ?>;">
								<h5 class="panel-title"><i class="icon-search4 text-size-base"></i> <span class="text-semibold"><?php echo $SearchPageHeading; ?></h5>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload" onclick="return refreshpage(0);"></a></li>
									</ul>
								</div>
							</div>
								<?php include('add_pages_1.php'); ?>
							<!-- Basic datatable -->
							<div class="panel-heading" id="div_searchmenu">
								<?php include('add_pages_2.php'); ?>
							<div/>
							<!-- /basic datatable -->
						</div>
						<!-- /search field -->
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
