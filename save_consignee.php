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
    $AddEdit2=$_REQUEST["AddEdit2"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $consignoraddressid=sanitize($con, $_REQUEST["consignoraddressid"]);
    $companyname=sanitize($con, $_REQUEST["companyname"]);
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
    $telephone=sanitize($con, $_REQUEST["telephone"]);
    $email=sanitize($con, $_REQUEST["email"]);
    $url=sanitize($con, $_REQUEST["url"]);

//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("AddEdit1:- ".$AddEdit1."</br>");
//    echo ("AddEdit2:- ".$AddEdit2."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("consignoraddressid:- ".$consignoraddressid."</br>");
//    echo ("companyname:- ".$companyname."</br>");
//    echo ("address:- ".$address."</br>");
//    echo ("area :- ".$area."</br>");
//    echo ("pincode:- ".$pincode."</br>");
//    echo ("city:- ".$city."</br>");
//    echo ("telephone:- ".$telephone."</br>");
//    echo ("email:- ".$email."</br>");
//    echo ("url:- ".$url."</br>");
//    die();


    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;


    if(trim($error_msg)=="") {

        if ($AddEdit==0) {

            $tablename="consignee_master";
            $searchColumn="cnid";
            $searchColumn_Value=$AddEdit;

            /* Log Start*/
                $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
                unset($con);
                include('assets/inc/db_connect.php');
            /* Log Start*/

            $tablename="consigneeaddress_master";
            $searchColumn="cnaid";
            $searchColumn_Value1=$AddEdit1;

            /* Log Start*/
                $LogStart_Value1=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value1);
                unset($con);
                include('assets/inc/db_connect.php');
            /* Log Start*/

            $Procedure = "Call Save_Consignee('$CurrentDate', $session_userid, '$session_ip', $consignoraddressid, '$companyname', '$address', $AreaID, $pincode, '$city', '$telephone', '$email', '$url');";
        }
        else{

//            $IDExist=Check_ConsigneeIDExist($con, $AddEdit);
            $IDTableName="consignee_master";
            $IDColumnName="cnid";
            $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
//            echo ("IDExist:- ".$IDExist."</br>");
            //die();
            $IDTableName="consignor_master";
            $IDColumnName="cid";
            $IDExist1=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit1);
//            echo ("IDExist1:- ".$IDExist1."</br>");
//            die();

            $IDTableName="area_master";
            $IDColumnName="amid";
            $IDExist2=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit2);
//            echo ("IDExist2:- ".$IDExist2."</br>");
//            die();

            if($IDExist>0 and $IDExist1>0 and $IDExist2>0) {
                $Procedure = "Call Update_Consignee($IDExist, $IDExist1, $IDExist2, '$CurrentDate', $session_userid, '$session_ip', $consignoraddressid, '$companyname', '$address', $pincode, '$city', '$telephone', '$email', '$url');";
            }
            else{
                echo("Consignee ID is not getting. Please contact system administrator....");
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

            /* Log Ends*/
                Log_End($con, $searchColumn_Value, $LogStart_Value);
                unset($con);
            /* Log Ends*/

            /* Log Ends*/
                include('assets/inc/db_connect.php');
                Log_End($con, $searchColumn_Value1, $LogStart_Value1);
                unset($con);
            /* Log Ends*/

            ?>
                <script language="javascript">
                    var removefirst_selectedoption=<?php echo  $AddEdit;?>;
                        if (removefirst_selectedoption!=0) {
                            $("#consignoraddressid option:selected").remove();
                        }
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
