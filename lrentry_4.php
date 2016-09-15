<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/form_select2.js"></script>
<!-- /theme JS files -->

<?php
include_once('assets/inc/db_connect.php');
include_once('assets/inc/common-function.php');

if(!isset($_REQUEST["session_userid"])) {
	$UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
	$AccessingPage=basename(__FILE__); //"add_society.php";
	//			echo("UrlPage :- $UrlPage </br>");
	//			echo("AccessingPage :- $AccessingPage </br>");
	if(trim($UrlPage)==trim($AccessingPage)){
		header("Location: /login.php");
	}
}

	$Quantity=$_REQUEST["Quantity"];
	$Quantity==""?$Quantity=0:$Quantity=$Quantity;

	$session_userid=$_REQUEST["session_userid"];
	$session_ip=$_REQUEST["session_ip"];
	$consignorid=$_REQUEST["consignorid"];
	$consigneeid=$_REQUEST["consigneeid"];
	$productid=$_REQUEST["productid"];

	$MinimumRate=Get_MinimumRate($con, $consignorid, $consigneeid, $productid);
	$productrate=$_REQUEST["productrate"];
	$productrate==""?$productrate=0:$productrate=$productrate;

//    echo("Quantity :- $Quantity </br>");
//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//	echo("consignorid :- $consignorid </br>");
//	echo("consigneeid :- $consigneeid </br>");
//	echo("productid :- $productid </br>");
//	echo("productrate :- $productrate </br></br></br></br>");
//    die();


	$ShippingCharges=0;
	$ShippingCharges=$productrate*$Quantity;
	if ($ShippingCharges < $MinimumRate){
		$ShippingCharges=$MinimumRate;
		}
//	echo("ShippingCharges :- $ShippingCharges </br>");
//    die();


	$RoadExpenses=0;
	$RoadExpenses=Get_RoadExpenses($con);

	$BiltyCharge=0;
	$BiltyCharge=Get_BiltyCharge($con);
//	echo("BiltyCharge :- $BiltyCharge </br>");
//	die();

	$ServiceTaxAmount=0;
	$ServiceTax=0;
	$ServiceTaxApplicable=0;
	$ServiceTaxApplicable=Check_ServiceTaxApplicable($con, $consignorid);

	if($ServiceTaxApplicable>0) {
		$ServiceTax = Get_ServiceTax($con);
		$ServiceTaxAmount=($ShippingCharges*$ServiceTax)/100;
//		echo("ServiceTax :- $ServiceTax </br>");
//		echo("ServiceTaxAmount :- $ServiceTaxAmount </br>");
	}

	$lramount=0;
	$lramount=$ShippingCharges+$BiltyCharge+$ServiceTaxAmount;
	$lramount=number_format((float)$lramount, 2, '.', '');
//	echo("lramount :- $lramount </br>");
//	die();

?>

	<div class="col-md-3">
		<div class="form-group form-group-material">
			<label>Shiping Charges </label>
			<div class="input-group">
				<input type="hidden" class="form-control" name="shippingcharge" id="shippingcharge" disabled value="<?php echo $ShippingCharges;?>">
				<input type="text" class="form-control" name="roadexpense" id="roadexpense" disabled value="<?php echo $RoadExpenses;?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
				<span class="input-group-addon"><img src="assets/images/rupees-128.png" height="15" width="15"></span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-material">
			<label>Bilty Charges </label>
			<div class="input-group">
				<input type="text" class="form-control" name="biltycharge" id="biltycharge" disabled value="<?php echo $BiltyCharge;?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
				<span class="input-group-addon"><img src="assets/images/rupees-128.png" height="15" width="15"></span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-material">
			<label>Photocopy Charges </label>
			<div class="input-group">
				<input type="text" class="form-control" name="servicetax" id="servicetax" value="<?php echo $ServiceTaxAmount;?>" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;" onblur="return lradditionalcharge1(1, 'servicetax');">
				<span class="input-group-addon"><img src="assets/images/rupees-128.png" height="15" width="15"></span>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		document.getElementById("lramount").value="<?php echo $lramount;?>";
		document.getElementById("paidlramount").value="<?php echo $lramount;?>";
		document.getElementById("div_paidlramount").innerHTML="<?php echo $lramount;?>";
	</script>
