<!-- Theme JS files -->
<script type="text/javascript" src="assets/js/plugins/notifications/bootbox.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script type="text/javascript" src="assets/js/pages/components_modals.js"></script>
<!-- /theme JS files -->


<?php
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');

    if(!isset($_REQUEST["ConsignorID"])) {
        $UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
        $AccessingPage=basename(__FILE__); //"add_society.php";
        //			echo("UrlPage :- $UrlPage </br>");
        //			echo("AccessingPage :- $AccessingPage </br>");
        if(trim($UrlPage)==trim($AccessingPage)){
            header("Location: /login.php");
        }
    }
    $AddEdit=0;
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $ConsignorID=sanitize($con, $_REQUEST["ConsignorID"]);
    $ReceiptAmount=sanitize($con, $_REQUEST["ReceiptAmount"]);


//    echo ("ConsignorID:- ".$ConsignorID."</br>");
//    echo ("ReceiptAmount:- ".$ReceiptAmount."</br>");
//    die();

    $tablename="billreceipt";
    $searchColumn="brid";
    $searchColumn_Value=$AddEdit;
    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;

    if(trim($error_msg)=="") {

        /* Log Start*/
            $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
        /* Log Start*/

        if ($AddEdit==0) {
            $Procedure = "Call Save_Receipt('$CurrentDate', $ConsignorID, $ReceiptAmount);";
        }
//        echo ("Procedure:- ".$Procedure."</br>");
//        die();
        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $LastInsertedID = $row{0};
            /* Log Ends*/
                Log_End($con, $searchColumn_Value, $LogStart_Value);
            /* Log Ends*/
            ?>
                <script language="javascript">
                    ClearAllControls(0);
                </script>
            <?php

        }
        mysqli_free_result($result);
    }
    else{
        echo($error_msg);
    }
?>


