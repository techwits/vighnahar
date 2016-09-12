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

    $pagename=sanitize($con, $_REQUEST["selectedvalue"]);
    $username=sanitize($con, $_REQUEST["username"]);

//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("pagename:- ".$pagename."</br>");
//    echo ("username:- ".$username."</br>");
//    die();

    $tablename="pageaccess_member";
    $searchColumn="id";
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
            Set_PageAccessDeactive($con, $CurrentDate, $session_userid, $session_ip, $username);
//            echo("Deactivated.....");
//            die();
            $Split_PageName = explode(",", $pagename);
            foreach ($Split_PageName as $SinglePage){
                $PageAccess=0;
                $PageAccess=Check_PageAccess($con, $SinglePage, $username);
//                echo("PageAccess :- $PageAccess </br>");
//                die();

                // ********************** Active - Deactive Pages **********************
                        if($PageAccess==0) {
                            $Procedure = "Call Save_PageAccess('$CurrentDate', $session_userid, '$session_ip', $SinglePage, $username);";
        //                    echo ("Procedure:- ".$Procedure."</br>");
        //                    die();
                            unset($con);
                            include('assets/inc/db_connect.php');

                            $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                            if (mysqli_num_rows($result) != 0) {
                                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                                $LastInsertedID = $row{0};
                            }
                            mysqli_free_result($result);
        //                  echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");

                        }
                        else{
                            Set_PageAccessActive($con, $CurrentDate, $session_userid, $session_ip, $username, $SinglePage);
                        }
                // ********************** Active - Deactive Pages **********************


                /* Log Ends*/
                    Log_End($con, $searchColumn_Value, $LogStart_Value);
                    unset($con);
//                        mysqli_close($con);
                /* Log Ends*/
            }
            ?>
                <script language="javascript">
                    ClearAllControls(0);
                </script>
            <?php
        }
        else{
            $IDExist=Check_PageAccessIDExist($con, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_PageAccess($IDExist, '$CurrentDate', $session_userid, '$session_ip', $pagename, $username);";

//                echo ("Procedure:- ".$Procedure."</br>");
//                die();
                unset($con);
                include('assets/inc/db_connect.php');

                $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                if (mysqli_num_rows($result) != 0) {
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $LastInsertedID = $row{0};
                }
                mysqli_free_result($result);
//              echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");


                /* Log Ends*/
                    Log_End($con, $searchColumn_Value, $LogStart_Value);
                    unset($con);
//                    mysqli_close($con);
                /* Log Ends*/
                ?>
                    <script language="javascript">
                        ClearAllControls(0);
                    </script>
                <?php

            }
            else{
                echo("Page Access ID is not getting. Please contact system administrator....");
            }
        }
    }
    else{
        echo($error_msg);
    }
?>


