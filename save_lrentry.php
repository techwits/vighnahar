<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/notifications/bootbox.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="assets/js/pages/components_modals.js"></script>
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
    $CurrentDate=date('Y-m-d h:i:s');
    $AddEdit=$_REQUEST["AddEdit"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $AddEdit=$_REQUEST["AddEdit"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];
    $financialyear=$_REQUEST["financialyear"];
    $lrdate=$_REQUEST["ToDate"];
    $lrdate = implode("-", array_reverse(explode("/", $lrdate)));
    $invoicenumber=$_REQUEST["invoicenumber"];
    $vehicleid=$_REQUEST["vehicleid"];
    $consignorid=$_REQUEST["consignorid"];
    $consigneeid=$_REQUEST["consigneeid"];
    $productid=$_REQUEST["productid"];
    $packagetype=$_REQUEST["packagetype"];
    $productrate=$_REQUEST["productrate"];
    $qauntity=$_REQUEST["qauntity"];
    $paidlramount=$_REQUEST["paidlramount"];
    $shippingcharge=$_REQUEST["shippingcharge"];
    $roadexpense=$_REQUEST["roadexpense"];
    $biltycharge=$_REQUEST["biltycharge"];
    $servicetax=$_REQUEST["servicetax"];
    $additionalchargesentry=$_REQUEST["additionalchargesentry"];

    $ProductCharge=0;
    $ProductCharge=$productrate*$Quantity;
	if ($ShippingCharges < $MinimumRate){
		$ShippingCharges=$MinimumRate;
		}

//    echo("AddEdit :- $AddEdit </br>");
//    echo("session_userid :- $session_userid </br>");
//    echo("session_ip :- $session_ip </br>");
//    echo("financialyear :- $financialyear </br>");
//    echo("lrdate :- $lrdate </br>");
//    echo("invoicenumber :- $invoicenumber </br>");
//    echo("vehicleid :- $vehicleid </br>");
//    echo("consignorid :- $consignorid </br>");
//    echo("consigneeid :- $consigneeid </br>");
//    echo("productid :- $productid </br>");
//    echo("packagetype :- $packagetype </br>");
//    echo("productrate :- $productrate </br>");
//    echo("qauntity :- $qauntity </br>");
//    echo("paidlramount :- $paidlramount </br>");
//    echo("shippingcharge :- $shippingcharge </br>");
//    echo("biltycharge :- $biltycharge </br>");
//    echo("servicetax :- $servicetax </br>");
//    echo("additionalchargesentry :- $additionalchargesentry </br>");
//    die();

    $tablename="inward";
    $searchColumn="Iid";
    $searchColumn_Value=$AddEdit;
    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;

    /* Log Start*/
        $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
//        echo("LogStart_Value :- $LogStart_Value </br>");
//        die();
        unset($con);
//        mysqli_close($con);
        include('assets/inc/db_connect.php');
    /* Log Start*/

    if(trim($error_msg)=="") {

        if ($AddEdit==0)
        {
            $Procedure = "Call Save_Inward('$CurrentDate', $session_userid, '$session_ip', $financialyear, '$lrdate', '$invoicenumber', $vehicleid, $consignorid, $consigneeid, $productid, '$packagetype', $productrate, $qauntity, $paidlramount, $shippingcharge, $roadexpense, $biltycharge, $servicetax);";
        }
        else{
            $IDTableName="inward";
            $IDColumnName="LRID";
            $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
//            echo("IDExist :- $IDExist </br>");
//            die();
            if($IDExist>0) {
                $Procedure = "Call Update_Inward('$CurrentDate', $session_userid, '$session_ip', $AddEdit, $financialyear, '$lrdate', '$invoicenumber', $vehicleid, $consignorid, $consigneeid, $productid, '$packagetype', $productrate, $qauntity, $paidlramount, $shippingcharge, $roadexpense, $biltycharge, $servicetax);";
            }
            else{
                echo("Transporter ID is not getting. Please contact system administrator....");
            }
        }
//        echo ("Procedure:- ".$Procedure."</br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');

        $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $LastInsertedID = $row{0};
            if ($AddEdit>0) {
                $RMStatus = Get_RMStatusOnLRID($con, $AddEdit);
//                  echo("AddEdit :- $AddEdit </br>");
//                  echo("RMStatus :- $RMStatus </br>");
//                  die();
                    if($RMStatus==4){
                        $olrid=Get_OLRIDOnLRID($con, $AddEdit);
//                        echo("olrid :- $olrid </br>");
//                        die();
                        Set_RM_Deactive($con, $CurrentDate, $session_userid, $session_ip, $olrid); //set RMStatus=0
                        Clone_RMlr($con, $CurrentDate, $session_userid, $session_ip, $olrid); //Clone RM's LR
                    }
            }

//            echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");
//            echo("additionalchargesentry :- $additionalchargesentry </br>");

            $Split_additionalchargesentry = explode("||", $additionalchargesentry);
            foreach ($Split_additionalchargesentry as $SingleAdditionalCharge)
            {
                if(strlen(trim($SingleAdditionalCharge))>0){
                    $Split_SingleAdditionalCharge = explode("~", $SingleAdditionalCharge);
//                    $Split_SingleAdditionalCharge[0];
//                    $Split_SingleAdditionalCharge[1];

                    $sqlQry="";
                    $sqlQry= "insert into `inwardcharge`(CreationDate, Creator, ip, LRID, acmid, Amount)";
                    $sqlQry.= " values ('$CurrentDate', $session_userid, '$session_ip', $LastInsertedID, $Split_SingleAdditionalCharge[0], $Split_SingleAdditionalCharge[1])";
//        			echo ("Check sqlQry :- $sqlQry </br>");
//        			die();
                    unset($con);
                    include('assets/inc/db_connect.php');
                    $rs = mysqli_query($con, $sqlQry);
                }
            }
        }

        /* Log Ends*/
            Log_End($con, $searchColumn_Value, $LogStart_Value);
            unset($con);
//            mysqli_close($con);
        /* Log Ends*/

        ?>

            <script language="javascript">
//                    printlr(<?php //echo $LastInsertedID; ?>//);
//                PrintDiv();
                ClearAllControls(0);
            </script>
        <?php

    }
    else{
        echo($error_msg);
    }
?>

