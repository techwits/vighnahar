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


    $financialyear=sanitize($con, $_REQUEST["financialyear"]);
    $rmdate=sanitize($con, $_REQUEST["rmdate"]);
    $rmdate = implode("-", array_reverse(explode("/", $rmdate)));


    $vehicleid=sanitize($con, $_REQUEST["vehicleid"]);
    $transporterid=sanitize($con, $_REQUEST["transporterid"]);
    $SelectedLR=sanitize($con, $_REQUEST["SelectedLR"]);

//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//
//    echo ("financialyear:- ".$financialyear."</br>");
//    echo ("rmdate:- ".$rmdate."</br>");
//    echo ("vehicleid:- ".$vehicleid."</br>");
//    echo ("transporterid:- ".$transporterid."</br>");
//    echo ("SelectedLR:- ".$SelectedLR."</br>");
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
        unset($con);
    /* Log Start*/


    if(trim($error_msg)=="") {

//        $financialyear=sanitize($con, $_REQUEST["financialyear"]);
//        $rmdate=sanitize($con, $_REQUEST["rmdate"]);
//        $vehicleid=sanitize($con, $_REQUEST["vehicleid"]);
//        $transporterid=sanitize($con, $_REQUEST["transporterid"]);
//        $SelectedLR=sanitize($con, $_REQUEST["SelectedLR"]);
//

        if ($AddEdit==0) {
            $Procedure = "Call Save_RoadMemo('$CurrentDate', $session_userid, '$session_ip', '$rmdate', $financialyear, $vehicleid, $transporterid);";
        }
        else{
            $IDExist=Check_MenuIDExist($con, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_RoadMemo($IDExist, '$CurrentDate', $session_userid, '$session_ip', '$rmdate', $financialyear, $vehicleid, $transporterid);";
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

            if ($AddEdit==0) {
//                $SelectedLR
                    $Split_SelectedLR = explode(",", $SelectedLR);
                    $Split_SelectedLR=array_unique($Split_SelectedLR);
                    foreach ($Split_SelectedLR as $SingleSelectedLR)
                    {
//                        echo("SingleSelectedLR :- $SingleSelectedLR </br>");
                        $Proc = "Call Save_RoadMemoLR('$CurrentDate', $session_userid, '$session_ip', $LastInsertedID, $SingleSelectedLR);";
                        unset($con);
                        include('assets/inc/db_connect.php');
                        $rslr = mysqli_query($con, $Proc) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                    }
            }
            else{
                    Set_OutwardDeactive($con, $CurrentDate, $session_userid, $session_ip, $IDExist);
//                    echo("Deactivated....");
//                    die();
                    $Split_SelectedLR = explode(",", $SelectedLR);
                    $Split_SelectedLR=array_unique($Split_SelectedLR);
                    foreach ($Split_SelectedLR as $SingleSelectedLR)
                    {
    //                  echo("SingleSelectedLR :- $SingleSelectedLR </br>");
                        $OutwardlrExist=Check_OutwardlrExist($con, $SingleSelectedLR);
                        if($OutwardlrExist==0) {
                            $Proc = "Call Save_RoadMemoLR('$CurrentDate', $session_userid, '$session_ip', $IDExist, $SingleSelectedLR);";
                            unset($con);
                            include('assets/inc/db_connect.php');
                            $rslr = mysqli_query($con, $Proc) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                        }
                    }

            }

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


