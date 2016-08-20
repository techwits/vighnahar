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

	$session_userid=$_REQUEST["session_userid"];
	$session_ip=$_REQUEST["session_ip"];
	$additionalcharges_tick=$_REQUEST["additionalcharges_tick"];


	$AdditionalChargeList=Get_AdditionalChargeList($con);
	$Split_AdditionalChargeList = explode("||", $AdditionalChargeList);


//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//	echo("additionalcharges_tick :- $additionalcharges_tick </br>");
//	echo("Split_AdditionalChargeList0 :- $Split_AdditionalChargeList[0] </br>");
//	echo("Split_AdditionalChargeList1 :- $Split_AdditionalChargeList[1] </br>");
//	die();


	$sqlQry= "select ChargeName, ChargeFix, acmid from additionalcharge_master ";
	$sqlQry= $sqlQry." where acmid>3";
	$sqlQry= $sqlQry." and Active=1";
	$sqlQry= $sqlQry." order by acmid";
//	echo ("Check sqlQry :- $sqlQry </br>");
//	die();
	unset($con);
	include('assets/inc/db_connect.php');
	$result = mysqli_query($con, $sqlQry);
	if (mysqli_num_rows($result)!=0)
	{
		$j=0;
		$additionalchargesentry="";
		while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
		{
			$db_ChargeName=$row{0};
			$db_ChargeFix=$row{1};
			$db_acmid=$row{2};
			$controlname=$db_acmid;
//			echo("controlname :- $controlname </br>");
//			echo("db_ChargeFix :- $db_ChargeFix </br>");
			$j=$j+1;
			$j==1?$additionalchargesentry=$db_acmid."~".$db_ChargeFix:$additionalchargesentry=$additionalchargesentry."||".$db_acmid."~".$db_ChargeFix;
			?>
				<div class="col-md-3">
					<div class="form-group form-group-material">
						<label><?php echo $db_ChargeName;?> </label>
						<div class="input-group">
							<input type="text" class="form-control" name="<?php echo $controlname;?>" id="<?php echo $controlname;?>" value="<?php echo $db_ChargeFix;?>" onblur="return lradditionalcharge('<?php echo $Split_AdditionalChargeList[0];?>', '<?php echo $Split_AdditionalChargeList[1];?>');">
							<span class="input-group-addon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
			<?php

		}
	}
	mysqli_free_result($result);
?>
<script type="text/javascript">
		document.getElementById("additionalchargesentry").value = '<?php echo $additionalchargesentry; ?>';
</script>
