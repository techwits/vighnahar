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
    $AddEdit1=$_REQUEST["AddEdit1"];
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

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
    $person=sanitize($con, $_REQUEST["person"]);
    $panno=sanitize($con, $_REQUEST["panno"]);
    $telephone=sanitize($con, $_REQUEST["telephone"]);
    $email=sanitize($con, $_REQUEST["email"]);
    $url=sanitize($con, $_REQUEST["url"]);


    $DuplicateEntry=0;
    $TableName="merchant_master";
    $ColumnName="mmid";
    $Searchin="Company";
    $SearchValue="$companyname";
    $DuplicateEntry=Check_DuplicateEntry($con, $TableName, $ColumnName, $Searchin, $SearchValue, $AddEdit);
//    echo ("DuplicateEntry:- ".$DuplicateEntry."</br>");
//    die();
    if($DuplicateEntry>0){
        $error_msg="Merchant already exist.";
    }


//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("AddEdit1:- ".$AddEdit1."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("companyname:- ".$companyname."</br>");
//    echo ("address:- ".$address."</br>");
//    echo ("AreaID:- ".$AreaID."</br>");
//    echo ("pincode:- ".$pincode."</br>");
//    echo ("city:- ".$city."</br>");
//    echo ("person :- ".$person."</br>");
//    echo ("panno:- ".$panno."</br>");
//    echo ("telephone:- ".$telephone."</br>");
//    echo ("email:- ".$email."</br>");
//    echo ("url:- ".$url."</br>");
//    die();

    $tablename="merchant_master";
    $searchColumn="mmid";
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
            $Procedure = "Call Save_Merchant('$CurrentDate', $session_userid, '$session_ip', '$companyname', '$address', $AreaID, $pincode, '$city', '$person', '$telephone', '$email', '$url', '$panno');";
        }
        else{
            $IDExist=Check_MerchantIDExist($con, $AddEdit);
            if($IDExist>0) {
                $Procedure = "Call Update_Merchant($IDExist, '$CurrentDate', $session_userid, '$session_ip', '$companyname', '$address', $AreaID, $pincode, '$city', '$person', '$telephone', '$email', '$url', '$panno');";
            }
            else{
                $error_msg="Merchant ID is not getting. Please contact system administrator....";
                ?>
                    <script type="text/javascript">
                        show_error('<?php echo $error_msg; ?>');
                    </script>
                <?php
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
        ?>
            <script type="text/javascript">
                show_error('<?php echo $error_msg; ?>');
            </script>
        <?php
    }

?>