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

    $AddEdit=0;
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $divname=sanitize($con, $_REQUEST["divname"]);
    $RMID=sanitize($con, $_REQUEST["RMID"]);
    $LRID=sanitize($con, $_REQUEST["LRID"]);
    $OutwardLRID=Get_OutwardLRID($con, $RMID, $LRID);
    if($OutwardLRID==0){
        $error_msg="Road Memo ID is not getting. Please check.....";
    }
    $DeliveredID=sanitize($con, $_REQUEST["DeliveredID"]);
    $UnDeliveredID=sanitize($con, $_REQUEST["UnDeliveredID"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("RMID:- ".$RMID."</br>");
//    echo ("LRID:- ".$LRID."</br>");
//    echo ("OutwardLRID:- ".$OutwardLRID."</br>");
//    echo ("DeliveredID:- ".$DeliveredID."</br>");
//    echo ("UnDeliveredID:- ".$UnDeliveredID."</br>");
//    die();

    $tablename="outward";
    $searchColumn="oid";
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
        if ($AddEdit == 0) {

            if ($DeliveredID == 2) {
                $DlvrID=0;
                $Procedure = "Call Update_Outward_Delivery('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $DeliveredID, $UnDeliveredID);";
//                echo("Procedure:- " . $Procedure . "</br>");
//                die();
                unset($con);
                include('assets/inc/db_connect.php');

                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                if (mysqli_num_rows($result) != 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $DlvrID = $row{0};
                    //          echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");

                    /* Log Ends*/
                    Log_End($con, $searchColumn_Value, $LogStart_Value);
                    unset($con);
                    //              mysqli_close($con);
                    /* Log Ends*/
                }
            }
            elseif ($DeliveredID == 3) {

                $LastInsertedID=0;
                $dsid=5;
                $urid=0;
                $Procedure ="";
                $Procedure = "Call Update_Outward_CarryForward('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $dsid, $urid);";
//                echo ("Procedure:- ".$Procedure."</br>");
//                die();
                unset($con);
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                if (mysqli_num_rows($result) != 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $LastInsertedID = $row{0};
                    /* Log Ends*/
                    Log_End($con, $searchColumn_Value, $LogStart_Value);
                    unset($con);
                    //              mysqli_close($con);
                    /* Log Ends*/
                }


                $UndlvrID=0;
                $Procedure ="";
                $Procedure = "Call Update_Outward_UnDelivery('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $RMID, $LRID, $DeliveredID, $UnDeliveredID);";
//                echo ("Procedure:- ".$Procedure."</br>");
//                die();
                unset($con);
                include('assets/inc/db_connect.php');
                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                if (mysqli_num_rows($result) != 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $UndlvrID = $row{0};
                    /* Log Ends*/
                        Log_End($con, $searchColumn_Value, $LogStart_Value);
                        unset($con);
                    /* Log Ends*/
                }

            }

            if($UnDeliveredID>0){
                    ?>
                        <a href="#" onclick="rmstatusreverse('<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $divname; ?>', '<?php echo $UndlvrID; ?>', 2);"><span class="label label-danger">Undelivered</span></a>
                    <?php
                }
                else{
                    ?>
                        <a href="#" onclick="rmstatusreverse('<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $divname; ?>', '<?php echo $OutwardLRID; ?>', 1);"><span class="label label-success">Delivered</span></a>
                    <?php
                }
        }
        mysqli_free_result($result);
    }
    else{
        echo($error_msg);
    }
?>
