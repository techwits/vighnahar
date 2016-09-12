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
    $AddEdit=$_REQUEST["AddEdit"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $deliverystatus=sanitize($con, $_REQUEST["deliverystatus"]);
    if($AddEdit==0){
        $DeliveryStatusExist=0;
        $DeliveryStatusExist=Check_DeliveryStatusExist($con, $deliverystatus);
    //        echo ("productname:- ".$productname."</br>");
    //        die();
        if($DeliveryStatusExist>0){
            $error_msg="Delivery Status already exist.";
        }
    }
//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("deliverystatus:- ".$deliverystatus."</br>");
//    die();

    $tablename="deliverystatus_master";
    $searchColumn="dsid";
    $searchColumn_Value=$AddEdit;
    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;

    if(trim($error_msg)=="") {

        /* Log Start*/
            $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
            unset($con);
        /* Log Start*/

        if ($AddEdit==0) {
            $Procedure = "Call Save_DeliveryStatus('$CurrentDate', $session_userid, '$session_ip', '$deliverystatus');";
        }
        else{
            $IDTableName="deliverystatus_master";
            $IDColumnName="dsid";
            $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_DeliveryStatus($IDExist, '$CurrentDate', $session_userid, '$session_ip', '$deliverystatus');";
            }
            else{
                echo("Delivery Status ID is not getting. Please contact system administrator....");
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
        }
        mysqli_free_result($result);

        /* Log Ends*/
            Log_End($con, $searchColumn_Value, $LogStart_Value);
            unset($con);
        /* Log Ends*/
        ?>
            <script language="javascript">
                ClearAllControls(0);
            </script>
        <?php

    }
    else{
        ?>
            <script type="text/javascript">
                show_error('<?php echo $error_msg; ?>');
            </script>
        <?php
    }

?>

