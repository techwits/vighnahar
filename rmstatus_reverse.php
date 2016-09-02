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
    $olrid=sanitize($con, $_REQUEST["olrid"]);


//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("olrid:- ".$olrid."</br>");
//    die();

    $tablename="outwardlr";
    $searchColumn="olrid";
    $searchColumn_Value=$olrid;
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

                    Update_OutwardLR_RMStatus($olrid);
                    Update_OutwardLRBill_Deactive($olrid);

                    /* Log Ends*/
                        Log_End($con, $searchColumn_Value, $LogStart_Value);
                        unset($con);
                    /* Log Ends*/


                ?>
                    <script language="javascript">
                        new PNotify({
                            title: 'Success notice',
                            text: 'Check me out! I\'m a notice.',
                            icon: 'icon-checkmark3',
                            type: 'success'
                        });

                        setTimeout(function(){
                            window.location.reload(1);
                        }, 1000);
                    </script>
                <?php
        }
    }
    else{
        echo($error_msg);
    }
?>
