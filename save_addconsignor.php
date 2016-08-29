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
    $AddEdit1=$_REQUEST["AddEdit1"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $AddEdit=sanitize($con, $_REQUEST["AddEdit"]);
    $AddEdit1=sanitize($con, $_REQUEST["AddEdit1"]);
    $AddEdit2=sanitize($con, $_REQUEST["AddEdit2"]);
    $AddEdit3=sanitize($con, $_REQUEST["AddEdit3"]);
    $session_userid=sanitize($con, $_REQUEST["session_userid"]);
    $session_ip=sanitize($con, $_REQUEST["session_ip"]);
    $consignorname=sanitize($con, $_REQUEST["consignorname"]);
    $address=sanitize($con, $_REQUEST["address"]);
    $area=sanitize($con, $_REQUEST["area"]);
    $AreaID=Check_AreaID($con, $AddEdit1, $area);
    if($AreaID==0){
        $Procedure="";
        $Procedure = "Call Save_Area('$CurrentDate', $session_userid, '$session_ip', '$area');";
        mysqli_close($con);
        include('assets/inc/db_connect.php');
        $resultarea = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($resultarea) != 0) {
            $row = mysqli_fetch_array($resultarea, MYSQLI_NUM);
            $AreaID = $row{0};
        }
        mysqli_free_result($result);
        include('assets/inc/db_connect.php');
    }


    $pincode=sanitize($con, $_REQUEST["pincode"]);
    $city=sanitize($con, $_REQUEST["city"]);
    $panno=sanitize($con, $_REQUEST["panno"]);

    $contacttype1=1;
    $telephone1=sanitize($con, $_REQUEST["telephone1"]);

    $contacttype2=1;

    $telephone2=sanitize($con, $_REQUEST["telephone2"]);
    $telephone2==""?$telephone2=0:$telephone2=$telephone2;

    $contacttype3=1;

    $telephone3=sanitize($con, $_REQUEST["telephone3"]);
    $telephone3==""?$telephone3=0:$telephone3=$telephone3;

    $contacttype4=2;
    $email=sanitize($con, $_REQUEST["email"]);

    $contacttype5=3;
    $url=sanitize($con, $_REQUEST["url"]);
    $product=sanitize($con, $_REQUEST["selectedvalue"]);
    $product==""?$product=0:$product=$product;

    $remark=sanitize($con, $_REQUEST["remark"]);
    $servicetax=sanitize($con, $_REQUEST["servicetax"]);

//    echo ("AddEdit :- ".$AddEdit ."</br>");
//    echo ("AddEdit1 :- ".$AddEdit1 ."</br>");
//    echo ("AddEdit2 :- ".$AddEdit2 ."</br>");
//    echo ("AddEdit3 :- ".$AddEdit3 ."</br>");
//    echo ("session_userid :- ".$session_userid ."</br>");
//    echo ("session_ip :- ".$session_ip ."</br>");
//    echo ("consignorname :- ".$consignorname ."</br>");
//    echo ("address :- ".$address ."</br>");
//    echo ("area :- ".$area ."</br>");
//    echo ("pincode :- ".$pincode ."</br>");
//    echo ("city :- ".$city ."</br>");
//    echo ("contacttype1 :- ".$contacttype1 ."</br>");
//    echo ("telephone1 :- ".$telephone1 ."</br>");
//    echo ("contacttype2 :- ".$contacttype2 ."</br>");
//    echo ("telephone2 :- ".$telephone2 ."</br>");
//    echo ("contacttype3 :- ".$contacttype3 ."</br>");
//    echo ("telephone3 :- ".$telephone3 ."</br>");
//    echo ("email :- ".$email ."</br>");
//    echo ("url :- ".$url ."</br>");
//    echo ("product :- ".$product ."</br>");
//    echo ("remark :- ".$remark ."</br>");
//    echo ("servicetax :- ".$servicetax ."</br>");
//    die();


    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;

    $tablename="consignor_master";
    $searchColumn="cid";
    $searchColumn_Value=$AddEdit;

    /* Log Start*/
        $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
        unset($con);
        include('assets/inc/db_connect.php');
    /* Log Start*/

    $tablename="consignoraddress_master";
    $searchColumn="caid";
    $searchColumn_Value1=$AddEdit1;

    /* Log Start*/
        $LogStart_Value1=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value1);
        unset($con);
        include('assets/inc/db_connect.php');
    /* Log Start*/

    $tablename="consignorcontact_master";
    $searchColumn="ccid";
    $searchColumn_Value2=$AddEdit2;

    /* Log Start*/
        $LogStart_Value2=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value2);
        unset($con);
        include('assets/inc/db_connect.php');
    /* Log Start*/

    $tablename="consignorproduct_master";
    $searchColumn="cpid";
    $searchColumn_Value3=$AddEdit3;

    /* Log Start*/
    $LogStart_Value3=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value3);
    unset($con);
    include('assets/inc/db_connect.php');
    /* Log Start*/




if(trim($error_msg)=="") {

    if ($AddEdit==0) {
        $Procedure = "Call Save_Consignor('$CurrentDate', $session_userid, '$session_ip', '$consignorname', '$panno', '$address', '$area', $pincode, '$city', $contacttype1, '$telephone1', $contacttype2, '$telephone2', $contacttype3, '$telephone3', $contacttype4, '$email', $contacttype5, '$url', '$remark', $servicetax);";
    }
    else{

         
        $IDTableName="consignor_master";
        $IDColumnName="cid";
        $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
        if($AddEdit>0 and $AddEdit1>0 and $AddEdit2>0) {
            $Procedure = "Call Update_Consignor($AddEdit, $AddEdit1, '$CurrentDate', $session_userid, '$session_ip', '$consignorname', '$panno', '$address', $AreaID, $pincode, '$city', '$remark', $servicetax);";
            
        }
        else{
            echo("Consignee ID is not getting. Please contact system administrator....");
        }
    }
//    echo ("Procedure:- ".$Procedure."</br>");
//    die();
    unset($con);
    include('assets/inc/db_connect.php');

    $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
    if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $LastInsertedID = $row{0};
        if($LastInsertedID>0){
            if ($AddEdit==0) {
                Add_ConsignorProduct($con, '$CurrentDate', $session_userid, '$session_ip', $LastInsertedID, $product);
            }
            else{
                Update_ConsignorTelephone($con, $AddEdit1, $telephone1, $telephone2, $telephone3);
                Update_ConsignorEmail($con, $AddEdit1, $email);
                Update_ConsignorUrl($con, $AddEdit1, $url);
                Update_ConsignorProduct($con, $CurrentDate, $session_userid, $session_ip, $AddEdit1, $product);
            }

//          echo("Saved Successfully & LastInsertedID :- $LastInsertedID </br>");

            /* Log Ends*/
            Log_End($con, $searchColumn_Value, $LogStart_Value);
            unset($con);
            /* Log Ends*/

            /* Log Ends*/
            include('assets/inc/db_connect.php');
            Log_End($con, $searchColumn_Value1, $LogStart_Value1);
            unset($con);
            /* Log Ends*/

            /* Log Ends*/
            include('assets/inc/db_connect.php');
            Log_End($con, $searchColumn_Value2, $LogStart_Value2);
            unset($con);
            /* Log Ends*/

            /* Log Ends*/
            include('assets/inc/db_connect.php');
            Log_End($con, $searchColumn_Value3, $LogStart_Value3);
            unset($con);
            /* Log Ends*/

            ?>
                <script language="javascript">
                    //    ClearAllControls(0);
                    //    show_newlyaddedlist('add_consignor_2.php', 'div_searchconsignor');
                    window.location.reload(true);
                </script>
            <?php
        }
    }
    mysqli_free_result($result);
}
else{
    echo($error_msg);
}
?>
