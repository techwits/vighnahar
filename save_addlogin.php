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

    $username=sanitize($con, $_REQUEST["username"]);
    $userid=sanitize($con, $_REQUEST["userid"]);
    $pwd=sanitize($con, $_REQUEST["pwd"]);
    $designation=sanitize($con, $_REQUEST["designation"]);
    $DesignationPrivilage=Get_DesignationPrivilage($con, $designation);


    if($AddEdit==0) {
        $User_ID = Check_UserID(con, $userid);
        if ($User_ID > 0) {
            $error_msg = "User Login ID is already Exist. PLease check.....";
        }

        if (strlen($pwd) != 128) {
            // The hashed pwd should be 128 characters long.
            // If it's not, something really odd has happened
            $error_msg .= '<p class="error">Invalid Password.</p>';
        } else {
            $pwd = password_hash($pwd, PASSWORD_BCRYPT);
        }

    }


//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("username:- ".$username."</br>");
//    echo ("userid:- ".$userid."</br>");
//    echo ("pwd:- ".$pwd."</br>");
//    echo ("designation:- ".$designation."</br>");
//    echo ("DesignationPrivilage:- ".$DesignationPrivilage."</br>");
//    die();



    $tablename="login_master";
    $searchColumn="loginid";
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
            $Procedure = "Call Save_Login('$CurrentDate', '$username', '$userid', '$pwd', '$DesignationPrivilage');";
        }
        else{
            $IDExist=Check_LoginIDExist($con, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_Login($IDExist, '$CurrentDate', $session_userid, '$session_ip', '$username', '$userid');";
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
//          echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");

            /* Log Ends*/
                Log_End($con, $searchColumn_Value, $LogStart_Value);
                unset($con);
//            mysqli_close($con);
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
