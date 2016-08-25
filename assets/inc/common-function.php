<?php

	function udate($format, $utimestamp = null) {
		if (is_null($utimestamp))
			$utimestamp = microtime(true);

		$timestamp = floor($utimestamp);
		$milliseconds = round(($utimestamp - $timestamp) * 1000);

		return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
	}

	function validateDate($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d && $d->format('Y-m-d') == $date;
	}

	function sanitize($con, $input) {
		if (is_array($input)) {
			foreach($input as $var=>$val) {
				$output[$var] = sanitize($val);
			}
		}
		else {
			if (get_magic_quotes_gpc()) {
				$input = stripslashes($input);
			}
			$input  = cleanInput($input);
			$output = mysqli_real_escape_string($con, $input);
		}
		return $output;
	}
	function cleanInput($input) {

		$search = array(
			'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
			'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
		);

		$output = preg_replace($search, '', $input);
		return $output;
	}

	function Insert_LogTableStart($con, $CurrentDate, $Creator, $ip, $PageName, $inTime){
		$LogID=0;
		$Procedure= "";
		$Procedure= "Call Save_LogTableStart('$CurrentDate', $Creator , '$ip', '$PageName', '$inTime');";
	//		echo ("Flat Save :- $Procedure </br>");
	//		die();
		$LogTable_Result = mysqli_query($con, $Procedure);
		if (mysqli_num_rows($LogTable_Result)!=0){
			while ($row = mysqli_fetch_array($LogTable_Result,MYSQLI_NUM)){
				$LogID=$row{0};
			}
		}
		mysqli_free_result($LogTable_Result);
		return $LogID;
	}

	function Add_ConsignorProduct($con, $CurrentDate, $session_userid, $session_ip, $LastInsertedID, $product)
	{
		$Split_Product = explode(",", $product);
		foreach ($Split_Product as $SingleProduct)
		{
			$Procedure="";
			$Procedure = "Call Save_ConsignorProduct('$CurrentDate', $session_userid, '$session_ip', $LastInsertedID, $SingleProduct);";
			echo("Procedure :- $Procedure </br>");
			unset($con);
			include('db_connect.php');
			$resultproduct = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save consignor product)! Error: " . mysqli_error($con), E_USER_ERROR);
		}
	}

	function Update_LogTable($con, $LogTable_ID, $tableName, $oldValue, $outTime)
	{
		$Proc= "";
		$Proc= "Call Update_LogTable($LogTable_ID, '$tableName' , '$oldValue', '$outTime');";
		echo ("Update Log Table :- $Proc </br>");
	//			die();
		$LogTableUpdate_Result = mysqli_query($con, $Proc);
	}


	function Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value)
	{
//		echo ("CurrentDate :- $CurrentDate </br>");
//		echo ("Creator :- $Creator </br>");
//		echo ("ip :- $ip </br>");
//		echo ("PageName :- $PageName </br>");
//		echo ("inTime :- $inTime </br>");
//		echo ("tablename :- $tablename </br>");
//		echo ("searchColumn :- $searchColumn </br>");
//		echo ("searchColumn_Value :- $searchColumn_Value </br>");
//		die();
		unset($con);
//		mysqli_close($con);
		include('db_connect.php');

		$LogStart_Value="";
		$LogTable_ID=Insert_LogTableStart($con, $CurrentDate, $Creator, $ip, $PageName, $inTime);
	//				echo ("LogTable_ID:- ".$LogTable_ID."</br>");
	//				die();

		unset($con);
//		mysqli_close($con);
		include('db_connect.php');

		$TableListID=Get_TableListID($con, $tablename);
	//				echo ("TableListID :- $TableListID </br>");

	//				echo ("tablename :- $tablename </br>");
	//				echo ("searchColumn :- $searchColumn </br>");
	//				echo ("searchColumn_Value :- $searchColumn_Value </br>");
	//				echo ("LogTable_ID :- $LogTable_ID </br>");
	//				echo ("TableListID :- $TableListID </br>");
	//				die();

		unset($con);
//		mysqli_close($con);
		include('db_connect.php');

		$oldValue="";
		if ( (strlen(trim($searchColumn))>0 and strlen(trim($searchColumn_Value))>0) ) {
			$oldValue = Get_OldValue($con, $tablename, $searchColumn, $searchColumn_Value);
	//								echo ("Old Value :- $oldValue </br></br></br>");
	//								die();
		}
		$LogStart_Value=trim($LogTable_ID)."|<>|".trim($TableListID)."|<>|".trim($oldValue);
		unset($con);
//		mysqli_close($con);
		return $LogStart_Value;
	}
	function Log_End($con, $ColumnID, $LogStart_Value)
	{
		unset($con);
//		mysqli_close($con);
		include('db_connect.php');
		$outTime=udate('H:i:s:u');
	//				echo("LogStart_Value :- $LogStart_Value </br>");
	//				die();
		$LogStartValue_Array = explode("|<>|", $LogStart_Value);
		$LogTable_ID=$LogStartValue_Array[0];
		$TableListID=$LogStartValue_Array[1];
		$oldValue=$LogStartValue_Array[2];

		$Procs= "";
		$Procs= "Call Save_LogTableEnd($LogTable_ID, $TableListID, $ColumnID , '$oldValue', '$outTime');";
//		echo ("Insert Log Table End :- $Procs </br>");
//		die();
		$LogTableUpd_Result = mysqli_query($con, $Procs);

	}


	function Get_OldValue($con, $TableName, $SearchColumnName, $SearchColumnName_Value)
	{
		$Getting_OldValue="";
		$sqlQry= "";
		$sqlQry= "select * from $TableName";
		$sqlQry= $sqlQry." where $SearchColumnName=$SearchColumnName_Value";
//		echo ("sqlQry :- $sqlQry </br>");
//		die();
		$OldValue_result = mysqli_query($con, $sqlQry) or trigger_error("Query Failed(Select log table name)! Error: ".mysqli_error($con), E_USER_ERROR);
		if (mysqli_num_rows($OldValue_result)!=0)
		{
			while ($row = mysqli_fetch_array($OldValue_result,MYSQLI_NUM))
			{
				$FieldCount=mysqli_field_count($con);
	//						echo ("FieldCount :- $FieldCount </br>");
	//						die();
				for ($i=0; $i<$FieldCount; $i++){
					if(strlen($Getting_OldValue)==0){
						$Getting_OldValue=$row{$i};
					}
					else{
						$Getting_OldValue.="|~|".$row{$i};
					}
				}
			}
		}
		return $Getting_OldValue;
	}


	function Get_TableListID($con, $TableName)
	{
		$Getting_TableListID=0;
		$sqlQry= "";
		$sqlQry= "select id from `log_tablelist`";
		$sqlQry= $sqlQry." where tablename='$TableName'";
	//				echo ("sqlQry :- $sqlQry");
	//				die();
		$TableListID_result = mysqli_query($con, $sqlQry) or trigger_error("Query Failed(Select log table name)! Error: ".mysqli_error($con), E_USER_ERROR);
		if (mysqli_num_rows($TableListID_result)!=0)
		{
			while ($row = mysqli_fetch_array($TableListID_result,MYSQLI_NUM))
			{
				$Getting_TableListID=$row{0};
			}
		}
		unset($con);
//		mysqli_close($con);
		include('db_connect.php');

		if ($Getting_TableListID==0){
			$LagTableList_Proc= "Call Save_LogTableList('$TableName');";
	//							echo ("LagTableList_Proc :- $LagTableList_Proc </br>");
	//							die();
			$LogTableList_result = mysqli_query($con, $LagTableList_Proc) or trigger_error("Query Failed(Log Table List)! Error: ".mysqli_error($con), E_USER_ERROR);
			if (mysqli_num_rows($LogTableList_result) != 0) {
				$rows = mysqli_fetch_array($LogTableList_result);
				$Getting_TableListID = $rows{0};
			}
		}
		return $Getting_TableListID;
	}

	function Get_FinancialYear($con, $CYear)
	{
		$Getting_FinancialYearID=0;
		$sqlQry= "";
		$sqlQry= "select fyid from financialyear_master ";
		$sqlQry.= " where CurrentYear=$CYear";
//		echo ("$sqlQry");
//		die();
//		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_FinancialYearID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_FinancialYearID;
	}

	function Get_ConsignorProduct($con, $caid)
	{
		$Getting_ConsignorProduct="";
		$sqlQry= "";
		$sqlQry= "select consignorproduct_master.pmid, product_master.ProductName from consignorproduct_master ";
		$sqlQry.= " inner join product_master";
		$sqlQry.= " on consignorproduct_master.pmid=product_master.pmid";
		$sqlQry.= " where consignorproduct_master.caid=$caid";
		$sqlQry.= " and consignorproduct_master.Active=1";
		$sqlQry.= " group by consignorproduct_master.pmid";
		$sqlQry.= " order by consignorproduct_master.pmid";
//			echo ("$sqlQry");
//			die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				if($inc==1){
					$Getting_ConsignorProduct=$row{1};
				}
				else{
					$Getting_ConsignorProduct=$Getting_ConsignorProduct.",".$row{1};
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorProduct;
	}


	function Get_ContactTypeID($con, $caid, $ctmid, $Contact)
	{
		$Getting_ContactTypeID=0;
		$sqlQry= "";
		$sqlQry= "select ccid from consignorcontact_master ";
		$sqlQry.= " where caid=$caid";
		$sqlQry.= " and ctmid=$ctmid";
		$sqlQry.= " and Contact='$Contact'";
		$sqlQry.= " and Active=1";
//		echo ("$sqlQry");
//		die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ContactTypeID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ContactTypeID;
	}

	function Get_ConsignorDetails($con, $caid, $ctmid)
	{
		$Getting_ConsignorDetails="";
		$sqlQry= "";
		$sqlQry= "select Contact from consignorcontact_master ";
		$sqlQry.= " where caid=$caid";
		$sqlQry.= " and ctmid=$ctmid";
		$sqlQry.= " and Active=1";
	//			echo ("$sqlQry");
	//			die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				if($inc==1){
					$Getting_ConsignorDetails=$row{0};
				}
				else{
					$Getting_ConsignorDetails=$Getting_ConsignorDetails.",".$row{0};
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorDetails;
	}

	function Fill_FinancialYear($con, $Prv, $Nxt)
	{
		$sqlQry= "";
		$sqlQry= "select fyid, FinancialYear from financialyear_master ";
		$sqlQry.= " where (fyid=$Prv or fyid=$Nxt)";
		$sqlQry.= " order by fyid";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo "<option value=".$ID." selected>".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Master($con, $TableName, $ColumnName, $OrderBy)
	{
		$sqlQry= "";
		$sqlQry= "select $ColumnName from $TableName ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by $OrderBy";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Consignee($con, $ConsignorAddressID)
	{
		$sqlQry= "";
		$sqlQry= "select cnid, ConsigneeName from consignee_master ";
		$sqlQry.= " where caid=$ConsignorAddressID";
		$sqlQry.= " and Active=1";
		$sqlQry.= " order by ConsigneeName";
//		echo ("$sqlQry");
//		die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo("ID :- " . $ID . "</br>");
			echo("Name :- " . $Name . "</br>");
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Consignor($con)
	{
		$sqlQry= "";
		$sqlQry= "select consignor_master.cid, consignor_master.ConsignorName, consignoraddress_master.caid, consignoraddress_master.Pincode from consignor_master ";
		$sqlQry.= " inner join consignoraddress_master";
		$sqlQry.= " on consignor_master.cid=consignoraddress_master.cid";
		$sqlQry.= " where consignor_master.Active=1";
		$sqlQry.= " order by consignor_master.ConsignorName";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{2};
			$Name=$row{1}." (".$row{3}.") ";
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}


	function Fill_VehicleOwnership($con)
	{
		$sqlQry= "";
		$sqlQry= "select void, Ownership from vehicleownership_master ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by Ownership";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Designation($con)
		{
			$sqlQry= "";
			$sqlQry= "select designationid, Designation from designation_master ";
			$sqlQry.= " where Active=1";
			$sqlQry.= " order by designationid";
			//echo ("$sqlQry");
			mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			//fetch tha data from the database
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				$ID=$row{0};
				$Name=$row{1};
				echo "<option value=".$ID.">".$Name." </option>";
			}
			mysqli_free_result($result);
		}

	function Fill_LoginName($con)
		{
			$sqlQry= "";
			$sqlQry= "select loginid, UserName from login_master ";
			$sqlQry.= " where Active=1";
			$sqlQry.= " order by UserName";
			//echo ("$sqlQry");
			mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			//fetch tha data from the database
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				$ID=$row{0};
				$Name=$row{1};
				echo "<option value=".$ID.">".$Name." </option>";
			}
			mysqli_free_result($result);
		}

	function Fill_ProductOnConsignorConsignee($con, $ConsignorID, $ConsigneeID)
	{
		$sqlQry= "";
		$sqlQry= "select rate_master.pmid, product_master.ProductName from rate_master ";
		$sqlQry.= " inner join product_master";
		$sqlQry.= " on rate_master.pmid=product_master.pmid";
		$sqlQry.= " where rate_master.Active=1";
		$sqlQry.= " and rate_master.caid=$ConsignorID";
		$sqlQry.= " and rate_master.cnid=$ConsigneeID";
		$sqlQry.= " order by product_master.ProductName";
//		echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Product($con)
	{
		$sqlQry= "";
		$sqlQry= "select pmid, ProductName from product_master ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by ProductName";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_AreaForJS($con)
	{
		$Getting_AreaForJS="";
		$sqlQry= "";
		$sqlQry= "select AreaName from area_master ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " group by AreaName";
		$sqlQry.= " order by AreaName";
		//echo ("$sqlQry");
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			$Getting_AreaForJS="";
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				if($inc==1) {
					$Getting_AreaForJS = "'".$row{0}."'";
				}
				else{
					$Getting_AreaForJS = $Getting_AreaForJS.", "."'".$row{0}."'";
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_AreaForJS;
	}

	function Fill_PageName($con)
		{
			$sqlQry= "";
			$sqlQry= "select menusub_id, urlDescription from 1menusub ";
			$sqlQry.= " where Active=1";
			$sqlQry.= " order by urlDescription";
			//echo ("$sqlQry");
			mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			//fetch tha data from the database
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				$ID=$row{0};
				$Name=$row{1};
				echo "<option value=".$ID.">".$Name." </option>";
			}
			mysqli_free_result($result);
		}


	function Get_AreaName($con, $amid)
	{
		$Getting_AreaName="";
		$sqlQry= "";
		$sqlQry= "select AreaName from area_master ";
		$sqlQry= $sqlQry." where amid=$amid";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))			{
				$Getting_AreaName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_AreaName;
	}


	function Get_AdditionalChargeList($con)
	{
		$Getting_allControlName="";
		$sqlQry= "";
		$sqlQry= "select ChargeName, ChargeFix, acmid from additionalcharge_master ";
		$sqlQry= $sqlQry." where acmid>3";
		$sqlQry= $sqlQry." and Active=1";
		$sqlQry= $sqlQry." order by acmid";
	//			echo ("Check sqlQry :- $sqlQry </br>");
	//			die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$i=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$i=$i+1;
				$db_ChargeName=$row{0};
				$db_ChargeFix=$row{1};
				$db_acmid=$row{2};
				
				$controlname=$db_acmid;
//			echo("db_ChargeName :- $db_ChargeName </br>");
//			echo("db_ChargeFix :- $db_ChargeFix </br>");
				$i==1?$Getting_allControlName=$controlname:$Getting_allControlName=$Getting_allControlName.",".$controlname;
			}
		}
		$Getting_allControlName=$i."||".$Getting_allControlName;
		mysqli_free_result($result);
		return $Getting_allControlName;
	}

	function Get_DesignationPrivilage($con, $designation)
	{
		$Getting_DesignationPrivilage="";
		$sqlQry= "";
		$sqlQry= "select Privilage from `designation_master`";
		$sqlQry= $sqlQry." where designationid=$designation";
		$sqlQry= $sqlQry." and Active=1";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_DesignationPrivilage=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_DesignationPrivilage;
	}

	function Get_ServiceTax($con)
	{
		$Getting_ServiceTax=0;
		$sqlQry= "";
		$sqlQry= "select ChargePercentage from `additionalcharge_master`";
		$sqlQry= $sqlQry." where acmid=3";
		$sqlQry= $sqlQry." and Active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ServiceTax = $row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ServiceTax;
	}

	function Get_BiltyCharge($con)
	{
		$Getting_BiltyCharge=0;
		$sqlQry= "";
		$sqlQry= "select ChargeFix from `additionalcharge_master`";
		$sqlQry= $sqlQry." where acmid=2";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_BiltyCharge = $row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_BiltyCharge;
	}

	function Get_ProductRate($con, $consignorid, $consigneeid, $productid, $packageType)
	{
		$Getting_ProductRate=0;
		$sqlQry= "";
		$sqlQry= "select CartoonRate, ItemRate from `rate_master`";
		$sqlQry= $sqlQry." where caid=$consignorid";
		$sqlQry= $sqlQry." and cnid=$consigneeid";
		$sqlQry= $sqlQry." and pmid=$productid";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				if ($packageType=="CartoonRate") {
					$Getting_ProductRate = $row{0};
				}
				elseif ($packageType=="ItemRate") {
					$Getting_ProductRate = $row{1};
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_ProductRate;
	}

	function Get_PageName($con, $PageID)
	{
		$Getting_PageName="";
		$sqlQry= "";
		$sqlQry= "select url from `1menusub`";
		$sqlQry= $sqlQry." where menusub_id=$PageID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_PageName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_PageName;
	}

	function Get_LoginName($con, $LoginID)
	{
		$Getting_LoginName="";
		$sqlQry= "";
		$sqlQry= "select UserName from `login_master`";
		$sqlQry= $sqlQry." where loginid=$LoginID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_LoginName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LoginName;
	}

	function Check_ServiceTaxApplicable($con, $consignorid)
	{
		$Getting_ServiceTaxApplicable=0;
		$sqlQry= "";
		$sqlQry= "select ServiceTax from consignor_master ";
		$sqlQry= $sqlQry." inner join consignoraddress_master";
		$sqlQry= $sqlQry." on consignor_master.cid=consignoraddress_master.cid";
		$sqlQry= $sqlQry." where consignoraddress_master.caid=$consignorid";
		$sqlQry= $sqlQry." and consignor_master.Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ServiceTaxApplicable=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ServiceTaxApplicable;
	}

	function Check_AreaID($con, $AreaID, $AreaName)
	{
		$Getting_AreaID=0;
		$sqlQry= "";
		$sqlQry= "select amid from area_master ";
		$sqlQry= $sqlQry." where amid<>$AreaID";
		$sqlQry= $sqlQry." and AreaName='$AreaName'";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_AreaID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_AreaID;
	}

	function Check_IDExist($con, $IDTableName, $IDColumnName, $ID)
	{
		$Getting_IDExist=0;
		$sqlQry= "";
		$sqlQry= "select $IDColumnName from $IDTableName";
		$sqlQry= $sqlQry." where $IDColumnName=$ID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_IDExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_IDExist;
	}

	function Check_PageAccessIDExist($con, $PageID)
	{
		$Getting_PageAccessID=0;
		$sqlQry= "";
		$sqlQry= "select id from `pageaccess_member`";
		$sqlQry= $sqlQry." where id=$PageID";
		$sqlQry= $sqlQry." and Active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_PageAccessID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_PageAccessID;
	}

	function Check_LoginIDExist($con, $LoginID)
	{
		$Getting_LoginID=0;
		$sqlQry= "";
		$sqlQry= "select loginid from `login_master`";
		$sqlQry= $sqlQry." where loginid=$LoginID";
		$sqlQry= $sqlQry." and Active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_LoginID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LoginID;
	}


	function Check_MenuIDExist($con, $MenuID)
	{
		$Getting_MenuID=0;
		$sqlQry= "";
		$sqlQry= "select menusub_id from `1menusub`";
		$sqlQry= $sqlQry." where menusub_id=$MenuID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_MenuID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MenuID;
	}

	function Check_MerchantIDExist($con, $MerchantID)
	{
		$Getting_MerchantID=0;
		$sqlQry= "";
		$sqlQry= "select mmid from `merchant_master`";
		$sqlQry= $sqlQry." where mmid=$MerchantID";
		$sqlQry= $sqlQry." and Active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_MerchantID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MerchantID;
	}

	function Check_ConsigneeIDExist($con, $ConsigneeID)
	{
		$Getting_ConsigneeID=0;
		$sqlQry= "";
		$sqlQry= "select cnid from `consignee_master`";
		$sqlQry= $sqlQry." where cnid=$ConsigneeID";
		$sqlQry= $sqlQry." and Active=1";
		//		echo ("Check sqlQry :- $sqlQry </br>");
		//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsigneeID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeID;
	}

	function Check_ConsigneeAddressIDExist($con, $ConsigneeID, $ConsigneeAddressID)
	{
		$Getting_ConsigneeAddressID=0;
		$sqlQry= "";
		$sqlQry= "select cnaid from `consigneeaddress_master`";
		$sqlQry= $sqlQry." where cnaid=$ConsigneeAddressID ";
		$sqlQry= $sqlQry." and cnid=$ConsigneeID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsigneeAddressID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeAddressID;
	}

	function Check_ConsignorConsigneeRate($con, $Consignorid, $ConsigneeID, $Productid)
	{
		$Getting_rmid=0;
		$sqlQry= "";
		$sqlQry= "select rmid from `rate_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and cnid=$ConsigneeID";
		$sqlQry= $sqlQry." and pmid=$Productid";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_rmid=$row{0};
//				$sqlQry1= "";
//				$sqlQry1= "update `rate_master`";
//				$sqlQry1.=" set Active=0";
//				$sqlQry1.=" where rmid=$db_rmid ";
////				echo ("Check sqlQry :- $sqlQry1 </br>");
////				die();
//				mysqli_close($con);
//				include('db_connect.php');
//				$Updateresult = mysqli_query($con, $sqlQry1);
			}
		}
		mysqli_free_result($result);
		return $Getting_rmid;
	}

	function Set_ConsignorProductDeactive($con, $CurrentDate, $session_userid, $session_ip, $Consignorid)
		{
			$sqlQry= "select cpid from `consignorproduct_master`";
			$sqlQry= $sqlQry." where caid=$Consignorid ";
			$sqlQry= $sqlQry." and Active=1";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
			mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			if (mysqli_num_rows($result)!=0)
			{
				$ConsignorProductID=0;
				while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
				{
					$ConsignorProductID=$row{0};
					$Contact="";
						$Contact=$Url;
						$sqlQry1= "";
						$sqlQry1= "update `consignorproduct_master`";
						$sqlQry1.=" set ModificationDate='$CurrentDate',";
						$sqlQry1.=" Creator=$session_userid, ";
						$sqlQry1.=" ip='$session_ip', ";
						$sqlQry1.=" Active=0 ";
						$sqlQry1.=" where cpid=$ConsignorProductID ";
//						echo ("Check sqlQry :- $sqlQry1 </br>");
//						die();
						mysqli_close($con);
						include('db_connect.php');
						$Updateresult = mysqli_query($con, $sqlQry1);

				}
			}
			mysqli_free_result($result);
		}

	function Set_ConsignorProductActive($con, $CurrentDate, $session_userid, $session_ip, $Consignorid, $ProductID)
	{
		$sqlQry= "select cpid from `consignorproduct_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and pmid=$ProductID";
	//			echo ("Check sqlQry :- $sqlQry </br>");
	//			die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$ConsignorProductID=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$ConsignorProductID=$row{0};
				$Contact="";
				$Contact=$Url;
				$sqlQry1= "";
				$sqlQry1= "update `consignorproduct_master`";
				$sqlQry1.=" set ModificationDate='$CurrentDate',";
				$sqlQry1.=" Creator=$session_userid, ";
				$sqlQry1.=" ip='$session_ip', ";
				$sqlQry1.=" Active=1 ";
				$sqlQry1.=" where cpid=$ConsignorProductID ";
//				echo ("Check sqlQry :- $sqlQry1 </br>");
//				die();
				mysqli_close($con);
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);

			}
		}
		mysqli_free_result($result);
	}

	function Check_ConsignorProductExist($Consignorid, $SingleProduct)
	{
		$Getting_ConsignorProductExist=0;
		$sqlQry= "select cpid from `consignorproduct_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and pmid=$SingleProduct";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsignorProductExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorProductExist;
	}

	function Update_ConsignorProduct($con, $CurrentDate, $session_userid, $session_ip, $Consignorid, $product)
	{
		Set_ConsignorProductDeactive($con, $CurrentDate, $session_userid, $session_ip, $Consignorid);
//		echo("Deactiveted....");
//		die();
		$Split_Product = explode(",", $product);
		foreach ($Split_Product as $SingleProduct)
		{
			$ConsignorProductExist=Check_ConsignorProductExist($Consignorid, $SingleProduct);
//			echo("ConsignorProductExist :- $ConsignorProductExist </br>");
//			die();
			if($ConsignorProductExist>0) {
//				echo("Activation Mode...");
//				die();
				Set_ConsignorProductActive($con, $CurrentDate, $session_userid, $session_ip, $Consignorid, $SingleProduct);
			}
			else {
//				echo("Reached here.... </br>");
//				die();
				$Procedure = "";
				$Procedure = "Call Save_ConsignorProduct('$CurrentDate', $session_userid, '$session_ip', $Consignorid, $SingleProduct);";
//				echo("Procedure :- $Procedure </br>");
//				die();
				mysqli_close($con);
				include('db_connect.php');
				$resultproduct = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save consignor product)! Error: " . mysqli_error($con), E_USER_ERROR);
			}
		}

	}
	function Update_ConsignorUrl($con, $Consignorid, $Url)
	{
		$sqlQry= "select ccid from `consignorcontact_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and ctmid=3";
		$sqlQry= $sqlQry." and Active=1";
		//		echo ("Check sqlQry :- $sqlQry </br>");
		//		die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				$ConsignorContactID=$row{0};
				$Contact="";
				if($inc==1){
					$Contact=$Url;
					$sqlQry1= "";
					$sqlQry1= "update `consignorcontact_master`";
					$sqlQry1.=" set Contact='$Contact'";
					$sqlQry1.=" where ccid=$ConsignorContactID ";
//					echo ("Check sqlQry :- $sqlQry1 </br>");
//					die();
					mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
			}
		}
		mysqli_free_result($result);
	}

	function Update_ConsignorEmail($con, $Consignorid, $Email)
	{
		$sqlQry= "select ccid from `consignorcontact_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and ctmid=2";
		$sqlQry= $sqlQry." and Active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				$ConsignorContactID=$row{0};
				$Contact="";
				if($inc==1){
					$Contact=$Email;
					$sqlQry1= "";
					$sqlQry1= "update `consignorcontact_master`";
					$sqlQry1.=" set Contact='$Contact'";
					$sqlQry1.=" where ccid=$ConsignorContactID ";
	//					echo ("Check sqlQry :- $sqlQry1 </br>");
	//					die();
					mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
			}
		}
		mysqli_free_result($result);
	}

	function Update_ConsignorTelephone($con, $Consignorid, $telephone1, $telephone2, $telephone3)
	{
		$sqlQry= "select ccid from `consignorcontact_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and ctmid=1";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				$ConsignorContactID=$row{0};
				$Contact="";
				if($inc==1){
					$Contact=$telephone1;
					$sqlQry1= "";
					$sqlQry1= "update `consignorcontact_master`";
					$sqlQry1.=" set Contact='$Contact'";
					$sqlQry1.=" where ccid=$ConsignorContactID ";
//					echo ("Check sqlQry :- $sqlQry1 </br>");
//					die();
					mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
				elseif($inc==2){
					$Contact=$telephone2;
					$sqlQry1= "";
					$sqlQry1= "update `consignorcontact_master`";
					$sqlQry1.=" set Contact='$Contact'";
					$sqlQry1.=" where ccid=$ConsignorContactID ";
//					echo ("Check sqlQry :- $sqlQry1 </br>");
//					die();
					mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
				elseif($inc==3){
					$Contact=$telephone3;
					$sqlQry1= "";
					$sqlQry1= "update `consignorcontact_master`";
					$sqlQry1.=" set Contact='$Contact'";
					$sqlQry1.=" where ccid=$ConsignorContactID ";
//					echo ("Check sqlQry :- $sqlQry1 </br>");
//					die();
					mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
			}
		}
		mysqli_free_result($result);
	}