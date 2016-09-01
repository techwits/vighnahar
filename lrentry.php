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
	<title>Lorry Receipt Entry</title>

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


	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
	<!-- /theme JS files -->

	<script type="text/JavaScript" src="assets/js/search/search.js"></script>

</head>

<body class="navbar-top">

<!-- Main navbar -->
<?php
	$PageHeaderName="Add Lorry Receipt";
	$icon="icon-address-book";

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
				<div class="col-sm-10 col-md-10 col-lg-10 col-lg-10 col-lg-offset-1">
					<form name="lrentry_form" id="lrentry_form" action="#">
						<input type="hidden" name="session_userid" id="session_userid" value="<?php echo $_SESSION['user_id']; ?>">
						<input type="hidden" name="session_ip" id="session_ip" value="<?php echo $_SESSION['ip']; ?>">
						<input type="hidden" name="AddEdit" id="AddEdit" value="0">
						<div id="<?php echo $div_merchantcontrols; ?>" class="panel panel-flat" style="border-color:<?php echo $Form_BorderColor; ?>; border-top-width:<?php echo $Form_BorderTopWidth; ?>;">

							<div class="panel-heading" id="<?php echo $div_panel; ?>" style="background-color:<?php echo $FormHeadingColor; ?>;">
								<h5 class="panel-title"><i class="icon-newspaper position-left"></i> <span class="text-semibold" id="<?php echo $span_pageName; ?>"><?php echo $PageHeaderName; ?></h5>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload" onclick="return ClearAllControls(0);"></a></li>
									</ul>
								</div>
							</div>

							<div class="panel-body" style="margin-top:15px;">


								<div class="row">
									<div class="col-md-2 col-lg-offset-4">
										<div class="form-group form-group-material">
											<label>Financial Year <span class="text-danger">*</span></label>
											<div>
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
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group form-group-material">
											<label>Date <span class="text-danger">*</span></label>
											<div class="content-group-lg">
												<div class="input-group">
													<input type="hidden" class="form-control daterange-single"  name="todaysdate" id="todaysdate" required="required">
													<input type="text" class="form-control daterange-single"  name="lrdate" id="lrdate" required="required">
													<span class="input-group-addon"><i class="icon-calendar22"></i></span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-2 text-center col-lg-offset-1">
										<div class="label label-danger" style="padding: 15px; font-size:24px;">
											<input type="hidden" class="form-control" name="lramount" id="lramount" value="">
											<input type="hidden" class="form-control" name="paidlramount" id="paidlramount" disabled required="required" value="">
											<span id="div_paidlramount">0</span>
										</div>
									</div>
								</div>



								<div class="row extra-bottom-padding">
									<div class="col-md-3">
										<div class="form-group form-group-material">
											<label>Invoice / Challan No. <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" name="invoicenumber" id="invoicenumber" autofocus required="required">
                                                        <span class="input-group-addon">
                                                    		<i class="icon-profile"></i>
                                                    	</span>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-group-material">
											<label>Truck Number </label>
											<div class="input-group">
												<select name="vehicleid" id="vehicleid" class="form-control" onblur="return lrentry_disabled(this.value, 'vehicleid');">
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
											<label>Consignor <span class="text-danger">*</span></label>
											<div class="input-group">
												<select name="consignorid" id="consignorid" required="required"  class="form-control" onblur="return get_consignee(this.value, <?php echo $_SESSION['user_id']; ?>, '<?php echo $_SESSION['ip']; ?>');">
													<option></option>
													<?php
													Fill_Consignor($con);
													?>
												</select>
												<span class="input-group-addon">
                                                    <i class="icon-user-check"></i>
                                                </span>
											</div>
										</div>
									</div>
									<div class="col-md-3" id="div_consignee">
										<div class="form-group form-group-material">
											<label>Consignee <span class="text-danger">*</span></label>
											<div class="input-group">
												<select name="consigneeid" id="consigneeid" required="required"  class="form-control">
													<option></option>
												</select>
												<span class="input-group-addon">
													<i class="icon-users2"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3" id="div_product">
										<div class="form-group form-group-material">
											<label>Product <span class="text-danger">*</span></label>
											<div class="input-group">
												<select name="productid" id="productid" required="required"  class="form-control" onblur="return lrentry_disabled(this.value, 'productid');">
													<option></option>
												</select>
														<span class="input-group-addon">
															<i class="icon-cart-add2"></i>
														</span>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-group-material">
											<label>Package Type <span class="text-danger">*</span></label>
											<div class="input-group">
												<select name="packagetype" id="packagetype" required="required" class="form-control" onblur="return get_productRate(this.value, <?php echo $_SESSION['user_id']; ?>, '<?php echo $_SESSION['ip']; ?>');">
													<option></option>
														<option value="CartoonRate">CartoonRate</option>
														<option value="ItemRate">ItemRate</option>
												</select>
												<span class="input-group-addon">
													<i class="icon-package"></i>
												</span>
											</div>
										</div>
									</div>

									<div class="col-md-3" id="div_productrate">
										<div class="form-group form-group-material">
											<label>Rate <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" required="required" name="productrate" id="productrate" disabled>
												<span class="input-group-addon">
													<img src="assets/images/rupees-128.png" height="15" width="15">
												</span>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group form-group-material">
											<label>Quantity <span class="text-danger">*</span></label>
											<div class="input-group">
												<input type="text" class="form-control" required="required" name="qauntity" id="qauntity" onblur="return get_quantityRate(this.value, <?php echo $_SESSION['user_id']; ?>, '<?php echo $_SESSION['ip']; ?>');" onkeypress="return only_Numeric(event);" ondrop="return false;" onpaste="return false;">
												<span class="input-group-addon">
													<i class="icon-seven-segment-8"></i>
												</span>
											</div>
										</div>
									</div>
								</div>



								<div class="row">
									<div id="div_quantityrate">
										<div class="col-md-3">
											<div class="form-group form-group-material">
												<label>Shiping Charges <span class="text-danger">*</span></label>
												<div class="input-group">
													<input type="text" class="form-control" required="required" name="shippingcharge" id="shippingcharge" value="" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
													<span class="input-group-addon">
														<img src="assets/images/rupees-128.png" height="15" width="15">
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-group-material">
												<label>Bilty Charges </label>
												<div class="input-group">
													<input type="text" class="form-control" name="biltycharge" id="biltycharge" value="" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
													<span class="input-group-addon">
														<img src="assets/images/rupees-128.png" height="15" width="15">
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group form-group-material">
												<label>Serice Tax </label>
												<div class="input-group">
													<input type="text" class="form-control" name="servicetax" id="servicetax" value="" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
													<span class="input-group-addon">
														<img src="assets/images/rupees-128.png" height="15" width="15">
													</span>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3" style=" margin-top:30px">
										<label class="checkbox-inline">
											<div class="checker">
                                            <span class="checked">
                                            	<input type="checkbox" class="styled" name="additionalcharges" id="additionalcharges" onchange="return displayAdditionalCharges(<?php echo $_SESSION['user_id']; ?>, '<?php echo $_SESSION['ip']; ?>');");>
                                            </span>
											</div>
											Additional Charges
										</label>
										<input type="hidden" class="form-control" name="additionalchargesentry" id="additionalchargesentry" value="">
									</div>

								</div>


								<div class="row">
									<div id="div_additionalcharges">

									</div>
								</div>

								<div id="divToPrint" style="display:none;">
									
								</div>

								<div class="panel-footer">
									<div class="col-md-12">
										<div class="text-right">
											<button type="submit" name="submit" id="submit" class="btn bg-grey-600" onclick="return add_lrentry();"><span class="text-semibold" id="<?php echo $span_pageButton; ?>">Submit</span></button>
										</div>
									</div>
									<div id="div_lrentry"></div>
								</div>

							</div>
						</div>
					</form>
				</div>
				</div>


			<div class="row">
				<div class="col-sm-10 col-md-10 col-lg-10 col-lg-10 col-lg-offset-1">

					<!-- Search field -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title"><i class="icon-search4 text-size-base"></i> Search</h6>
						</div>

						<?php include('lrentry_6.php'); ?>


						<!-- Basic datatable -->
						<div class="panel-heading" id="div_searchlrentry">
							<?php include('lrentry_7.php'); ?>
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
