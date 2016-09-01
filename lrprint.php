<html>
<head>
<title>lr_print</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?php
	include('assets/inc/db_connect.php');
	include('assets/inc/common-function.php');

//	if(!isset($_REQUEST["LRID"])) {
//		$UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
//		$AccessingPage=basename(__FILE__); //"add_society.php";
//		//			echo("UrlPage :- $UrlPage </br>");
//		//			echo("AccessingPage :- $AccessingPage </br>");
//		if(trim($UrlPage)==trim($AccessingPage)){
//			header("Location: /login.php");
//		}
//	}

	$error_msg="";
	$CurrentDate = date('Y-m-d h:i:s');
	$LRID=$_REQUEST["LRID"];
	$LRID=18;


                $cols=" `inward`.LRID, `inward`.ReceivedDate, `inward`.InvoiceNumber, `inward`.PakageType, `inward`.Amount ";
                $cols.=" , `vehicle_master`.`VehicleNumber`";
                $cols.=" , `consignor_master`.`ConsignorName`";
                $cols.=" , `consignee_master`.`ConsigneeName`";
                $cols.=" , `product_master`.`ProductName`";
                $cols.=" , `inward`.fyid, `inward`.Rate, `inward`.Quantity";
				$cols.=" , `consignee_master`.`cnid`";



                $sqlQry= "select $cols from `inward`";

                $sqlQry.= "inner join `vehicle_master`";
                $sqlQry.= "on `inward`.`vmid` = `vehicle_master`.`vmid`";

                $sqlQry.= "inner join `consignoraddress_master`";
                $sqlQry.= "on `inward`.`caid` = `consignoraddress_master`.`caid`";
                $sqlQry.= "inner join `consignor_master`";
                $sqlQry.= "on `consignoraddress_master`.`cid` = `consignor_master`.`cid`";

                $sqlQry.= "inner join `consignee_master`";
                $sqlQry.= "on `inward`.`cnid` = `consignee_master`.`cnid`";

                $sqlQry.= "inner join `product_master`";
                $sqlQry.= "on `inward`.`pmid` = `product_master`.`pmid`";

                $sqlQry.= " where 1=1";

                $sqlQry.= " and LRID = $LRID";


                $sqlQry.= " and `inward`.Active=1";
        //        echo ("Check sqlQry :- $sqlQry </br>");
        //        die();
                unset($con);
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $sqlQry);
                if (mysqli_num_rows($result)!=0)
				{
					while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
					{
						$lrid=$row[0];
						$TransitDate=$row[1];
						$InvoiceNo=$row[2];
						$PakageType=$row[3];
						$Amount=$row[4];
						$VehicleNumber=$row[5];
						$ConsignorName=$row[6];
						$ConsigneeName=$row[7];
						$ProductName=$row[8];

						$FinancialYear=$row[9];
						$Rate=$row[10];
						$Quantity=$row[11];

						$cnid=$row[12];

						$ConsigneeArea=Get_ConsigneeArea($con, $cnid);

						$ShippingCharge=Get_LRAdditionalCharge($con, $lrid, 1);
						$BiltyCharge=Get_LRAdditionalCharge($con, $lrid, 2);
						$ServiceTaxCharge=Get_LRAdditionalCharge($con, $lrid, 3);
						$PhotocopyCharge=Get_LRAdditionalCharge($con, $lrid, 4);
						$WaraiCharge=Get_LRAdditionalCharge($con, $lrid, 5);

					}
				}

?>
<!-- Save for Web Slices (lr_print.jpg) -->
<table id="Table_01" width="1200" height="858" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="35">
			<img src="assets/images/lr/lr_print_01.jpg" width="1200" height="147" alt=""></td>
		<td width="10">
			<img src="assets/images/lr/spacer.gif" width="1" height="147" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_02.jpg" width="202" height="52" alt=""></td>
		<td colspan="14">
			<?php echo $lrid; ?></td>
		<td colspan="9">
			<img src="assets/images/lr/lr_print_04.jpg" width="177" height="52" alt=""></td>
		<td colspan="9">
			<?php echo $TransitDate; ?></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="52" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_06.jpg" width="202" height="48" alt=""></td>
		<td colspan="14">
			Tbb</td>
		<td colspan="9">
			<img src="assets/images/lr/lr_print_08.jpg" width="177" height="48" alt=""></td>
		<td colspan="9">
			Bhiwandi</td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="48" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_10.jpg" width="202" height="50" alt=""></td>
		<td colspan="14">
			<?php echo $InvoiceNo; ?></td>
		<td colspan="9">
			<img src="assets/images/lr/lr_print_12.jpg" width="177" height="50" alt=""></td>
		<td colspan="9">
			<?php echo $ConsigneeArea; ?></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="50" alt=""></td>
	</tr>
	<tr>
		<td colspan="35">
			<img src="assets/images/lr/lr_print_14.jpg" width="1200" height="47" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="47" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="assets/images/lr/lr_print_15.jpg" width="22" height="1" alt=""></td>
		<td colspan="2" rowspan="3">
			<?php echo $ConsignorName; ?></td>
		<td width="16" rowspan="5">
			<img src="assets/images/lr/lr_print_17.jpg" width="16" height="67" alt=""></td>
		<td colspan="2" rowspan="4">
			<?php echo $ConsigneeName; ?></td>
		<td colspan="8">
			<?php echo $ProductName; ?></td>
		<td colspan="3" rowspan="6">
			<img src="assets/images/lr/lr_print_20.jpg" width="12" height="81" alt=""></td>
		<td colspan="7">
			<?php echo $Quantity; ?></td>
		<td colspan="2" rowspan="2">
			<?php echo $Rate; ?></td>
		<td width="12" rowspan="5">
			<img src="assets/images/lr/lr_print_23.jpg" width="12" height="67" alt=""></td>
		<td colspan="5" rowspan="2">
			<?php echo $ShippingCharge; ?></td>
		<td colspan="2">
			<img src="assets/images/lr/lr_print_25.jpg" width="11" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_26.jpg" width="22" height="64" alt=""></td>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_27.jpg" width="15" height="64" alt=""></td>
		<td colspan="3" rowspan="2">
			<img src="assets/images/lr/lr_print_28.jpg" width="115" height="64" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="assets/images/lr/lr_print_29.jpg" width="9" height="65" alt=""></td>
		<td width="91" rowspan="2">
			<img src="assets/images/lr/lr_print_30.jpg" width="91" height="64" alt=""></td>
		<td width="1" rowspan="5">
			<img src="assets/images/lr/lr_print_31.jpg" width="1" height="80" alt=""></td>
		<td colspan="5" rowspan="2">
			<img src="assets/images/lr/lr_print_32.jpg" width="86" height="64" alt=""></td>
		<td width="9" rowspan="4">
			<img src="assets/images/lr/lr_print_33.jpg" width="9" height="66" alt=""></td>
		<td colspan="2">
			<img src="assets/images/lr/lr_print_34.jpg" width="11" height="31" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="31" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_35.jpg" width="150" height="34" alt=""></td>
		<td colspan="6" rowspan="2">
			<img src="assets/images/lr/lr_print_36.jpg" width="184" height="34" alt=""></td>
		<td width="10" rowspan="4">
			<img src="assets/images/lr/lr_print_37.jpg" width="10" height="49" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="15">
			<img src="assets/images/lr/lr_print_38.jpg" width="22" height="167" alt=""></td>
		<td colspan="2" rowspan="15">
			<img src="assets/images/lr/lr_print_39.jpg" width="236" height="167" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/lr_print_40.jpg" width="1" height="1" alt=""></td>
		<td width="14" rowspan="14">
			<img src="assets/images/lr/lr_print_41.jpg" width="14" height="166" alt=""></td>
		<td colspan="3" rowspan="3">
			<img src="assets/images/lr/lr_print_42.jpg" width="115" height="16" alt=""></td>
		<td rowspan="3">
			<img src="assets/images/lr/lr_print_43.jpg" width="91" height="16" alt=""></td>
		<td colspan="5" rowspan="3">
			<img src="assets/images/lr/lr_print_44.jpg" width="86" height="16" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td width="1">
			<img src="assets/images/lr/lr_print_45.jpg" width="1" height="1" alt=""></td>
		<td colspan="2" rowspan="13">
			<img src="assets/images/lr/lr_print_46.jpg" width="232" height="165" alt=""></td>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_47.jpg" width="9" height="15" alt=""></td>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_48.jpg" width="150" height="15" alt=""></td>
		<td colspan="6" rowspan="2">
			<img src="assets/images/lr/lr_print_49.jpg" width="184" height="15" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="13">
			<img src="assets/images/lr/lr_print_50.jpg" width="17" height="165" alt=""></td>
		<td>
			<img src="assets/images/lr/lr_print_51.jpg" width="9" height="14" alt=""></td>
		<td>
			<img src="assets/images/lr/lr_print_52.jpg" width="12" height="14" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="14" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="11">
			<img src="assets/images/lr/lr_print_53.jpg" width="114" height="150" alt=""></td>
		<td colspan="3" rowspan="11">
			<img src="assets/images/lr/lr_print_54.jpg" width="10" height="150" alt=""></td>
		<td colspan="2" rowspan="10">
			<img src="assets/images/lr/lr_print_55.jpg" width="92" height="149" alt=""></td>
		<td colspan="3" rowspan="10">
			<img src="assets/images/lr/lr_print_56.jpg" width="12" height="149" alt=""></td>
		<td colspan="5" rowspan="6">
			<img src="assets/images/lr/lr_print_57.jpg" width="86" height="75" alt=""></td>
		<td colspan="10">
			<img src="assets/images/lr/lr_print_58.jpg" width="355" height="1" alt=""></td>
		<td rowspan="2">
			<img src="assets/images/lr/lr_print_59.jpg" width="10" height="33" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<img src="assets/images/lr/lr_print_60.jpg" width="159" height="33" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="assets/images/lr/lr_print_61.jpg" width="13" height="34" alt=""></td>
		<td colspan="5">
			<?php echo $BiltyCharge; ?></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="assets/images/lr/lr_print_63.jpg" width="182" height="1" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="assets/images/lr/lr_print_64.jpg" width="11" height="41" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_65.jpg" width="159" height="1" alt=""></td>
		<td colspan="4" rowspan="2">
			<img src="assets/images/lr/lr_print_66.jpg" width="182" height="40" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="2">
			<img src="assets/images/lr/lr_print_67.jpg" width="159" height="40" alt=""></td>
		<td colspan="2" rowspan="2">
			<img src="assets/images/lr/lr_print_68.jpg" width="13" height="40" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="39" alt=""></td>
	</tr>
	<tr>
		<td width="1">
			<img src="assets/images/lr/lr_print_69.jpg" width="1" height="1" alt=""></td>
		<td colspan="3" rowspan="4">
			<img src="assets/images/lr/lr_print_70.jpg" width="181" height="43" alt=""></td>
		<td colspan="2" rowspan="4">
			<img src="assets/images/lr/lr_print_71.jpg" width="11" height="43" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="assets/images/lr/lr_print_72.jpg" width="85" height="40" alt=""></td>
		<td colspan="4">
			<img src="assets/images/lr/lr_print_73.jpg" width="160" height="40" alt=""></td>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_74.jpg" width="14" height="40" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="40" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="assets/images/lr/lr_print_75.jpg" width="84" height="1" alt=""></td>
		<td colspan="8">
			<img src="assets/images/lr/lr_print_76.jpg" width="175" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="6">
			<img src="assets/images/lr/lr_print_77.jpg" width="83" height="38" alt=""></td>
		<td colspan="9" rowspan="9">
			<img src="assets/images/lr/lr_print_78.jpg" width="176" height="44" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="7">
			<?php echo $WaraiCharge; ?></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="32" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="19">
			<img src="assets/images/lr/lr_print_80.jpg" width="93" height="131" alt=""></td>
		<td colspan="2" rowspan="5">
			<img src="assets/images/lr/lr_print_81.jpg" width="11" height="6" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="19">
			<img src="assets/images/lr/lr_print_82.jpg" width="246" height="132" alt=""></td>
		<td width="113" rowspan="17">
			<img src="assets/images/lr/lr_print_83.jpg" width="113" height="129" alt=""></td>
		<td colspan="3" rowspan="16">
			<img src="assets/images/lr/lr_print_84.jpg" width="10" height="128" alt=""></td>
		<td width="1" rowspan="2">
			<img src="assets/images/lr/lr_print_85.jpg" width="1" height="3" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td width="21" rowspan="16">
			<img src="assets/images/lr/lr_print_86.jpg" width="21" height="128" alt=""></td>
		<td colspan="3" rowspan="13">
			<img src="assets/images/lr/lr_print_87.jpg" width="237" height="124" alt=""></td>
		<td colspan="2" rowspan="15">
			<img src="assets/images/lr/lr_print_88.jpg" width="17" height="127" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td rowspan="15">
			<img src="assets/images/lr/lr_print_89.jpg" width="1" height="126" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="12">
			<img src="assets/images/lr/lr_print_90.jpg" width="83" height="122" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="13">
			<img src="assets/images/lr/lr_print_91.jpg" width="11" height="124" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="4" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="assets/images/lr/lr_print_92.jpg" width="192" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="5">
			<img src="assets/images/lr/lr_print_93.jpg" width="3" height="50" alt=""></td>
		<td colspan="5">
			<img src="assets/images/lr/lr_print_94.jpg" width="172" height="1" alt=""></td>
		<td colspan="6" rowspan="2">
			<img src="assets/images/lr/lr_print_95.jpg" width="193" height="47" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="3">
			<img src="assets/images/lr/lr_print_96.jpg" width="172" height="48" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="46" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="assets/images/lr/lr_print_97.jpg" width="1" height="1" alt=""></td>
		<td colspan="2" rowspan="4">
			<img src="assets/images/lr/lr_print_98.jpg" width="179" height="33" alt=""></td>
		<td colspan="3" rowspan="4">
			<img src="assets/images/lr/lr_print_99.jpg" width="13" height="33" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td rowspan="13">
			<img src="assets/images/lr/lr_print_100.jpg" width="1" height="224" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="assets/images/lr/lr_print_101.jpg" width="172" height="1" alt=""></td>
		<td>
			<?php echo $Amount; ?></td>
	</tr>
	<tr>
		<td colspan="2" rowspan="4">
			<img src="assets/images/lr/lr_print_102.jpg" width="2" height="66" alt=""></td>
		<td colspan="6">
			<img src="assets/images/lr/lr_print_103.jpg" width="173" height="30" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="30" alt=""></td>
	</tr>
	<tr>
		<td width="1">
			<img src="assets/images/lr/lr_print_104.jpg" width="1" height="1" alt=""></td>
		<td colspan="5" rowspan="6">
			<img src="assets/images/lr/lr_print_105.jpg" width="172" height="40" alt=""></td>
		<td width="178" rowspan="8">
			<?php echo $Amount; ?></td>
		<td colspan="4" rowspan="9">
			<img src="assets/images/lr/lr_print_107.jpg" width="14" height="45" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="assets/images/lr/lr_print_108.jpg" width="1" height="35" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="34" alt=""></td>
	</tr>
	<tr>
		<td width="1" rowspan="3">
			<img src="assets/images/lr/lr_print_109.jpg" width="1" height="4" alt=""></td>
		<td colspan="2" rowspan="3">
			<img src="assets/images/lr/lr_print_110.jpg" width="236" height="4" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="2">
			<img src="assets/images/lr/lr_print_111.jpg" width="86" height="3" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td colspan="2">
			<img src="assets/images/lr/lr_print_112.jpg" width="17" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/lr_print_113.jpg" width="1" height="1" alt=""></td>
		<td colspan="2">
			<img src="assets/images/lr/lr_print_114.jpg" width="9" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="6" rowspan="5">
			<img src="assets/images/lr/lr_print_115.jpg" width="275" height="153" alt=""></td>
		<td colspan="5" rowspan="5">
			<img src="assets/images/lr/lr_print_116.jpg" width="124" height="153" alt=""></td>
		<td colspan="3" rowspan="5">
			<img src="assets/images/lr/lr_print_117.jpg" width="13" height="153" alt=""></td>
		<td colspan="4" rowspan="5">
			<img src="assets/images/lr/lr_print_118.jpg" width="84" height="153" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="4">
			<img src="assets/images/lr/lr_print_119.jpg" width="93" height="152" alt=""></td>
		<td colspan="5" rowspan="4">
			<img src="assets/images/lr/lr_print_120.jpg" width="172" height="152" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td colspan="3" rowspan="3">
			<img src="assets/images/lr/lr_print_121.jpg" width="246" height="150" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="2" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="assets/images/lr/lr_print_122.jpg" width="178" height="148" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
	</tr>
	<tr>
		<td colspan="4">
			<img src="assets/images/lr/lr_print_123.jpg" width="14" height="147" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="147" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="assets/images/lr/spacer.gif" width="21" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="180">
			<img src="assets/images/lr/spacer.gif" width="180" height="1" alt=""></td>
		<td width="56">
			<img src="assets/images/lr/spacer.gif" width="56" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="16" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="231">
			<img src="assets/images/lr/spacer.gif" width="231" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="14" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="113" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="8">
			<img src="assets/images/lr/spacer.gif" width="8" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="91" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="10">
			<img src="assets/images/lr/spacer.gif" width="10" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="2">
			<img src="assets/images/lr/spacer.gif" width="2" height="1" alt=""></td>
		<td width="81">
			<img src="assets/images/lr/spacer.gif" width="81" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="9" height="1" alt=""></td>
		<td width="71">
			<img src="assets/images/lr/spacer.gif" width="71" height="1" alt=""></td>
		<td width="79">
			<img src="assets/images/lr/spacer.gif" width="79" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="12" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="178" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td width="2">
			<img src="assets/images/lr/spacer.gif" width="2" height="1" alt=""></td>
		<td width="1">
			<img src="assets/images/lr/spacer.gif" width="1" height="1" alt=""></td>
		<td>
			<img src="assets/images/lr/spacer.gif" width="10" height="1" alt=""></td>
		<td></td>
	</tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>