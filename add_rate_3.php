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
$ConsignorID=$_REQUEST["ConsignorID"];
$session_userid=$_REQUEST["session_userid"];
$session_ip=$_REQUEST["session_ip"];

//    echo("ConsignorID :- $ConsignorID </br>");
//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//    die();
//onchange="return get_productOnConsignee(this.value, < ? p h pecho $ConsignorID; ? > , < ? p h pecho $session_userid; ? >, '< ? p h p echo $session_ip; ? >');">
?>
<div class="form-group">
	<label>Consignee</label>
	<div class="input-group">
		<select name="consigneeid" id="consigneeid" class="form-control" onblur="return control_disabled(this.value, 'consigneeid');">
			<option value="0">All</option>
				<?php
					Fill_Consignee($con, $ConsignorID);
				?>
		</select><i></i>
		<span class="input-group-addon">
			<i class="icon-truck"></i>
		</span>
	</div>
</div>
