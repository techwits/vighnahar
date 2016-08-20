<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include('assets/inc/db_connect.php');
		include('assets/inc/common-function.php');
		include('assets/inc/functions.php');
		sec_session_start();

		$vals="'Sachin', 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California'";
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Merchant Entry</title>

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
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<script type="text/javascript">
		//			'Sachin', 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California','Colorado'
//		var dbdata="'Sachin', 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California'";
		var states1 = [<?php echo $vals; ?>];
	</script>

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

	<!-- /theme JS files -->

		<script type="text/JavaScript" src="assets/js/search/search.js"></script>
		<script type="text/JavaScript" src="assets/js/sha512.js"></script>

</head>

<body>

	<!-- Main navbar -->
	<?php
		$PageHeaderName="Manage Merchant";
		$icon="icon-address-book";
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
						<form name="merchant_form" id="merchant_form" action="#">
							<input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
							<input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
							<input type="hidden" name="AddEdit" id="AddEdit" value="0">
							<input type="hidden" name="AddEdit1" id="AddEdit1" value="0">
							<div id="div_merchantcontrols" class="panel panel-flat">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Name <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" name="companyname" id="companyname"  required="required" autofocus onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Office Address <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="address" id="address" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group form-group-material">
												<label>Area <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="area" id="area" required="required" onkeypress="return only_Alpha_Numeric_Apostrophy_Space(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>

										<div class="content-group-lg">
											<h6 class="text-semibold">Basic usage</h6>
											<p class="content-group-sm">When initializing a typeahead, you pass the plugin method one or more datasets. The source of a dataset is responsible for computing a set of suggestions for a given query.</p>
											<input type="text" class="form-control typeahead-basic" placeholder="States of USA">
										</div>


									</div>


									<div class="row">
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>Pincode <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="pincode" id="pincode" required="required" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
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
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>Telephone <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="telephone" id="telephone" required="required" onkeypress="return only_Numeric_Comma(event);" ondrop="return false;" onpaste="return false;">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>Email <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="email" class="form-control" name="email" id="email" required="required">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-group-material">
												<label>Website <span class="text-danger">*</span> </label>
												<div class="input-group">
													<input type="text" class="form-control" name="url" id="url" required="required">
                                                        <span class="input-group-addon">
                                                    <i class="icon-user"></i>
                                                    </span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="panel-footer">
									<div class="col-md-12">
										<div class="text-right">
											<button type="button" class="btn btn-default" id="resetasas" onclick="return ClearAllControls(0);">Reset <i class="icon-reload-alt position-right"></i></button>
											<button type="submit" class="btn btn-primary" onclick="return add_merchant();">Submit <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</div>
									<div id="div_merchant"></div>
								</div>
							</div>
						</form>
					</div>
                    <div class="col-lg-4">

						<!-- Search field -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title"><i class="icon-search4 text-size-base"></i> Search</h6>
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
