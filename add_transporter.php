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
	<title>Transporter Entry</title>

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
		$PageHeaderName="Manage Transporter";
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
						<form name="transporter_form" id="transporter_form" action="#">
							<input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
							<input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
							<input type="hidden" name="AddEdit" id="AddEdit" value="0">
							<div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-default" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

								<div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
									<h5 class="panel-title"><i class="icon-steering-wheel position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
									<div class="heading-elements">
										<ul class="icons-list">
											<li><a data-action="collapse"></a></li>
											<li><a data-action="reload" onclick="return refreshpage(0);"></a></li>
										</ul>
									</div>
								</div>

								<div class="panel-body" style="margin-top:15px;">
									<div class="row">
											<div class="col-lg-6">
												<div class="form-group form-group-material">
													<label>Transporter Name <span class="text-danger">*</span></label>
													<div class="input-group">
														<input type="text" class="form-control" name="transportername" id="transportername" autofocus required="required" onkeypress="return only_Alpha_Space(event);" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
														<i class="icon-user"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group form-group-material">
													<label>Address </label>
													<div class="input-group">
														<input type="text" class="form-control" name="address" id="address" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
																<i class="icon-road"></i>
															</span>
													</div>
												</div>
											</div>
									</div>

									<div class="row">
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Mobile Number <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" maxlength="10"  required="required" onkeypress="return only_Numeric_Comma(event);" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
																<i class="icon-phone"></i>
															</span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Licence Number </label>
												<div class="input-group">
													<input type="text" class="form-control" name="licencenumber" id="licencenumber"  onkeypress="return only_Alpha_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    		<i class="icon-credit-card"></i>
                                                    	</span>
												</div>
											</div>
										</div>
									</div>
								</div>
                                	<div class="panel-footer">
										<div class="col-md-12">
											<div class="text-right">
												<button type="button" name="submit" id="submit" class="btn btn-primary heading-btn pull-right" onclick="return add_transporter();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
											</div>
										</div>
										<div id="div_transporter"></div>
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
								<?php include('add_transporter_1.php'); ?>
							<!-- Basic datatable -->
							<div class="panel-heading" id="div_searchtransporter">
								<?php include('add_transporter_2.php'); ?>
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
		<?php include('footer.php'); ?>
	</div>
	<!-- /page container -->

</body>
</html>
