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

    $vehiclename=sanitize($con, $_REQUEST["vehiclename"]);
    $vehiclenumber=sanitize($con, $_REQUEST["vehiclenumber"]);
    $vehiclercbooknumber=sanitize($con, $_REQUEST["vehiclercbooknumber"]);
    $vehicleownershipname=sanitize($con, $_REQUEST["vehicleownershipname"]);

    $registrationyear=sanitize($con, $_REQUEST["registrationyear"]);
    $permitnumber=sanitize($con, $_REQUEST["permitnumber"]);
    $vehiclepermitexpiredate=sanitize($con, $_REQUEST["vehiclepermitexpiredate"]);
    $insurancenumber=sanitize($con, $_REQUEST["insurancenumber"]);
    $insuranceexpiredate=sanitize($con, $_REQUEST["insuranceexpiredate"]);


    $oldDate = $insuranceexpiredate;
    $arr = explode('/', $oldDate);
    $newDate = $arr[2].'-'.$arr[1].'-'.$arr[0].'-'.$arr[0];
    $newDate_Valid=validateDate($newDate);

    echo ("AddEdit:- ".$AddEdit."</br>");
    echo ("session_userid:- ".$session_userid."</br>");
    echo ("session_ip:- ".$session_ip."</br>");
    echo ("vehiclename:- ".$vehiclename."</br>");
    echo ("vehiclenumber:- ".$vehiclenumber."</br>");
    echo ("vehiclercbooknumber:- ".$vehiclercbooknumber."</br>");
    echo ("vehicleownershipname:- ".$vehicleownershipname."</br>");
    echo ("registrationyear:- ".$registrationyear."</br>");
    echo ("permitnumber:- ".$permitnumber."</br>");
    echo ("vehiclepermitexpiredate:- ".$vehiclepermitexpiredate."</br>");
    echo ("insurancenumber:- ".$insurancenumber."</br>");
    echo ("insuranceexpiredate:- ".$insuranceexpiredate."</br>");
    echo ("newDate:- ".$newDate."</br>");
    echo ("newDate_Valid:- ".$newDate_Valid."</br>");
    die();

    $tablename="vehicle_master";
    $searchColumn="vmid";
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
            $Procedure = "Call Save_Vehicle('$CurrentDate', $session_userid, '$session_ip', $vehicleownershipname, '$vehiclename', '$vehiclenumber', '$vehiclercbooknumber');";
        }
        else{
            $IDTableName="vehicle_master";
            $IDColumnName="vmid";
            $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_Vehicle($AddEdit, '$CurrentDate', $session_userid, '$session_ip', $vehicleownershipname, '$vehiclename', '$vehiclenumber', '$vehiclercbooknumber');";
            }
            else{
                echo("Vehicle ID is not getting. Please contact system administrator....");
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
    show_newlyaddedlist('add_vehicleownership_2.php', 'div_searchvehicleownership');
</script>


