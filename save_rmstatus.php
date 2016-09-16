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
    $returncount=sanitize($con, $_REQUEST["returncount"]);

    $LRRate=sanitize($con, $_REQUEST["LRRate"]);
    $LRQuantityCount=sanitize($con, $_REQUEST["LRQuantityCount"]);

    $ChargeName="Goods Return";
    $acmid=Get_acmid($con, $ChargeName);
    if($acmid==0){
        $error_msg=" Return Goods Master ID is blank. Please check.......";
    }

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("RMID:- ".$RMID."</br>");
//    echo ("LRID:- ".$LRID."</br>");
//    echo ("OutwardLRID:- ".$OutwardLRID."</br>");
//    echo ("DeliveredID:- ".$DeliveredID."</br>");
//    echo ("UnDeliveredID:- ".$UnDeliveredID."</br>");
//    echo ("returncount:- ".$returncount."</br>");
//
//    echo ("LRRate:- ".$LRRate."</br>");
//    echo ("LRQuantityCount:- ".$LRQuantityCount."</br>");
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


            Update_OutwardLRBill($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $LRID);
            if ($DeliveredID == 2) {
                $RMStatus=$DeliveredID;
                Update_OutwardLRStatus($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $RMStatus);
            }
            elseif ($DeliveredID == 4) {
                $RMStatus=$DeliveredID;
                Update_OutwardLRStatus($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $RMStatus);
            }
            elseif ($DeliveredID == 3) {

                if($UnDeliveredID==1){
                    $Return_Charge=$LRRate * $LRQuantityCount;
                }
                else{
                    $Return_Charge=$LRRate * $returncount;
                }

                Update_OutwardLRBill_Return($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $acmid, $Return_Charge);
                $RMStatus=$DeliveredID;
                Update_OutwardLRStatus($con, $CurrentDate, $session_userid, $session_ip, $OutwardLRID, $RMStatus);
//                $LastInsertedID=0;
//                $dsid=5;
//                $urid=0;
//                $Procedure ="";
//                $Procedure = "Call Update_Outward_CarryForward('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $dsid, $urid);";
////                echo ("Procedure:- ".$Procedure."</br>");
////                die();
//                unset($con);
//                include('assets/inc/db_connect.php');
//                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
//                if (mysqli_num_rows($result) != 0) {
//                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
//                    $LastInsertedID = $row{0};
//                    /* Log Ends*/
//                    Log_End($con, $searchColumn_Value, $LogStart_Value);
//                    unset($con);
//                    //              mysqli_close($con);
//                    /* Log Ends*/
//                }
//
//
//                $UndlvrID=0;
//                $Procedure ="";
//                $Procedure = "Call Update_Outward_UnDelivery('$CurrentDate', $session_userid, '$session_ip', $OutwardLRID, $RMID, $LRID, $DeliveredID, $UnDeliveredID);";
////                echo ("Procedure:- ".$Procedure."</br>");
////                die();
//                unset($con);
//                include('assets/inc/db_connect.php');
//                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
//                if (mysqli_num_rows($result) != 0) {
//                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
//                    $UndlvrID = $row{0};
//                    /* Log Ends*/
//                        Log_End($con, $searchColumn_Value, $LogStart_Value);
//                        unset($con);
//                    /* Log Ends*/
//                }

            }

            if($DeliveredID==3){
                    ?>
                        <a href="#" onclick="rmstatusreverse('<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $divname; ?>', '<?php echo $OutwardLRID; ?>');"><span class="label label-danger">Undelivered</span></a>
                    <?php
                }
            elseif($DeliveredID==2){
                    ?>
                        <a href="#" onclick="rmstatusreverse('<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $divname; ?>', '<?php echo $OutwardLRID; ?>');"><span class="label label-success">Delivered</span></a>
                    <?php
                }
            elseif($DeliveredID==4){
                ?>
                <a href="#" onclick="rmstatusreverse('<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $divname; ?>', '<?php echo $OutwardLRID; ?>');"><span class="label label-warning">Wrong LR Entry</span></a>
                <?php
            }
        }
    }
    else{
        echo($error_msg);
    }
?>
