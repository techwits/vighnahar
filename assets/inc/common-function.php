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
//			echo("Procedure :- $Procedure </br>");
//			die();
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

		// mysqli_close($con);
		include('db_connect.php');

		$LogStart_Value="";
		$LogTable_ID=Insert_LogTableStart($con, $CurrentDate, $Creator, $ip, $PageName, $inTime);
//		echo ("LogTable_ID:- ".$LogTable_ID."</br>");
//		die();

		// mysqli_close($con);
		include('db_connect.php');

		$TableListID=Get_TableListID($con, $tablename);
//		echo ("TableListID :- $TableListID </br>");
//		echo ("tablename :- $tablename </br>");
//		echo ("searchColumn :- $searchColumn </br>");
//		echo ("searchColumn_Value :- $searchColumn_Value </br>");
//		echo ("LogTable_ID :- $LogTable_ID </br>");
//		echo ("TableListID :- $TableListID </br>");
//		die();


		// mysqli_close($con);
		include('db_connect.php');
		$oldValue="";
		if ( (strlen(trim($searchColumn))>0 and strlen(trim($searchColumn_Value))>0) ) {
			$oldValue = Get_OldValue($con, $tablename, $searchColumn, $searchColumn_Value);
//			echo ("Old Value :- $oldValue </br></br></br>");
//			die();
		}

//		echo ("LogTable_ID :- $LogTable_ID </br>");
//		echo ("TableListID :- $TableListID </br>");
//		echo ("oldValue :- $oldValue </br>");
//		die();

		$LogStart_Value=trim($LogTable_ID)."|<>|".trim($TableListID)."|<>|".trim($oldValue);
//		echo ("LogStart_Value :- $LogStart_Value </br>");
//		die();
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


	function Get_LROnConsignor($con, $ConsignorID)
	{
		$Getting_LROnConsignor="";
		$cols="`inward`.LRID";
		$sqlQry= "";
		$sqlQry.= "select $cols from `inward`";

		$sqlQry.= "inner join `outwardlr`";
		$sqlQry.= "on `inward`.LRID=`outwardlr`.`iid`";

		$sqlQry.= " where `inward`.caid=$ConsignorID";
		$sqlQry.= " and (`outwardlr`.RMStatus=2 or `outwardlr`.RMStatus=3)";
//		$sqlQry.= " and `inward`.Active=1";
		$sqlQry.= " and `outwardlr`.Active=1";

//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$i=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$i=$i+1;
				if($i==1){
					$Getting_LROnConsignor=$row{0};
				}
				else{
					$Getting_LROnConsignor=$Getting_LROnConsignor.",".$row{0};
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_LROnConsignor;
	}


	function Get_acmid($con, $ChargeName)
	{
		$Getting_acmid=0;
		$sqlQry= "";
		$sqlQry= "select acmid from `additionalcharge_master`";
		$sqlQry.= " where ChargeName='$ChargeName'";
		$sqlQry.= " and Active=1";
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
				$Getting_acmid=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_acmid;
	}


	function Get_BillStatusOnLRID($con, $SingleLR)
	{
		$Getting_BillStatusOnLRID=0;
		$sqlQry= "";
		$sqlQry= "select Bill from `outwardlr`";
		$sqlQry= $sqlQry." where iid=$LRID";
		$sqlQry= $sqlQry." and Active=1";
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
				$Getting_BillStatusOnLRID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_BillStatusOnLRID;
	}

	function Get_LRRate_LRQuantityCount($con, $LRID)
	{
		$Getting_LRRate_LRQuantityCount="";
		$sqlQry= "";
		$sqlQry= "select Rate, Quantity from `inward`";
		$sqlQry= $sqlQry." where LRID=$LRID";
		$sqlQry= $sqlQry." and Active=1";
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
				$Getting_LRRate_LRQuantityCount=$row{0}.",".$row{1};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRRate_LRQuantityCount;
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




	function Get_LRAdditionalCharge($con, $LRID, $acmid)
	{
		$Getting_LRAdditionalCharge=0;
		$sqlQry= "";
		$sqlQry= "select Amount from inwardcharge";
		$sqlQry.= " where LRID=$LRID";
		$sqlQry.= " and acmid=$acmid";
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
				$Getting_LRAdditionalCharge=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRAdditionalCharge;
	}

	function Get_ConsigneeArea($con, $cnid)
	{
		$Getting_ConsigneeArea="";
		$sqlQry= "";
		$sqlQry= "select area_master.AreaName from consignee_master";

		$sqlQry.= " inner join consigneeaddress_master";
		$sqlQry.= " on consignee_master.cnid=consigneeaddress_master.cnid";

		$sqlQry.= " inner join area_master";
		$sqlQry.= " on consigneeaddress_master.amid=area_master.amid";

		$sqlQry.= " where consignee_master.cnid=$cnid";
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
				$Getting_ConsigneeArea=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeArea;
	}

	function Get_previousolrid($con, $olrid)
	{
		$Getting_previousolrid=0;
		$sqlQry= "";
		$sqlQry= "select prv_olrid from outwardlr";
		$sqlQry.= " where olrid=$olrid";
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
				$Getting_previousolrid=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_previousolrid;
	}

	function Get_MinimumRate($con, $consignorid, $consigneeid, $productid)
	{
		$Getting_MinimumRate=0;
		$sqlQry= "";
		$sqlQry= "select MinimumRate from rate_master";
		$sqlQry.= " where caid=$consignorid";
		$sqlQry.= " and cnid=$consigneeid";
		$sqlQry.= " and pmid=$productid";
		$sqlQry.= " and Active=1";
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
				$Getting_MinimumRate=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MinimumRate;
	}

	function Get_RoadMemoLRPackageCount($con, $oid)
	{
		$Getting_RoadMemoLRPackageCount=0;
		$sqlQry= "";
		$sqlQry.= "select sum(inward.Quantity) from  outwardlr ";
		$sqlQry.= "inner join inward ";
		$sqlQry.= "on outwardlr.iid=inward.iid ";
		$sqlQry.= " where outwardlr.oid=$oid";
		$sqlQry.= " and outwardlr.Active=1";
		$sqlQry.= " and inward.Active=1";
//			echo ("</br> $sqlQry </br>");
	//		die();
		include('db_connect.php');
		$rs = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($rs)!=0){
			while ($row = mysqli_fetch_array($rs,MYSQLI_NUM)){
				$Getting_RoadMemoLRPackageCount=$row{0};
			}
		}
		mysqli_free_result($rs);
		return $Getting_RoadMemoLRPackageCount;
	}


	function Get_RoadMemoLRCount($con, $oid)
	{
		$Getting_RoadMemoLRCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from  outwardlr ";
		$sqlQry.= " where oid=$oid";
		$sqlQry.= " and Active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$rs = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($rs)!=0){
			while ($row = mysqli_fetch_array($rs,MYSQLI_NUM)){
				$Getting_RoadMemoLRCount=$row{0};
			}
		}
		mysqli_free_result($rs);
		return $Getting_RoadMemoLRCount;
	}

	function Get_RoadMemoLR($con, $RMID)
	{
		$Getting_RoadMemoLR="";
		$sqlQry= "";
		$sqlQry= "select iid from  outwardlr ";
		$sqlQry.= " where oid=$RMID";
		$sqlQry.= " and Active=1";
		//		echo ("$sqlQry");
		//		die();
		//		mysqli_close($con);
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
					$Getting_RoadMemoLR=$row{0};
				}
				else{
					$Getting_RoadMemoLR=$Getting_RoadMemoLR.",".$row{0};
				}

			}
		}
		mysqli_free_result($result);
		return $Getting_RoadMemoLR;
	}

	function Get_TransporterName($con, $TransporterID)
	{
		$Getting_TransporterName="";
		$sqlQry= "";
		$sqlQry= "select TransporterName from  transporter_master ";
		$sqlQry.= " where tmid=$TransporterID";
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
				$Getting_TransporterName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_TransporterName;
	}


	function Get_VehicleNumber($con, $VehicleID)
	{
		$Getting_VehicleNumber="";
		$sqlQry= "";
		$sqlQry= "select VehicleNumber from vehicle_master ";
		$sqlQry.= " where vmid=$VehicleID";
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
				$Getting_VehicleNumber=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_VehicleNumber;
	}
	function Get_FinancialYearOnID($con, $FinancialID)
	{
		$Getting_FinancialYearOnID="";
		$sqlQry= "";
		$sqlQry= "select FinancialYear from financialyear_master ";
		$sqlQry.= " where fyid=$FinancialID";
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
				$Getting_FinancialYearOnID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_FinancialYearOnID;
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
		// mysqli_close($con);
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

	function Get_LRBillAmount($con, $LRID)
	{
		$Getting_LRBillAmount=0;
		$sqlQry= "";
		$sqlQry= "select sum(outwardlrbill.Amount) from outwardlr ";
		$sqlQry.= " inner join outwardlrbill";
		$sqlQry.= " on outwardlr.olrid=outwardlrbill.olrid";

		$sqlQry.= " where outwardlr.iid=$LRID";
		$sqlQry.= " and outwardlr.Active=1";
		$sqlQry.= " and outwardlrbill.Active=1";

//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_LRBillAmount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRBillAmount;
	}

	function Get_LRRoadMemo($con, $Status)
	{
		$Getting_LRRoadMemo=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from inward ";
		$sqlQry.= " left join outwardlr";
		$sqlQry.= " on inward.LRID = outwardlr.iid";
		$sqlQry.= " where 1=1";
		if($Status==1) {
			$sqlQry.= " and outwardlr.iid IS NULL";
		}
		$sqlQry.= " and inward.active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_MasterDataCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MasterDataCount;
	}

	function Get_LRStatusCount($con, $Status)
	{
		$Getting_LRDelivered=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from outwardlr ";
		$sqlQry.= " where 1=1";
		if($Status==1) {
			$sqlQry .= " and RMStatus > 0";
		}
		elseif($Status==2) {
			$sqlQry .= " and RMStatus=2";
		}
		elseif($Status==3) {
			$sqlQry .= " and RMStatus=0";
		}
		$sqlQry.= " and active=1";
		//		echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRDelivered=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRDelivered;
	}


	function Get_OLRIDOnLRID($con, $LRID)
	{
		$Getting_OLRID=0;
		$sqlQry= "";
		$sqlQry= "select olrid from outwardlr ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and iid=$LRID";
		$sqlQry.= " and active=1";
	//		echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_OLRID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_OLRID;
	}
	function Get_RMStatusOnLRID($con, $LRID)
	{
		$Getting_RMStatus=0;
		$sqlQry= "";
		$sqlQry= "select RMStatus from outwardlr ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and iid=$LRID";
		$sqlQry.= " and active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_RMStatus=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_RMStatus;
	}

	function Get_RMCountDayAvarage($con, $StartDate, $EndDate)
	{
		$DayAvarage=0;
		$sqlQry= "";
		$sqlQry= "select TransitDate, count(*) from outward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (TransitDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and active=1";
		$sqlQry.= " GROUP by TransitDate ";
		$sqlQry.= " order by TransitDate";
	//		echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$RowCount=0;
			$RMCount=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$RowCount=$RowCount+1;
				$RMCount=$RMCount+$row{1};
			}
		}
		$DayAvarage=round($RMCount/$RowCount,2);
	//		echo("RMCount :- $RMCount </br>");
	//		echo("RowCount :- $RowCount </br>");
	//		echo("DayAvarage :- $DayAvarage </br>");

		mysqli_free_result($result);
		return $DayAvarage;
	}

	function Get_LRCountDayAvarage($con, $StartDate, $EndDate)
	{
		$DayAvarage=0;
		$sqlQry= "";
		$sqlQry= "select ReceivedDate, count(*) from inward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and active=1";
		$sqlQry.= " GROUP by ReceivedDate ";
		$sqlQry.= " order by ReceivedDate";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$RowCount=0;
			$LRCount=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$RowCount=$RowCount+1;
				$LRCount=$LRCount+$row{1};
			}
		}
		$DayAvarage=round($LRCount/$RowCount,2);
//		echo("LRCount :- $LRCount </br>");
//		echo("RowCount :- $RowCount </br>");
//		echo("DayAvarage :- $DayAvarage </br>");

		mysqli_free_result($result);
		return $DayAvarage;
	}

	function Get_LRPackagesReturnCountMonth($con, $StartDate, $EndDate)
	{
		$Getting_LRPackagesReturnCountMonth=0;
		$sqlQry= "";
		$sqlQry= "select sum(outwardlrbill.Quantity) from inward ";

		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";

		$sqlQry.= " inner join outwardlrbill";
		$sqlQry.= " on outwardlr.olrid=outwardlrbill.olrid";

		$sqlQry.= " where 1=1";
		$sqlQry.= " and (inward.ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and outwardlr.RMStatus>0";
		$sqlQry.= " and outwardlrbill.acmid=5";

		$sqlQry.= " and inward.Active=1";
		$sqlQry.= " and outwardlr.Active=1";
		$sqlQry.= " and outwardlrbill.Active=1";
//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRPackagesReturnCountMonth=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRPackagesReturnCountMonth;
	}


	function Get_LRPackagesInTransitCountMonth($con, $StartDate, $EndDate)
	{
		$Getting_LRPackagesInTransitCountMonth=0;
		$sqlQry= "";
		$sqlQry= "select sum(Quantity) from inward ";
		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (inward.ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and outwardlr.RMStatus=0";
		$sqlQry.= " and inward.active=1";
		$sqlQry.= " and outwardlr.active=1";
	//			echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRPackagesInTransitCountMonth=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRPackagesInTransitCountMonth;
	}


	function Get_LRPackagesCountMonth($con, $StartDate, $EndDate)
	{
		$Getting_LRPackagesCountMonth=0;
		$sqlQry= "";
		$sqlQry= "select sum(Quantity) from inward ";
		$sqlQry.= " left join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (inward.ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and outwardlr.iid IS NULL";
		$sqlQry.= " and inward.active=1";
//			echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRPackagesCountMonth=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRPackagesCountMonth;
	}


	function Get_RMCountMonth($con, $StartDate, $EndDate)
	{
		$Getting_RMCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from outward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (TransitDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_RMCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_RMCount;
	}

	function Get_LRCountMonth($con, $StartDate, $EndDate)
	{
		$Getting_LRCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from inward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " and active=1";
//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRCount;
	}


	function Get_PackagesFinancialYear($con, $FinancialYearID)
	{
		$Getting_PackagesFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select sum(Quantity) from inward ";

		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and inward.Active=1";

//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_PackagesFinancialYear=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_PackagesFinancialYear;
	}


	function Get_VehicleFinancialYear($con, $FinancialYearID)
	{
		$Getting_VehicleFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select outward.vmid, count(*) from outward ";


		$sqlQry.= " where 1=1";
		$sqlQry .= " and outward.fyid=$FinancialYearID";
		$sqlQry .= " and outward.Active=1";

		$sqlQry.= " group by outward.vmid";
		$sqlQry.= " order by outward.vmid";
		//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_VehicleFinancialYear=mysqli_num_rows($result);
			//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
			////				$Getting_AreaServedFinancialYear=$row{0};
			//				$AreaServed=$AreaServed+1;
			//			}
		}
		mysqli_free_result($result);
		return $Getting_VehicleFinancialYear;
	}

	function Get_ProductsFinancialYear($con, $FinancialYearID)
	{
		$Getting_ProductsFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select product_master.pmid, count(*) from inward ";
	
		$sqlQry.= " inner join product_master";
		$sqlQry.= " on inward.pmid=product_master.pmid";
	
	
		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and inward.Active=1";
	
		$sqlQry.= " group by product_master.pmid";
		$sqlQry.= " order by product_master.pmid";
//						echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_ProductsFinancialYear=mysqli_num_rows($result);
	//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
	////				$Getting_AreaServedFinancialYear=$row{0};
	//				$AreaServed=$AreaServed+1;
	//			}
		}
		mysqli_free_result($result);
		return $Getting_ProductsFinancialYear;
	}

	function Get_TripsFinancialYear($con, $FinancialYearID)
	{
		$Getting_TripsFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select oid from outward ";

		$sqlQry.= " where 1=1";
		$sqlQry .= " and outward.fyid=$FinancialYearID";
		$sqlQry .= " and outward.Active=1";

		//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_TripsFinancialYear=mysqli_num_rows($result);
			//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
			////				$Getting_AreaServedFinancialYear=$row{0};
			//				$AreaServed=$AreaServed+1;
			//			}
		}
		mysqli_free_result($result);
		return $Getting_TripsFinancialYear;
	}

	function Get_ConsignorFinancialYear($con, $FinancialYearID)
	{
		$Getting_ConsignorFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select inward.caid, count(*) from inward ";


		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and inward.Active=1";

		$sqlQry.= " group by inward.caid";
		$sqlQry.= " order by inward.caid";
		//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_ConsignorFinancialYear=mysqli_num_rows($result);
			//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
			////				$Getting_AreaServedFinancialYear=$row{0};
			//				$AreaServed=$AreaServed+1;
			//			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorFinancialYear;
	}


	function Get_ConsigneeFinancialYear($con, $FinancialYearID)
	{
		$Getting_ConsigneeFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select inward.cnid, count(*) from inward ";


		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and inward.Active=1";

		$sqlQry.= " group by inward.cnid";
		$sqlQry.= " order by inward.cnid";
	//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_ConsigneeFinancialYear=mysqli_num_rows($result);
	//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
	////				$Getting_AreaServedFinancialYear=$row{0};
	//				$AreaServed=$AreaServed+1;
	//			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeFinancialYear;
	}

	function Get_AreaServedFinancialYear($con, $FinancialYearID)
	{
		$Getting_AreaServedFinancialYear=0;
		$sqlQry= "";
		$sqlQry= "select consigneeaddress_master.amid, count(*) from inward ";

		$sqlQry.= " inner join consigneeaddress_master";
		$sqlQry.= " on inward.cnid=consigneeaddress_master.cnid";


		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and inward.Active=1";

		$sqlQry.= " group by consigneeaddress_master.amid";
		$sqlQry.= " order by consigneeaddress_master.amid";
//					echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_AreaServedFinancialYear=mysqli_num_rows($result);
//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
////				$Getting_AreaServedFinancialYear=$row{0};
//				$AreaServed=$AreaServed+1;
//			}
		}
		mysqli_free_result($result);
		return $Getting_AreaServedFinancialYear;
	}

//	function Get_BillReceivedAmountFinancialYear($con, $FinancialYearID)
//	{
//		$BillReceivedAmountFinancialYear=0;
//		$sqlQry= "";
//		$sqlQry= "select sum(BillAmount) from bill ";
//		$sqlQry.= " where 1=1";
//		$sqlQry .= " and bill.fyid=$FinancialYearID";
//		$sqlQry .= " and bill.Active=1";
//		//					echo ("$sqlQry");
//		//		die();
//		include('db_connect.php');
//		$result = mysqli_query($con, $sqlQry);
//		//fetch tha data from the database
//		if (mysqli_num_rows($result)!=0){
//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
//				$BillAmountFinancialYear=$row{0};
//			}
//		}
//		mysqli_free_result($result);
//		return $BillAmountFinancialYear;
//	}
//
//
//	function Get_BillAmountFinancialYear($con, $FinancialYearID)
//	{
//		$BillAmountFinancialYear=0;
//		$sqlQry= "";
//		$sqlQry= "select sum(BillAmount) from bill ";
//		$sqlQry.= " where 1=1";
//		$sqlQry .= " and bill.fyid=$FinancialYearID";
//		$sqlQry .= " and bill.Active=1";
//	//					echo ("$sqlQry");
//		//		die();
//		include('db_connect.php');
//		$result = mysqli_query($con, $sqlQry);
//		//fetch tha data from the database
//		if (mysqli_num_rows($result)!=0){
//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
//				$BillAmountFinancialYear=$row{0};
//			}
//		}
//		mysqli_free_result($result);
//		return $BillAmountFinancialYear;
//	}


	function Get_BillNotGeneratedCountFinancialYear($con, $FinancialYearID)
		{
			$Getting_BillNotGenerated=0;
			$sqlQry= "";
			$sqlQry= "select caid, count(*) from inward ";

			$sqlQry.= " inner join outwardlr";
			$sqlQry.= " on inward.LRID=outwardlr.iid";

			$sqlQry.= " where 1=1";
			$sqlQry .= " and inward.fyid=$FinancialYearID";
			$sqlQry .= " and outwardlr.Bill=0";
			$sqlQry .= " and inward.Active=1";
			$sqlQry .= " and outwardlr.Active=1";

			$sqlQry.= " group by inward.caid";
			$sqlQry.= " order by inward.caid";
//					echo ("$sqlQry");
			//		die();
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			//fetch tha data from the database
			if (mysqli_num_rows($result)!=0){
				$Getting_BillNotGenerated=mysqli_num_rows($result);
//				while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
//					$Getting_BillNotGenerated=$row{0};
//				}
			}
			mysqli_free_result($result);
			return $Getting_BillNotGenerated;
		}


	function Get_BillNotGeneratedAmountFinancialYear($con, $FinancialYearID)
	{
		$Getting_BillNotGeneratedAmount=0;
		$sqlQry= "";
		$sqlQry= "select sum(outwardlrbill.Amount) from inward ";

		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";

		$sqlQry.= " inner join outwardlrbill";
		$sqlQry.= " on outwardlr.olrid=outwardlrbill.olrid";

		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and outwardlr.Bill=0";
		$sqlQry .= " and inward.Active=1";
		$sqlQry .= " and outwardlr.Active=1";
		$sqlQry .= " and outwardlrbill.Active=1";


	//		echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_BillNotGeneratedAmount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_BillNotGeneratedAmount;
	}

	function Get_BillGeneratedAmountFinancialYear($con, $FinancialYearID)
	{
		$Getting_BillGeneratedAmount=0;
		$sqlQry= "";
		$sqlQry= "select sum(outwardlrbill.Amount) from inward ";

		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";

		$sqlQry.= " inner join outwardlrbill";
		$sqlQry.= " on outwardlr.olrid=outwardlrbill.olrid";

		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and outwardlr.Bill=1";
		$sqlQry .= " and inward.Active=1";
		$sqlQry .= " and outwardlr.Active=1";
		$sqlQry .= " and outwardlrbill.Active=1";


//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
				while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
					$Getting_BillGeneratedAmount=$row{0};
				}
		}
		mysqli_free_result($result);
		return $Getting_BillGeneratedAmount;
	}


	function Get_BillGeneratedCountFinancialYear($con, $FinancialYearID)
	{
		$Getting_BillGenerated=0;
		$sqlQry= "";
		$sqlQry= "select caid, count(*) from inward ";

		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";

		$sqlQry.= " where 1=1";
		$sqlQry .= " and inward.fyid=$FinancialYearID";
		$sqlQry .= " and outwardlr.Bill=1";
		$sqlQry .= " and inward.Active=1";
		$sqlQry .= " and outwardlr.Active=1";

		$sqlQry.= " group by inward.caid";
		$sqlQry.= " order by inward.caid";
//			echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$Getting_BillGenerated=mysqli_num_rows($result);
//			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
//				$Getting_BillGenerated=$row{0};
//			}
		}
		mysqli_free_result($result);
		return $Getting_BillGenerated;
	}

	function Get_RMCountFinancialYear($con, $FinancialYearID)
	{
		$Getting_RMCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from outward ";
		$sqlQry.= " where 1=1";
		$sqlQry .= " and fyid=$FinancialYearID";
		$sqlQry.= " and active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_RMCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_RMCount;
	}

	function Get_BillCountFinancialYear($con, $FinancialYearID)
	{
		$Getting_BillCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from bill ";
		$sqlQry.= " where 1=1";
		$sqlQry .= " and fyid=$FinancialYearID";
		$sqlQry.= " and active=1";
	//				echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_BillCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_BillCount;
	}

	function Get_LRCountFinancialYear($con, $FinancialYearID)
	{
		$Getting_LRCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from inward ";
		$sqlQry.= " where 1=1";
		$sqlQry .= " and fyid=$FinancialYearID";
		$sqlQry.= " and active=1";
//				echo ("$sqlQry");
		//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRCount;
	}

	function Get_LRCountInTransit($con)
	{
		$Getting_LRCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from outwardlr ";
		$sqlQry.= " where 1=1";
		$sqlQry .= " and RMStatus=0";
		$sqlQry.= " and active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LRCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRCount;
	}

	function Get_MasterDataCount($con, $TableName)
	{
		$Getting_MasterDataCount=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from $TableName ";
		$sqlQry.= " where active=1";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_MasterDataCount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MasterDataCount;
	}

	function Get_RMEntry_30Days($con)
	{
		$RMEntry_30Days="";
		$RMEntry_30Days_DayList="";
		$RMEntry_30Days_CountList="";

		$EndDate = date('Y-m-d')." 23:59:59";
		$StartDate=date('Y-m-d', strtotime('today - 30 days'));
//		echo(" StartDate :- $StartDate </br>");
//		echo(" EndDate :- $EndDate </br>");
//		die();
		$sqlQry= "";
		$sqlQry= "select TransitDate, count(*) from  outward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (TransitDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " group by TransitDate";
		$sqlQry.= " order by TransitDate";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$inc=$inc+1;
				$Day=0;
				$Valide=validateDate($row{0});
//				echo("Valide :- $Valide </br>");
				if($Valide==1){
					$Split_Date = explode("-", $row{0});
					$Day=$Split_Date[2];
//					echo("Valide :- $row{0} </br>");
//					echo("Day :- $Day </br>");
				}
				$inc==1?$RMEntry_30Days=$row{1}.".".$Day:$RMEntry_30Days=$RMEntry_30Days.",".$row{1}.".".$Day;

				$inc==1?$RMEntry_30Days_DayList=$Day:$RMEntry_30Days_DayList=$RMEntry_30Days_DayList.",".$Day;

				$inc==1?$RMEntry_30Days_CountList=$row{1}:$RMEntry_30Days_CountList=$RMEntry_30Days_CountList.",".$row{1};

			}
		}
		$Club="";
		$Club=$RMEntry_30Days."||".$RMEntry_30Days_DayList."||".$RMEntry_30Days_CountList;

		mysqli_free_result($result);
		return $Club;
	}

	function Get_LREntry_30Days($con)
	{
		$LREntry_30Days="";
		$LREntry_30Days_DayList="";
		$LREntry_30Days_CountList="";
		$EndDate = date('Y-m-d')." 23:59:59";
		$StartDate=date('Y-m-d', strtotime('today - 30 days'));
	//		echo(" StartDate :- $StartDate </br>");
	//		echo(" EndDate :- $EndDate </br>");
	//		die();
		$sqlQry= "";
		$sqlQry= "select ReceivedDate, count(*) from  inward ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and (ReceivedDate  BETWEEN  '$StartDate' AND '$EndDate')";
		$sqlQry.= " group by ReceivedDate";
		$sqlQry.= " order by ReceivedDate";
//			echo ("</br></br></br></br></br>$sqlQry");
	//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$inc=$inc+1;
				$Day=0;
				$Valide=validateDate($row{0});
	//				echo("Valide :- $Valide </br>");
				if($Valide==1){
					$Split_Date = explode("-", $row{0});
					$Day=$Split_Date[2];
	//					echo("Valide :- $row{0} </br>");
	//					echo("Day :- $Day </br>");
				}
				$inc==1?$LREntry_30Days=$row{1}.".".$Day:$LREntry_30Days=$LREntry_30Days.",".$row{1}.".".$Day;

				$inc==1?$LREntry_30Days_DayList=$Day:$LREntry_30Days_DayList=$LREntry_30Days_DayList.",".$Day;

				$inc==1?$LREntry_30Days_CountList=$row{1}:$LREntry_30Days_CountList=$LREntry_30Days_CountList.",".$row{1};
			}
		}
		$Club="";
		$Club=$LREntry_30Days."||".$LREntry_30Days_DayList."||".$LREntry_30Days_CountList;

		mysqli_free_result($result);
		return $Club;
	}

	function Get_LRDetails($con, $LRID)
	{
		$Getting_LRDetails="";

//		0 financialyear_master.FinancialYear ,
//		1 inward.ReceivedDate,
// 		2 inward.InvoiceNumber ,
//		3 vehicle_master.VehicleNumber ,
//		4 consignoraddress_master.Address,
// 		5 area_master.AreaName,
// 		6 consignoraddress_master.Pincode,
// 		7 consignoraddress_master.City ,
//		8 consignor_master.ConsignorName,
// 		9 consignor_master.Pancard ,
//		10 consignee_master.ConsigneeName ,
//		11 consigneeaddress_master.Address,
// 		12 a.AreaName,
// 		13 consigneeaddress_master.Pincode,
// 		14 consigneeaddress_master.City ,
//		15 product_master.ProductName ,
//		16 inward.PakageType,
// 		17 inward.Rate,
//		18 inward.Quantity,
// 		19 inward.Amount,
//		20 inward.Active

//		$cols=" financialyear_master.FinancialYear ";
//		$cols.=" ,inward.ReceivedDate, inward.InvoiceNumber ";
//		$cols.=" ,vehicle_master.VehicleNumber ";
//		$cols.=" ,consignoraddress_master.Address, area_master.AreaName, consignoraddress_master.Pincode, consignoraddress_master.City ";
//		$cols.=" ,consignor_master.ConsignorName, consignor_master.Pancard ";
//		$cols.=" ,consignee_master.ConsigneeName ";
//		$cols.=" ,consigneeaddress_master.Address, a.AreaName, consigneeaddress_master.Pincode, consigneeaddress_master.City ";
//		$cols.=" ,product_master.ProductName ";
//		$cols.=" ,inward.PakageType, inward.Rate,inward.Quantity, inward.Amount,inward.Active ";
// 		financialyear_master.FinancialYear ,inward.ReceivedDate, inward.InvoiceNumber ,vehicle_master.VehicleNumber ,consignoraddress_master.Address, area_master.AreaName, consignoraddress_master.Pincode, consignoraddress_master.City ,consignor_master.ConsignorName, consignor_master.Pancard ,consignee_master.ConsigneeName ,consigneeaddress_master.Address, a.AreaName, consigneeaddress_master.Pincode, consigneeaddress_master.City ,product_master.ProductName ,inward.PakageType, inward.Rate,inward.Quantity, inward.Amount,inward.Active

//		$sqlQry= "";
//		$sqlQry= "select $cols from inward ";
//
//		$sqlQry.= " inner join financialyear_master";
//		$sqlQry.= " on inward.fyid=financialyear_master.fyid";
//
//		$sqlQry.= " inner join vehicle_master";
//		$sqlQry.= " on inward.vmid=vehicle_master.vmid";
//
//		$sqlQry.= " inner join consignoraddress_master";
//		$sqlQry.= " on inward.caid=consignoraddress_master.caid";
//
//		$sqlQry.= " inner join area_master";
//		$sqlQry.= " on area_master.amid=consignoraddress_master.amid";
//
//		$sqlQry.= " inner join consignor_master";
//		$sqlQry.= " on consignor_master.cid=consignoraddress_master.cid";
//
//		$sqlQry.= " inner join consignee_master";
//		$sqlQry.= " on inward.cnid=consignee_master.cnid";
//
//		$sqlQry.= " inner join consigneeaddress_master";
//		$sqlQry.= " on consignee_master.cnid=consigneeaddress_master.cnid";
//
//		$sqlQry.= " inner join area_master as a";
//		$sqlQry.= " on a.amid=consigneeaddress_master.amid";
//
//		$sqlQry.= " inner join product_master";
//		$sqlQry.= " on inward.pmid=product_master.pmid";
//
//		$sqlQry.= " where inward.LRID=$LRID";
//
//		$sqlQry.= " and financialyear_master.Active=1";
//		$sqlQry.= " and vehicle_master.Active=1";
//		$sqlQry.= " and consignoraddress_master.Active=1";
//		$sqlQry.= " and area_master.Active=1";
//		$sqlQry.= " and consignor_master.Active=1";
//		$sqlQry.= " and consignee_master.Active=1";
//		$sqlQry.= " and consigneeaddress_master.Active=1";
//		$sqlQry.= " and product_master.Active=1";

		$sqlQry= "Call Select_LRDetails($LRID);";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_LRDetails=$row{0}."|/|~|/|".$row{1}."|/|~|/|".$row{2}."|/|~|/|".$row{3}."|/|~|/|".$row{4}."|/|~|/|".$row{5}."|/|~|/|".$row{6}."|/|~|/|".$row{7}."|/|~|/|".$row{8}."|/|~|/|".$row{9}."|/|~|/|".$row{10}."|/|~|/|".$row{11}."|/|~|/|".$row{12}."|/|~|/|".$row{13}."|/|~|/|".$row{14}."|/|~|/|".$row{15}."|/|~|/|".$row{16}."|/|~|/|".$row{17}."|/|~|/|".$row{18}."|/|~|/|".$row{19}."|/|~|/|".$row{20}."|/|~|/|".$row{21};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRDetails;
	}

	function Get_ConsigneeAreaOnLRID($con, $LRID)
	{
		$Getting_ConsigneeArea="";
		$sqlQry= "";
		$sqlQry= "select area_master.AreaName from  inward ";

		$sqlQry.= " inner join consignee_master";
		$sqlQry.= " on inward.cnid=consignee_master.cnid";

		$sqlQry.= " inner join consigneeaddress_master";
		$sqlQry.= " on consignee_master.cnid=consigneeaddress_master.cnid";

		$sqlQry.= " inner join area_master";
		$sqlQry.= " on area_master.amid=consigneeaddress_master.amid";

		$sqlQry.= " where inward.LRID=$LRID";
		//		echo ("$sqlQry");
		//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsigneeArea=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeArea;
	}

	function Get_ConsigneeNameOnLRID($con, $LRID)
	{
		$Getting_ConsigneeName="";
		$sqlQry= "";
		$sqlQry= "select consignee_master.ConsigneeName from  inward ";

		$sqlQry.= " inner join consignee_master";
		$sqlQry.= " on inward.cnid=consignee_master.cnid";

		$sqlQry.= " where inward.LRID=$LRID";
	//		echo ("$sqlQry");
	//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsigneeName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeName;
	}

	function Get_ConsignorAddressOnLRID($con, $LRID)
	{
		$Getting_ConsignorAddress="";
		$sqlQry= "";
		$sqlQry= "select consignoraddress_master.Address, area_master.AreaName, consignoraddress_master.Pincode, consignoraddress_master.City from  inward ";

		$sqlQry.= " inner join consignoraddress_master";
		$sqlQry.= " on inward.caid=consignoraddress_master.caid";

		$sqlQry.= " inner join area_master";
		$sqlQry.= " on consignoraddress_master.amid=area_master.amid";

		$sqlQry.= " where inward.LRID=$LRID";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsignorAddress=$row{0}."||".$row{1}.", ".$row{2}.", ".$row{3};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorAddress;
	}

	function Get_ConsignorNameOnLRID($con, $LRID)
	{
		$Getting_ConsignorName="";
		$sqlQry= "";
		$sqlQry= "select consignor_master.ConsignorName from  inward ";

		$sqlQry.= " inner join consignoraddress_master";
		$sqlQry.= " on inward.caid=consignoraddress_master.caid";

		$sqlQry.= " inner join consignor_master";
		$sqlQry.= " on consignor_master.cid=consignoraddress_master.cid";

		$sqlQry.= " where inward.LRID=$LRID";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsignorName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorName;
	}

	function Get_ConsigneeName($con, $ConsigneeID)
	{
		$Getting_ConsigneeName="";
		$sqlQry= "";
		$sqlQry= "select ConsigneeName from  consignee_master ";
		$sqlQry.= " where consignee_master.cnid=$ConsigneeID";
		//		echo ("$sqlQry");
		//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsigneeName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsigneeName;
	}

	function Get_LRGrandTotal($con, $LRID, $ReturnCharge, $ChargeBifurcation)
	{
		$Getting_LRGrandTotal=0;
		$sqlQry= "";
		$sqlQry= "select sum(Amount) from outwardlrbill ";
		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on outwardlrbill.olrid=outwardlr.olrid";
		$sqlQry.= " where outwardlr.iid=$LRID";
		if($ReturnCharge==2){

			$ChargeName="Goods Return";
			$acmid=Get_acmid($con, $ChargeName);
			if($ChargeBifurcation==1){
				$sqlQry.= " and outwardlrbill.acmid<>$acmid";
			}
			elseif($ChargeBifurcation==2){
				$sqlQry.= " and outwardlrbill.acmid=$acmid";
			}

		}
		$sqlQry.= " and outwardlr.Active=1";
		$sqlQry.= " and outwardlrbill.Active=1";
//		echo ("$sqlQry </br></br>");
		//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_LRGrandTotal=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRGrandTotal;
	}

	function Get_Receipt($con, $caid)
	{
		$Getting_Receipt=0;
		$sqlQry= "";
		$sqlQry= "select sum(Amount) from billreceipt ";
		$sqlQry.= " where caid=$caid";
		$sqlQry.= " And Active=1";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_Receipt=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_Receipt;
	}

	function Get_Consignor_FinancialYear_BillAmount($con, $caid, $fyid)
	{
		$Getting_Consignor_FinancialYear_BillAmount=0;
		$sqlQry= "";
		$sqlQry= "select sum(BillAmount) from bill ";
		$sqlQry.= " where caid=$caid";
		$sqlQry.= " and fyid=$fyid";
		$sqlQry.= " And Active=1";
	//		echo ("$sqlQry");
	//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_Consignor_FinancialYear_BillAmount=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_Consignor_FinancialYear_BillAmount;
	}

	function Get_Consignor_LastBillGeneratedDetails($con, $caid)
	{
		$Getting_Consignor_LastBillGeneratedDetails="";
		$sqlQry= "";
		$sqlQry= "select BillingDate, BillAmount from bill ";
		$sqlQry.= " where caid=$caid";
		$sqlQry.= " And Active=1";
		$sqlQry.= " Order by BillingDate Desc";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_Consignor_LastBillGeneratedDetails=$row{0}."|".$row{1};
			}
		}
		mysqli_free_result($result);
		return $Getting_Consignor_LastBillGeneratedDetails;
	}

	function Get_ConsignorName($con, $ConsignorAddressID)
	{
		$Getting_ConsignorName="";
		$sqlQry= "";
		$sqlQry= "select ConsignorName from consignor_master ";
		$sqlQry.= " inner join consignoraddress_master";
		$sqlQry.= " on consignor_master.cid=consignoraddress_master.cid";
		$sqlQry.= " where consignoraddress_master.caid=$ConsignorAddressID";
	//		echo ("$sqlQry");
	//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ConsignorName=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ConsignorName;
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
		// mysqli_close($con);
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
		// mysqli_close($con);
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

	function Fill_MasterPageList($con)
	{
		$sqlQry= "";
		$sqlQry= "select TableName, ColumnName, urlDescription from  1menusub ";
		$sqlQry.= " where PageType=1";
		$sqlQry.= " and TableName<>''";
		$sqlQry.= " and Active=1";
		$sqlQry.= " order by urlDescription";
		//echo ("$sqlQry");
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0}."||".$row{1};
			$Name=$row{2};
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_FinancialYear($con, $Prv, $Nxt)
	{
		$sqlQry= "";
		$sqlQry= "select fyid, FinancialYear from financialyear_master ";
		$sqlQry.= " where (fyid=$Prv or fyid=$Nxt)";
		$sqlQry.= " order by fyid";
		//echo ("$sqlQry");
		// mysqli_close($con);
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

	function Get_FirstColumnName($con, $TableName)
	{
//		echo ("TableName :- $TableName </br>");
//		die();
		$FirstColumnName="";
		$sqlQry= "";
		$sqlQry= "SHOW COLUMNS from $TableName";
//		echo ("sqlQry :- $sqlQry </br>");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			$inc=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$inc=$inc+1;
				if($inc==1) {
					$FirstColumnName = $row{0};
				}
			}
		}
		mysqli_free_result($result);
		return $FirstColumnName;
	}

	function Get_MasterDataID($con, $TableName, $ColumnName, $MasterData, $FirstColumnName)
	{
		$MasterDataID=0;
		$sqlQry= "";
		$sqlQry= "select $FirstColumnName from $TableName Where 1=1";
		$sqlQry.= " and $ColumnName='$MasterData'";
		$sqlQry.= " and Active=1";
		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$MasterDataID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $MasterDataID;
	}

	function Fill_Master_Delete($con, $TableName, $ColumnName, $FirstColumn)
	{
		$sqlQry= "";
		$sqlQry= "select $FirstColumn, $ColumnName from $TableName ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by $ColumnName";
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
			echo "<option value=".$ID.">".$Name." </option>";
		}
		mysqli_free_result($result);
	}

	function Fill_Master($con, $TableName, $ColumnName, $OrderBy)
	{
		$sqlQry= "";
		$sqlQry= "select $ColumnName from $TableName ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by $OrderBy";
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
		// mysqli_close($con);
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
		// mysqli_close($con);
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

	function Fill_UndeliveryReason($con)
	{
		$UndeliveryReason="";
		$sqlQry= "";
		$sqlQry= "select urid, UndeliveredReason from undeliveredreason_master ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by UndeliveredReason";
		//echo ("$sqlQry");
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0) {
			$inc = 0;
			$UndeliveryReason = "";
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
				$inc = $inc + 1;
				if ($inc == 1) {
					$UndeliveryReason = $row{0} . "~" . $row{1};
				} else {
					$UndeliveryReason = $UndeliveryReason . "||" . $row{0} . "~" . $row{1};
				}
			}
		}
			mysqli_free_result($result);
			return $UndeliveryReason;
	}

	function Fill_VehicleOwnership($con)
	{
		$sqlQry= "";
		$sqlQry= "select void, Ownership from vehicleownership_master ";
		$sqlQry.= " where Active=1";
		$sqlQry.= " order by Ownership";
		//echo ("$sqlQry");
		// mysqli_close($con);
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

	function Fill_Designation_Selected($con, $PrivilageID)
	{
		$sqlQry= "";
		$sqlQry= "select designationid, Designation, Privilage from designation_master ";
		$sqlQry.= " where 1=1";
		if($UserID==1) {
			$sqlQry .= " and designationid>=1";
		}
		elseif($UserID==2) {
			$sqlQry .= " and designationid>=2";
		}
		elseif($UserID==3) {
			$sqlQry .= " and designationid>=3";
		}
		$sqlQry.= " and Active=1";
		$sqlQry.= " order by designationid";
//		echo ("$sqlQry");

		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			$db_Privilage=$row{2};

//			echo("db_Privilage :- $db_Privilage </br>");
//			echo("PrivilageID :- $PrivilageID </br>");

			if($ID==$PrivilageID){
				echo "<option value=" . $ID . " selected>" . $Name . " </option>";
			}
			else {
				echo "<option value=" . $ID . ">" . $Name . " </option>";
			}
		}
		mysqli_free_result($result);
	}

	function Fill_Designation($con, $UserID)
		{
			$sqlQry= "";
			$sqlQry= "select designationid, Designation from designation_master ";
			$sqlQry.= " where 1=1";
			if($UserID==1) {
				$sqlQry .= " and designationid>=1";
			}
			elseif($UserID==2) {
				$sqlQry .= " and designationid>=2";
			}
			elseif($UserID==3) {
				$sqlQry .= " and designationid>=3";
			}
			$sqlQry.= " and Active=1";
			$sqlQry.= " order by designationid";
			//echo ("$sqlQry");
			// mysqli_close($con);
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

	function Fill_LoginName_Selective($con, $UserID)
		{
			$sqlQry = "";
			$sqlQry = " select loginid, UserName from login_master ";
			$sqlQry.= " where Privilage in";
			$sqlQry.= " ( ";
				$sqlQry.= "select Privilage from designation_master ";
				$sqlQry.= " where 1=1";
				if($UserID==1) {
					$sqlQry .= " and designationid>=1";
				}
				elseif($UserID==2) {
					$sqlQry .= " and designationid>=2";
				}
				elseif($UserID==3) {
					$sqlQry .= " and designationid>=3";
				}
			$sqlQry.= " ) ";
			$sqlQry.= " and Active=1";
			$sqlQry.= " order by UserName";
//			echo ("SwlQuery :- $sqlQry </br> ");
//			die();
			// mysqli_close($con);
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
			// mysqli_close($con);
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

	function Fill_ProductOnConsignor($con, $ConsignorID)
	{
		$sqlQry= "";
		$sqlQry= "select consignorproduct_master.pmid, product_master.ProductName from consignorproduct_master ";

		$sqlQry.= " inner join product_master";
		$sqlQry.= " on consignorproduct_master.pmid=product_master.pmid";

		$sqlQry.= " where consignorproduct_master.Active=1";
		$sqlQry.= " and product_master.Active=1";
		$sqlQry.= " and consignorproduct_master.caid=$ConsignorID";
//		$sqlQry.= " and rate_master.cnid=$ConsigneeID";
		$sqlQry.= " order by product_master.ProductName";
//			echo ("$sqlQry");
//			die();

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
//		die();

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
		// mysqli_close($con);
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


	function Get_UnbillCount($con)
	{
		$Getting_UnbillCount=0;
		$sqlQry= "";
		$sqlQry= "select caid, count(*) from inward ";
		$sqlQry.= " inner join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and outwardlr.RMStatus>0";
		$sqlQry.= " and outwardlr.Bill = 0 ";
		$sqlQry.= " and inward.Active=1";
		$sqlQry.= " and outwardlr.Active=1";
		$sqlQry.= " group by caid";
		$sqlQry.= " order by caid";
//		echo ("$sqlQry");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$Getting_UnbillCount=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_UnbillCount = $Getting_UnbillCount + 1;
			}
		}
		mysqli_free_result($result);
		return $Getting_UnbillCount;
	}

	function Fill_WraiLRForJS($con)
	{
		$Getting_WraiLRForJS="";
		$sqlQry= "";
		$sqlQry= "select iid from  outwardlr ";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and Bill=0";
		$sqlQry.= " and Active=1";
		$sqlQry.= " order by iid";
	//		echo ("$sqlQry");
	//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			$Getting_WraiLRForJS="";
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				if($inc==1) {
					$Getting_WraiLRForJS = "'".$row{0}."'";
				}
				else{
					$Getting_WraiLRForJS = $Getting_WraiLRForJS.", "."'".$row{0}."'";
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_WraiLRForJS;
	}

	function Fill_LRForJS($con)
	{
		$Getting_LRForJS="";
		$sqlQry= "";
		$sqlQry= "select inward.LRID from  inward ";
		$sqlQry.= " left join outwardlr";
		$sqlQry.= " on inward.LRID=outwardlr.iid";

		$sqlQry.= " where 1=1";
		$sqlQry.= " and outwardlr.iid IS NULL";


		$sqlQry.= " and inward.Active=1";

		$sqlQry.= " group by inward.LRID";
		$sqlQry.= " order by inward.LRID";
//		echo ("$sqlQry");
//		die();

		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		if (mysqli_num_rows($result)!=0)
		{
			$inc=0;
			$Getting_LRForJS="";
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$inc=$inc+1;
				if($inc==1) {
					$Getting_LRForJS = "'".$row{0}."'";
				}
				else{
					$Getting_LRForJS = $Getting_LRForJS.", "."'".$row{0}."'";
				}
			}
		}
		mysqli_free_result($result);
		return $Getting_LRForJS;
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
		// mysqli_close($con);
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

	function Fill_PageName_Selected($con, $UserID)
	{
		$sqlQry= "";
		$sqlQry= "select 1menusub.menusub_id, 1menusub.urlDescription, pageaccess_member.Active from 1menusub ";

		$sqlQry.= " left join pageaccess_member";
		$sqlQry.= " on 1menusub.menusub_id=pageaccess_member.menusub_id";

		$sqlQry.= " and 1menusub.Active=1";

		$sqlQry.= " order by 1menusub.urlDescription";
//		echo ("$sqlQry");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		//fetch tha data from the database
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
		{
			$ID=$row{0};
			$Name=$row{1};
			$Active=$row{2};
			if($Active==1) {
				echo "<option value=" . $ID . " selected>" . $Name . " </option>";
			}
			else{
				echo "<option value=" . $ID . ">" . $Name . " </option>";
			}
		}
		mysqli_free_result($result);
	}

	function Fill_PageName($con)
		{
			$sqlQry= "";
			$sqlQry= "select menusub_id, urlDescription from 1menusub ";
			$sqlQry.= " where Active=1";
			$sqlQry.= " order by urlDescription";
			//echo ("$sqlQry");
			// mysqli_close($con);
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


	function Get_OutwardLRID($con, $OutwardID, $InwardID)
	{
		$Getting_OutwardLRID=0;
		$sqlQry= "";
		$sqlQry= "select olrid from outwardlr ";
		$sqlQry= $sqlQry." where oid=$OutwardID";
		$sqlQry= $sqlQry." and iid=$InwardID";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))			{
				$Getting_OutwardLRID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_OutwardLRID;
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

	function Get_AdditionalCharges($con, $LRID)
	{
		$Getting_AdditionalCharges="";
		$sqlQry= "";
		$sqlQry= "select acmid, ChargeName from additionalcharge_master ";
		$sqlQry= $sqlQry." where 1=1";
		$sqlQry= $sqlQry." and Active=1";
		$sqlQry= $sqlQry." order by acmid";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			$i=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$i=$i+1;
				$acmid=$row{0};
				$$LR_AdditionalCharge=0;
				$LR_AdditionalCharge=Get_LR_AdditionalCharge($con, $LRID, $acmid);
//				echo("LR_AdditionalCharge :- $LR_AdditionalCharge </br>");
//				die();
				if($i==1) {
					$Getting_AdditionalCharges=$LR_AdditionalCharge;
				}
				else {
					$Getting_AdditionalCharges=$Getting_AdditionalCharges.", ".$LR_AdditionalCharge;
				}
			}
		}
		mysqli_free_result($result);
//		echo("Getting_AdditionalCharges :- $Getting_AdditionalCharges </br>");
		return $Getting_AdditionalCharges;
	}

	function Get_LR_AdditionalCharge($con, $LRID, $acmid)
	{
		$Getting_LR_AdditionalCharge=0;
		$sqlQry= "";
		$sqlQry= "select Amount from inwardcharge ";
		$sqlQry= $sqlQry." where LRID=$LRID";
		$sqlQry= $sqlQry." and acmid=$acmid";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_LR_AdditionalCharge=$row{0};
				$Getting_LR_AdditionalCharge=number_format((float)$Getting_LR_AdditionalCharge, 2, '.', '');
			}
		}
		mysqli_free_result($result);
		return $Getting_LR_AdditionalCharge;
	}

	function Get_AdditionalChargeList($con)
	{
		$Getting_allControlName="";
		$sqlQry= "";
		$sqlQry= "select ChargeName, ChargeFix, acmid from additionalcharge_master ";
		$sqlQry= $sqlQry." where (acmid>3 and acmid<8)";
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

	function Get_RoadExpenses($con)
	{
		$Getting_RoadExpenses=0;
		$sqlQry= "";
		$sqlQry= "select ChargeFix from `additionalcharge_master`";
		$sqlQry= $sqlQry." where acmid=1";
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
				$Getting_RoadExpenses = $row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_RoadExpenses;
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


	function Get_Count($con, $TableName, $ColumnName, $StartDate, $EndDate)
	{
		$Getting_TodaysLR=0;
		$sqlQry= "";
		$sqlQry= "select count(*) from `$TableName`";
		$sqlQry.= " where 1=1";
		$sqlQry.= " and ($ColumnName  BETWEEN  '$StartDate' AND '$EndDate')";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_TodaysLR = $row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_TodaysLR;
	}


	function Get_ProductName($con, $ProductID)
	{
		$Getting_ProductName="";
		$sqlQry= "";
		$sqlQry= "select ProductName from `product_master`";
		$sqlQry= $sqlQry." where pmid=$ProductID";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_ProductName = $row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ProductName;
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

	function Check_AreaExist($con, $AreaName)
	{
		$Getting_AreaExist=0;
		$sqlQry= "";
		$sqlQry= "select amid from area_master ";
		$sqlQry= $sqlQry." where AreaName='$AreaName'";
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
				$Getting_AreaExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_AreaExist;
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


	function Check_UserID($con, $userid)
	{
		$Getting_UserID=0;
		$sqlQry= "";
		$sqlQry= "select loginid from login_master";
		$sqlQry= $sqlQry." where UserID='$userid'";
		$sqlQry= $sqlQry." and Active=1";
//		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_UserID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_UserID;
	}

	function Check_DeliveryStatusID($con, $DeliveryStatusID)
	{
		$Getting_DeliveryStatusID=0;
		$sqlQry= "";
		$sqlQry= "select dsid from deliverystatus_master";
		$sqlQry= $sqlQry." where dsid=$DeliveryStatusID";
		$sqlQry= $sqlQry." and active=1";
		//		echo ("Check sqlQry :- $sqlQry </br>");
		//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_DeliveryStatusID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_DeliveryStatusID;
	}

	function Check_DuplicateEntry($con, $TableName, $ColumnName, $Searchin, $SearchValue, $AddEdit)
	{
		$Getting_DuplicateEntry=0;
		$sqlQry= "";
		$sqlQry= "select $ColumnName from $TableName where 1=1";
		$sqlQry.= " and $Searchin='$SearchValue'";
		if($AddEdit > 0){
			$sqlQry.= " and $ColumnName<>$AddEdit";
		}
		$sqlQry.=" and active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_MerchantExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_MerchantExist;
	}

	function Check_ContactTypeExist($con, $Contactname)
	{
		$Getting_ContactTypeExist=0;
		$sqlQry= "";
		$sqlQry= "select ctmid from contacttype_master";
		$sqlQry= $sqlQry." where Contactname='$Contactname'";
		$sqlQry= $sqlQry." and active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_ContactTypeExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ContactTypeExist;
	}

	function Check_DeliveryStatusExist($con, $DeliveryStatus)
	{
		$Getting_DeliveryStatusExist=0;
		$sqlQry= "";
		$sqlQry= "select dsid from deliverystatus_master";
		$sqlQry= $sqlQry." where DeliveryStatus='$DeliveryStatus'";
		$sqlQry= $sqlQry." and active=1";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_DeliveryStatusExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_DeliveryStatusExist;
	}

	function Check_ProductExist($con, $ProductName)
	{
		$Getting_ProductExist=0;
		$sqlQry= "";
		$sqlQry= "select pmid from product_master";
		$sqlQry= $sqlQry." where ProductName='$ProductName'";
		$sqlQry= $sqlQry." and active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$Getting_ProductExist=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_ProductExist;
	}

	function Check_PageAccess($con, $pagename, $username)
	{
		$Getting_PageAccess=0;
		$sqlQry= "";
		$sqlQry= "select id from pageaccess_member";
		$sqlQry= $sqlQry." where menusub_id=$pagename";
		$sqlQry= $sqlQry." and designation_id=$username";
//		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_PageAccess=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_PageAccess;
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

	function RMIDExist_ForLR($con, $oid)
	{
		$Getting_RMID_ForLR=0;
		$sqlQry= "select count(*) from  outwardlr ";
		$sqlQry.= " where oid=$oid";
		$sqlQry.= " and RMStatus>0";
		$sqlQry.= " and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$Getting_RMID_ForLR=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_RMID_ForLR;
	}

	function Check_LRIDExist_ForRM($con, $LRID)
	{
		$Getting_LRID_ForRM=0;

			$cols="outwardlr.olrid";
			$sqlQry= "select $cols from outwardlr ";
			$sqlQry.= " where 1=1";
			$sqlQry.= " and outwardlr.iid = $LRID";
			$sqlQry.= " and outwardlr.RMStatus <> 4";
	//		$sqlQry.= " and outwardlr.RMStatus=0";
			$sqlQry.= " and outwardlr.Active=1";
	
//			echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
			unset($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			if (mysqli_num_rows($result)!=0)
			{
				while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
				{
					$Getting_LRID_ForRM=$row{0};
				}
			}
			mysqli_free_result($result);
		return $Getting_LRID_ForRM;
	}


	function Check_LRIDExist($con, $LRID)
	{
		$Getting_LRID=0;
		$sqlQry= "";
		$sqlQry= "select LRID from `inward`";
		$sqlQry= $sqlQry." where LRID=$LRID";
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
				$Getting_LRID=$row{0};
			}
		}
		mysqli_free_result($result);
		return $Getting_LRID;
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

	function Check_ConsigneeAddressIDExist($con, $ConsigneeAddressID)
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
//				// mysqli_close($con);
//				include('db_connect.php');
//				$Updateresult = mysqli_query($con, $sqlQry1);
			}
		}
		mysqli_free_result($result);
		return $Getting_rmid;
	}

	function Clone_RMlr($con, $CurrentDate, $session_userid, $session_ip, $olrid)
	{
		$sql1= "";
		$sql1= "insert into outwardlr (CreationDate, Creator, ip, oid, iid, RMStatus, Bill, dsid, urid, prv_olrid, Active)";
		$sql1.=" select '$CurrentDate', $session_userid, '$session_ip', oid, iid, 0, 0, 0, 0, 0, 1 ";
		$sql1.=" from outwardlr ";
		$sql1.=" where olrid=$olrid ";
//		echo ("Check sqlQry :- $sql1 </br>");
//		die();
		include('db_connect.php');
		$inserts = mysqli_query($con, $sql1);
		mysqli_free_result($inserts);
	}

	function Set_RM_Deactive($con, $CurrentDate, $session_userid, $session_ip, $olrid)
	{
			$sql1= "";
			$sql1= "update `outwardlr`";
			$sql1.=" set ModificationDate='$CurrentDate',";
			$sql1.=" Creator=$session_userid, ";
			$sql1.=" ip='$session_ip', ";
			$sql1.=" Active=0 ";
			$sql1.=" where olrid=$olrid ";
//			echo ("Check sqlQry :- $sql1 </br>");
//			die();
			include('db_connect.php');
			$Updaters = mysqli_query($con, $sql1);
			mysqli_free_result($Updaters);
	}

	function Set_RMDependancyDeactive($con, $CurrentDate, $session_userid, $session_ip, $rmid)
	{
		$sql= "select olrid from `outwardlr`";
		$sql.= " where oid=$rmid";
		$sql.= " and Active=1";
//		echo ("Check sql :- $sql </br>");
//		die();
		include('db_connect.php');
		$rs = mysqli_query($con, $sql);
		if (mysqli_num_rows($rs)!=0) {
			while ($row = mysqli_fetch_array($rs, MYSQLI_NUM)) {
				$olrid=0;
				$olrid=$row{0};
				$sql1= "";
				$sql1= "update `outwardlr`";
				$sql1.=" set ModificationDate='$CurrentDate',";
				$sql1.=" Creator=$session_userid, ";
				$sql1.=" ip='$session_ip', ";
				$sql1.=" Active=0 ";
				$sql1.=" where olrid=$olrid ";
//				echo ("Check sqlQry :- $sql1 </br>");
//				die();
				include('db_connect.php');
				$Updaters = mysqli_query($con, $sql1);
				mysqli_free_result($Updaters);
			}
		}
	}

	function Set_RMDeactive($con, $CurrentDate, $session_userid, $session_ip, $rmid)
	{
		$sqlQry= "select oid from `outward`";
		$sqlQry.= " where oid=$rmid";
		$sqlQry.= " and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$oid=0;
				$oid=$row{0};
				$sqlQry1= "";
				$sqlQry1= "update `outward`";
				$sqlQry1.=" set ModificationDate='$CurrentDate',";
				$sqlQry1.=" Creator=$session_userid, ";
				$sqlQry1.=" ip='$session_ip', ";
				$sqlQry1.=" Active=0 ";
				$sqlQry1.=" where oid=$oid ";
//				echo ("Check sqlQry :- $sqlQry1 </br>");
//				die();
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);
				mysqli_free_result($Updateresult);
			}
		}
		mysqli_free_result($result);
		Set_RMDependancyDeactive($con, $CurrentDate, $session_userid, $session_ip, $rmid);
	}

	function Set_LRDeactive($con, $CurrentDate, $session_userid, $session_ip, $lrid)
	{
		$sqlQry= "select iid from `inward`";
		$sqlQry.= " where LRID=$lrid ";
		$sqlQry.= " and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$iid=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$iid=$row{0};
				$sqlQry1= "";
				$sqlQry1= "update `inward`";
				$sqlQry1.=" set ModificationDate='$CurrentDate',";
				$sqlQry1.=" Creator=$session_userid, ";
				$sqlQry1.=" ip='$session_ip', ";
				$sqlQry1.=" Active=0 ";
				$sqlQry1.=" where iid=$iid ";
//				echo ("Check sqlQry :- $sqlQry1 </br>");
//				die();
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);
				mysqli_free_result($Updateresult);
			}
		}
		mysqli_free_result($result);
	}


	function Set_BillDeactive($con, $CurrentDate, $session_userid, $session_ip, $BillID, $deletereason)
	{
		$Procedure="";
		$Procedure = "Call Delete_bill('$CurrentDate', $session_userid, '$session_ip', $BillID, '$deletereason');";
//		echo ("Procedure :- $Procedure </br>");
//		die();
//		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
		if (mysqli_num_rows($result) != 0) {
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			$LastInsertedID = $row{0};
			if($LastInsertedID>0){

				$sqlQry= "select blrid, olrid from `billlr`";
				$sqlQry.= " where bid=$BillID ";
				$sqlQry.= " and Active=1";
//				echo ("Check sqlQry :- $sqlQry </br>");
//				die();
				// mysqli_close($con);
				include('db_connect.php');
				$resultBill = mysqli_query($con, $sqlQry);
				if (mysqli_num_rows($resultBill)!=0)
				{
					$db_blrid=0;
					$db_olrid=0;
					while ($row = mysqli_fetch_array($resultBill,MYSQLI_NUM))
					{
						$db_blrid=$row{0};
						$db_olrid=$row{1};

						$ProcBilllr = "Call Delete_BillLR('$CurrentDate', $session_userid, '$session_ip', $db_blrid);";
						unset($con);
						include('db_connect.php');
						$resultBilllr = mysqli_query($con, $ProcBilllr) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
						mysqli_free_result($resultBilllr);

						$ProcOutwardlrBillStatus = "Call Delete_OutwardLR_BillStatus('$CurrentDate', $session_userid, '$session_ip', $db_olrid);";
						unset($con);
						include('db_connect.php');
						$resultOutwardlrBillStatus = mysqli_query($con, $ProcOutwardlrBillStatus) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
						mysqli_free_result($resultOutwardlrBillStatus);

					}
				}
				mysqli_free_result($resultBill);


				//Deactivate
			}
			else{
				echo("Bill Master :- Bill not deleted. Please contact administrator.....");
				die();
			}
		}
		mysqli_free_result($result);
	}

	function Set_OutwardDeactive($con, $CurrentDate, $session_userid, $session_ip, $OutwardID)
		{
			$sqlQry= "select olrid from `outwardlr`";
			$sqlQry.= " where oid=$OutwardID ";
			$sqlQry.= " and Active=1";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
			// mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			if (mysqli_num_rows($result)!=0)
			{
				$OutwardlrID=0;
				while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
				{
					$OutwardlrID=$row{0};
						$sqlQry1= "";
						$sqlQry1= "update `outwardlr`";
						$sqlQry1.=" set ModificationDate='$CurrentDate',";
						$sqlQry1.=" Creator=$session_userid, ";
						$sqlQry1.=" ip='$session_ip', ";
						$sqlQry1.=" Active=0 ";
						$sqlQry1.=" where olrid=$OutwardlrID ";
//						echo ("Check sqlQry :- $sqlQry1 </br>");
//						die();
						// mysqli_close($con);
						include('db_connect.php');
						$Updateresult = mysqli_query($con, $sqlQry1);

				}
			}
			mysqli_free_result($result);
		}

	function Set_PageAccessActive($con, $CurrentDate, $session_userid, $session_ip, $UserID, $PageID)
	{
		$sqlQry= "select id from `pageaccess_member`";
		$sqlQry= $sqlQry." where designation_id=$UserID ";
		$sqlQry= $sqlQry." and menusub_id=$PageID ";
		$sqlQry= $sqlQry." and Active=0";
	//		echo ("Check sqlQry :- $sqlQry </br>");
	//		die();
//		mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$ConsignorProductID=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$PageAccessID=$row{0};

				$sqlQry1= "";
				$sqlQry1= "update `pageaccess_member`";
				$sqlQry1.=" set ModificationDate='$CurrentDate',";
				$sqlQry1.=" Creator=$session_userid, ";
				$sqlQry1.=" ip='$session_ip', ";
				$sqlQry1.=" Active=1 ";
				$sqlQry1.=" where id=$PageAccessID ";
//				echo ("Check sqlQry :- $sqlQry1 </br>");
//				die();
//				mysqli_close($con);
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);
			}
		}
		mysqli_free_result($result);
	}

	function Set_PageAccessDeactive($con, $CurrentDate, $session_userid, $session_ip, $UserID)
	{
		$sqlQry= "select id from `pageaccess_member`";
		$sqlQry= $sqlQry." where designation_id=$UserID ";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			$ConsignorProductID=0;
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$PageAccessID=$row{0};

				$sqlQry1= "";
				$sqlQry1= "update `pageaccess_member`";
				$sqlQry1.=" set ModificationDate='$CurrentDate',";
				$sqlQry1.=" Creator=$session_userid, ";
				$sqlQry1.=" ip='$session_ip', ";
				$sqlQry1.=" Active=0 ";
				$sqlQry1.=" where id=$PageAccessID ";
//				echo ("Check sqlQry :- $sqlQry1 </br>");
//				die();
				// mysqli_close($con);
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);
			}
		}
		mysqli_free_result($result);
	}

	function Set_ConsignorProductDeactive($con, $CurrentDate, $session_userid, $session_ip, $Consignorid)
		{
			$sqlQry= "select cpid from `consignorproduct_master`";
			$sqlQry= $sqlQry." where caid=$Consignorid ";
			$sqlQry= $sqlQry." and Active=1";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
			// mysqli_close($con);
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
						// mysqli_close($con);
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
		// mysqli_close($con);
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
				// mysqli_close($con);
				include('db_connect.php');
				$Updateresult = mysqli_query($con, $sqlQry1);

			}
		}
		mysqli_free_result($result);
	}

	function Check_OutwardlrExist($con, $Outwardlr)
		{
			$Getting_olrid=0;
			$sqlQry= "select olrid from `outwardlr`";
			$sqlQry= $sqlQry." where olrid=$Outwardlr ";
			$sqlQry= $sqlQry." and Active=1";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
			// mysqli_close($con);
			include('db_connect.php');
			$result = mysqli_query($con, $sqlQry);
			if (mysqli_num_rows($result)!=0)
			{
				while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
				{
					$Getting_olrid=$row{0};
				}
			}
			mysqli_free_result($result);
			return $Getting_olrid;
		}

	function Check_ConsignorProductExist($Consignorid, $SingleProduct)
	{
		$Getting_ConsignorProductExist=0;
		$sqlQry= "select cpid from `consignorproduct_master`";
		$sqlQry= $sqlQry." where caid=$Consignorid ";
		$sqlQry= $sqlQry." and pmid=$SingleProduct";
//			echo ("Check sqlQry :- $sqlQry </br>");
//			die();
		// mysqli_close($con);
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
				// mysqli_close($con);
				include('db_connect.php');
				$resultproduct = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save consignor product)! Error: " . mysqli_error($con), E_USER_ERROR);
			}
		}

	}

	function Update_OutwardLRBill_Deactive($olrid)
	{
		$sqlQry= "select olbid from `outwardlrbill`";
		$sqlQry= $sqlQry." where olrid=$olrid ";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0){
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
				$db_olbid=$row{0};
				$ProcedureBIll = "Call Update_OutwardLRBill($db_olbid);";
//				echo("ProcedureBIll:- " . $ProcedureBIll . "</br>");
//				die();
				// mysqli_close($con);
				include('db_connect.php');
				$resultBill = mysqli_query($con, $ProcedureBIll) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
				mysqli_free_result($resultBill);
			}
		}
	}

	function Update_OutwardLR_RMStatus($olrid)
	{
		$Procedure = "";
		$Procedure = "Call Update_OutwardLR_RMStatus($olrid);";
//		echo("Procedure:- " . $Procedure . "</br>");
//		die();
		unset($con);
		include('db_connect.php');
		$result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
		mysqli_free_result($resultBill);
	}


	function Update_OutwardLRStatus($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $RMStatus)
	{
		$Procedure = "Call Save_OutwardLRStatus('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $RMStatus);";
//		echo("Procedure:- " . $Procedure . "</br>");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
		mysqli_free_result($resultBill);
	}

	function Update_OutwardLRBill_Return($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $acmid, $Return_Charge)
	{
		$ProcedureBIll = "Call Save_OutwardLRBill('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $acmid, $Return_Charge);";
//			echo("ProcedureBIll:- " . $ProcedureBIll . "</br>");
//			die();
		// mysqli_close($con);
		include('db_connect.php');
		$resultBill = mysqli_query($con, $ProcedureBIll) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
		mysqli_free_result($resultBill);
	}


	function Update_OutwardLRBill($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $LRID)
	{
		$sqlQry= "select acmid, Amount from `inwardcharge`";
		$sqlQry= $sqlQry." where LRID=$LRID ";
		$sqlQry= $sqlQry." and Active=1";
//		echo ("Check sqlQry :- $sqlQry </br>");
//		die();
		// mysqli_close($con);
		include('db_connect.php');
		$result = mysqli_query($con, $sqlQry);
		if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
			{
				$db_acmid=$row{0};
				$db_amount=$row{1};

				$ProcedureBIll = "Call Save_OutwardLRBill('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $db_acmid, $db_amount);";
//				echo("ProcedureBIll:- " . $ProcedureBIll . "</br>");
//				die();
				// mysqli_close($con);
				include('db_connect.php');
				$resultBill = mysqli_query($con, $ProcedureBIll) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
				mysqli_free_result($resultBill);
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
		// mysqli_close($con);
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
					// mysqli_close($con);
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
		// mysqli_close($con);
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
					// mysqli_close($con);
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
		// mysqli_close($con);
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
					// mysqli_close($con);
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
					// mysqli_close($con);
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
					// mysqli_close($con);
					include('db_connect.php');
					$Updateresult = mysqli_query($con, $sqlQry1);
				}
			}
		}
		mysqli_free_result($result);
	}