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

    $AddEdit=0;
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];
    $olrid_List=$_REQUEST["olrid_List"];
    $financialyear=$_REQUEST["financialyear"];
    $rmdate=$_REQUEST["rmdate"];
    $rmdate = implode("-", array_reverse(explode("/", $rmdate)));
    $consignoraddressid=$_REQUEST["consignoraddressid"];
    $lrlist=$_REQUEST["lrlist"];
    $total=$_REQUEST["total"];
    $discount=$_REQUEST["discount"];
    $servicetax=$_REQUEST["servicetax"];
    $billtotal=$_REQUEST["billtotal"];


//    echo ("session_userid :- ".$session_userid ."</br>");
//    echo ("session_ip :- ".$session_ip ."</br>");
//    echo ("olrid_List :- ".$olrid_List ."</br>");
//    echo ("financialyear :- ".$financialyear ."</br>");
//    echo ("rmdate :- ".$rmdate ."</br>");
//    echo ("consignoraddressid :- ".$consignoraddressid ."</br>");
//    echo ("lrlist :- ".$lrlist ."</br>");
//    echo ("total :- ".$total ."</br>");
//    echo ("discount :- ".$discount ."</br>");
//    echo ("servicetax :- ".$servicetax ."</br>");
//    echo ("billtotal :- ".$billtotal ."</br>");
//    die();


    $tablename="bill";
    $searchColumn="bid";
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

            // $olrid_List=$_REQUEST["olrid_List"];
            $Procedure = "Call Save_Bill('$CurrentDate', $session_userid, '$session_ip', $financialyear, '$rmdate', $consignoraddressid, $total, $discount, $servicetax, $billtotal);";
        }
//        echo ("Procedure:- ".$Procedure."</br>");
//        die();
        unset($con);
        include('assets/inc/db_connect.php');

        $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $LastInsertedID = $row{0};

            if ($LastInsertedID>0) {
//                $SelectedLR
                    $Split_olrid_List = explode(",", $olrid_List);
                    $Split_SelectedOLR=array_unique($Split_olrid_List);
                    foreach ($Split_SelectedOLR as $SingleSelectedOLR)
                    {
//                        echo("SingleSelectedLR :- $SingleSelectedLR </br>");
                        $Proc = "Call Save_BillLR('$CurrentDate', $session_userid, '$session_ip', $LastInsertedID, $SingleSelectedOLR);";
                        unset($con);
                        include('assets/inc/db_connect.php');
                        $rslr = mysqli_query($con, $Proc) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                    }
            }
            else{
                echo("Bill is not saved. Please check....");
                die();
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


