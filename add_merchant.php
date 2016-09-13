<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include('assets/inc/db_connect.php');
		include('assets/inc/common-function.php');
		include('assets/inc/functions.php');
		sec_session_start();
		$Area=Fill_AreaForJS($con);
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
		$PageHeaderName="Manage Merchant";
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
						<form name="merchant_form" id="merchant_form" action="#">
							<input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
							<input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
							<input type="hidden" name="AddEdit" id="AddEdit" value="0">
							<input type="hidden" name="AddEdit1" id="AddEdit1" value="0">
							<div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-flat" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

								<div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
									<h5 class="panel-title"><i class="icon-user-tie position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
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
												<label>Name <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="companyname" id="companyname"  required="required" autofocus onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
															<i class="icon-office"></i>
														</span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Office Address <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="address" id="address" required="required" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    		<i class="icon-road"></i>
                                                    	</span>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-4">
											<div class="form-group form-group-material">
												<label>Area <span class="text-danger">*</span> </label>
												<div class="input-group">
<!--													<input type="text" class="form-control" name="area" id="area" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;">-->
													<input type="text" class="form-control typeahead-basic" placeholder="Enter Area" name="area" id="area" required="required" onkeypress="return only_Alpha_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
															<i class="icon-location4"></i>
														</span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>Pincode <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="pincode" id="pincode" maxlength="6" required="required" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    		<i class="icon-location3"></i>
                                                    	</span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>City <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="city" id="city" required="required" onkeypress="return only_Alpha_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    		<i class="icon-city"></i>
                                                    	</span>
												</div>
											</div>
										</div>
									</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group form-group-material">
													<label>Person <span class="text-danger">*</span> </label>
													<div class="input-group">
														<input type="text" class="form-control" name="person" id="person" required="required" onkeypress="return only_Alpha_Space(event);" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
																<i class="icon-user"></i>
															</span>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-group-material">
													<label>Pancard Number <span class="text-danger">*</span> </label>
													<div class="input-group">
														<input type="text" class="form-control" name="panno" id="panno" required="required" onkeypress="return only_Alpha_Numeric(event);" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
																<i class="icon-credit-card"></i>
															</span>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group form-group-material">
													<label>Telephone <span class="text-danger">*</span> </label>
													<div class="input-group">
														<input type="text" class="form-control" name="telephone" id="telephone" required="required" onkeypress="return only_Numeric_Comma(event);" ondrop="return false;" onpaste="return false;">
															<span class="input-group-addon">
																<i class="icon-phone"></i>
															</span>
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-group-material">
													<label>Email <span class="text-danger">*</span> </label>
													<div class="input-group">
														<input type="email" class="form-control" name="email" id="email" required="required">
															<span class="input-group-addon">
																<i class="icon-mail5"></i>
															</span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group form-group-material">
													<label>Website <span class="text-danger">*</span> </label>
													<div class="input-group">
														<input type="text" class="form-control" name="url" id="url" required="required">
															<span class="input-group-addon">
																<i class="icon-sphere"></i>
															</span>
													</div>
												</div>
											</div>
										</div>

								</div>
								<div class="panel-footer">
									<div class="col-md-12">
										<div class="text-right">
											<button type="button" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_merchant();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
										</div>
									</div>
									<div id="div_merchant"></div>
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
								<?php include('add_merchant_1.php'); ?>
							<!-- Basic datatable -->
							<div class="panel-heading" id="div_searchmerchant">
								<?php include('add_merchant_2.php'); ?>
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
