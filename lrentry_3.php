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

	$packageType=$_REQUEST["packageType"];
	$session_userid=$_REQUEST["session_userid"];
	$session_ip=$_REQUEST["session_ip"];
	$consignorid=$_REQUEST["consignorid"];
	$consigneeid=$_REQUEST["consigneeid"];
	$productid=$_REQUEST["productid"];


//    echo("packageType :- $packageType </br>");
//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//	echo("consignorid :- $consignorid </br>");
//	echo("consigneeid :- $consigneeid </br>");
//	echo("productid :- $productid </br>");
//    die();

	$ProductRate=Get_ProductRate($con, $consignorid, $consigneeid, $productid, $packageType);
//	echo("ProductRate :- $ProductRate </br>");
//	die();

?>
<div class="col-md-3">
	<div class="form-group form-group-material">
		<label>Rate </label>
		<div class="input-group">
			<input type="text" class="form-control" name="productrate" id="productrate" disabled value="<?php echo $ProductRate; ?>">
				<span class="input-group-addon">
					<img src="assets/images/rupees-128.png" height="15" width="15">
				</span>
		</div>
	</div>
</div>