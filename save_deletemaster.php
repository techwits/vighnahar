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

    $AddEdit=0;
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');
    $session_userid=$_REQUEST["session_userid"];
    $session_ip=$_REQUEST["session_ip"];

    $mastertable=sanitize($con, $_REQUEST["mastertable"]);

    $TableName=sanitize($con, $_REQUEST["TableName"]);
    $ColumnName=sanitize($con, $_REQUEST["ColumnName"]);
    $FirstColumn=sanitize($con, $_REQUEST["FirstColumn"]);

    $masterrecord=sanitize($con, $_REQUEST["masterrecord"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("mastertable:- ".$mastertable."</br>");
//
//    echo ("TableName:- ".$TableName."</br>");
//    echo ("ColumnName:- ".$ColumnName."</br>");
//    echo ("FirstColumn:- ".$FirstColumn."</br>");
//
//    echo ("masterrecord:- ".$masterrecord."</br>");
//    die();



    $tablename=$TableName;
    $searchColumn=$FirstColumn;
    $searchColumn_Value=$masterrecord;
    $PageName=basename(__FILE__);
    $CurrentDate = date('Y-m-d h:i:s');
    $inTime=udate('H:i:s:u');
    $Creator=$session_userid;
    $ip=$session_ip;

    if(trim($error_msg)=="") {

        /* Log Start*/
            $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
        /* Log Start*/

        if ($AddEdit==0) {
            $Procedure= " update $TableName";
            $Procedure.= " set ";
            $Procedure.= " ModificationDate='$CurrentDate', ";
            $Procedure.= " Creator=$session_userid, ";
            $Procedure.= " ip='$session_ip', ";
            $Procedure.= " Active=0 ";
            $Procedure.= " where $FirstColumn=$masterrecord";
        }
    //    echo ("Procedure:- ".$Procedure."</br>");
    //    die();

        include('assets/inc/db_connect.php');
        $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
        mysqli_free_result($result);
        /* Log Ends*/
            Log_End($con, $searchColumn_Value, $LogStart_Value);
        /* Log Ends*/
        ?>
            <script language="javascript">
                ClearAllControls(0);
            </script>
        <?php
    }
    else{
        ?>
        <script type="text/javascript">
            show_error('<?php echo $error_msg; ?>');
        </script>
        <?php
    }