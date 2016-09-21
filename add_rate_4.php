

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

	$ConsigneeID=$_REQUEST["ConsigneeID"];
	$ConsignorID=$_REQUEST["ConsignorID"];
	$session_userid=$_REQUEST["session_userid"];
	$session_ip=$_REQUEST["session_ip"];

//	echo("ConsigneeID :- $ConsigneeID </br>");
//	echo("ConsignorID :- $ConsignorID </br>");
//	echo("session_userid :- $session_userid </br>");
//	echo("session_ip :- $session_ip </br>");
//	die();

?>

<div class="col-lg-3">
	<div class="form-group">
		<label>Select Product <span class="text-danger">*</span></label>
			<select name="productid" id="productid"  class="form-control" onblur="return lrentry_disabled(this.value, 'productid');">
				<option></option>
				<?php
					Fill_ProductOnConsignor($con, $ConsignorID);
				?>
			</select>
	</div>
</div>