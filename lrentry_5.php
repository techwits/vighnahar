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
	$lramount=$_REQUEST["lramount"];
	$servicetax=$_REQUEST["servicetax"];
	if($servicetax==""){
		$servicetax=0;
	}

	$AdditionalChargeList=Get_AdditionalChargeList($con);
	$Split_AdditionalChargeList = explode("||", $AdditionalChargeList);


//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//    echo("lramount :- $lramount </br>");
//    echo("servicetax :- $servicetax </br>");
//	echo("additionalcharges_tick :- $additionalcharges_tick </br>");
//	echo("Split_AdditionalChargeList0 :- $Split_AdditionalChargeList[0] </br>");
//	echo("Split_AdditionalChargeList1 :- $Split_AdditionalChargeList[1] </br>");
//	die();


	$sqlQry= "select ChargeName, ChargeFix, acmid, ChargePercentage from additionalcharge_master ";
	$sqlQry= $sqlQry." where (acmid>3 and acmid<8)";
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
		$ControlDisplay=0;
		$ControlAmount=0;
		$TotalControlAmount=$lramount+$servicetax;
		while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
		{
			$db_ChargeName=$row{0};
			$db_ChargeFix=$row{1};
			$db_acmid=$row{2};
			$db_ChargePercentage=$row{3};
			$controlname=$db_acmid;
			$controlname1=$db_acmid."_fix";
			$controlname2=$db_acmid."_percentage";

			$ControlAmount=0;
			$ControlDisplay=0;
			if($db_ChargePercentage>0){
				$ControlAmount=($lramount*$db_ChargePercentage)/100;
				$ControlDisplay=$db_ChargePercentage;
			}
			elseif($db_ChargeFix>0){
				$ControlAmount=$db_ChargeFix;
				$ControlDisplay=$db_ChargeFix;
			}

			$TotalControlAmount=$TotalControlAmount+$ControlAmount;


//			echo("lramount :- $lramount </br>");
//			echo("db_ChargePercentage :- $db_ChargePercentage </br>");
//			echo("ControlAmount :- $ControlAmount </br>");
//			echo("TotalControlAmount :- $TotalControlAmount </br></br></br></br>");
//			echo("db_ChargeFix :- $db_ChargeFix </br>");
			$j=$j+1;
			$j==1?$additionalchargesentry=$db_acmid."~".$ControlAmount:$additionalchargesentry=$additionalchargesentry."||".$db_acmid."~".$ControlAmount;
			?>
				<div class="col-md-3">
					<div class="form-group form-group-material">
						<label><?php echo $db_ChargeName;?> </label>
						<div class="input-group">
							<input type="hidden" class="form-control" name="<?php echo $controlname1;?>" id="<?php echo $controlname1;?>" value="<?php echo $db_ChargeFix;?>">
							<input type="hidden" class="form-control" name="<?php echo $controlname2;?>" id="<?php echo $controlname2;?>" value="<?php echo $db_ChargePercentage;?>">
							<input type="text" class="form-control" name="<?php echo $controlname;?>" id="<?php echo $controlname;?>" value="<?php echo $ControlDisplay;?>" onblur="return lradditionalcharge('<?php echo $Split_AdditionalChargeList[0];?>', '<?php echo $Split_AdditionalChargeList[1];?>', <?php echo $servicetax; ?>);" onkeypress="return only_Numeric_Dot(event);" ondrop="return false;" onpaste="return false;">
							<span class="input-group-addon">
								<img src="assets/images/rupees-128.png" height="15" width="15">
							</span>
						</div>
					</div>
				</div>
			<?php

		}
	}
	mysqli_free_result($result);

	$TotalControlAmount=number_format((float)$TotalControlAmount, 2, '.', '');
?>
<script type="text/javascript">
		document.getElementById("additionalchargesentry").value = '<?php echo $additionalchargesentry; ?>';
		document.getElementById("paidlramount").value="<?php echo $TotalControlAmount;?>";
		document.getElementById("div_paidlramount").innerHTML="<?php echo $TotalControlAmount;?>";
</script>
