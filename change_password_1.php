<!-- Theme JS files -->
	<script type="text/JavaScript" src="assets/js/search/search.js"></script>
	<script type="text/JavaScript" src="assets/js/sha512.js"></script>
	<script type="text/JavaScript" src="assets/js/forms.js"></script>
<!-- /theme JS files -->

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



<?php
include('assets/inc/db_connect.php');
include('assets/inc/common-function.php');

if(!isset($_REQUEST["session_userid"])) {
	$UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
	$AccessingPage=basename(__FILE__); //"add_society.php";
	//			echo("UrlPage :- $UrlPage </br>");
	//			echo("AccessingPage :- $AccessingPage </br>");
	if(trim($UrlPage)==trim($AccessingPage)){
		header("Location: /login.php");
	}
}

 	$error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');
    $AddEdit=$_REQUEST["AddEdit"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];
	$userid=$_REQUEST["userid"];

//    echo("AddEdit :- $AddEdit </br>");
//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//    echo("userid :- $userid </br>");
//	die();

	$UserID=Check_UserID($con, $userid);
	if($UserID>0){
		?>
			<script type="text/JavaScript">
				document.getElementById("AddEdit").value=<?php echo $UserID; ?>;
			</script>
				<input type="hidden" name="AddEdit" id="AddEdit" value="<?php echo $UserID;?>">
				<input type="hidden" name="userid1" id="userid1" value="<?php echo $userid;?>">
				<input type="hidden" name="session_userid1" id="session_userid1" value="<?php echo $session_userid;?>">
				<input type="hidden" name="session_ip1" id="session_ip1" value="<?php echo $session_ip;?>">

		<div class="form-group">
				<div class="input-group group-indicator">
					<input type="password" class="form-control" placeholder="Enter your password" name="userpassword" id="userpassword" autofocus>
					<span class="input-group-addon password-indicator-group">No password</span>
				</div>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary btn-block" onclick="return changepassword_change();">Generate New Password <i class="icon-circle-right2 position-right"></i></button>
			</div>
		<?php
	}
	else{
		echo("User ID does not exist. Please check........");
	}

?>