<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
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
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $BillID=sanitize($con, $_REQUEST["BillID"]);
    $deletereason=sanitize($con, $_REQUEST["deletereason"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("BillID:- ".$BillID."</br>");
//    echo ("deletereason:- ".$deletereason."</br>");
//    die();

    $tablename="bill";
    $searchColumn="bid";
    $searchColumn_Value=$BillID;
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
            Set_BillDeactive($con, $CurrentDate, $session_userid, $session_ip, $BillID, $deletereason);
        }
            /* Log Ends*/
                Log_End($con, $searchColumn_Value, $LogStart_Value);
            /* Log Ends*/

            ?>
                <script language="javascript">
                    ClearAllControls(0);
                </script>
            <?php

    }
    else{
        echo($error_msg);
        die();
    }
?>
