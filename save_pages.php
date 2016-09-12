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
    $CurrentDate = date('Y-m-d h:i:s');
    $AddEdit=$_REQUEST["AddEdit"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $menuname=sanitize($con, $_REQUEST["menuname"]);
    $pagedescription=sanitize($con, $_REQUEST["pagedescription"]);

//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("menuname:- ".$menuname."</br>");
//    echo ("pagedescription:- ".$pagedescription."</br>");
//    die();

    $tablename="1menusub";
    $searchColumn="menusub_id";
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

        if ($AddEdit==0) {
            $Procedure = "Call Save_Menu('$CurrentDate', $session_userid, '$session_ip', '$menuname', '$pagedescription');";
        }
        else{
            $IDExist=Check_MenuIDExist($con, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_Menu($IDExist, '$CurrentDate', $session_userid, '$session_ip', '$menuname', '$pagedescription');";
            }
            else{
                echo("Menu ID is not getting. Please contact system administrator....");
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
//        echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");
//        die();


        /* Log Ends*/
            Log_End($con, $searchColumn_Value, $LogStart_Value);
            unset($con);
//            mysqli_close($con);
        /* Log Ends*/

    }
    else{
        echo($error_msg);
    }

?>

<script language="javascript">
    ClearAllControls(0);
    show_newlyaddedlist('add_pages_2.php', 'div_searchmenu');
</script>


