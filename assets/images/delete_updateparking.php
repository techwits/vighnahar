<?php

    include_once('inc/db_connect.php');
    include_once('inc/common-function.php');


    if(!isset($_REQUEST["Creator"])) {
        $UrlPage=substr($_SERVER["PHP_SELF"],1,strlen($_SERVER["PHP_SELF"]));
        $AccessingPage=basename(__FILE__); //"add_society.php";
//        echo("UrlPage :- $UrlPage </br>");
//        echo("AccessingPage :- $AccessingPage </br>");
        if(trim($UrlPage)==trim($AccessingPage)){
            header("Location: /login.php");
        }
    }

    $LastInsertedID=0;

    $CurrentDate = date('Y-m-d h:i:s');
    $ip=sanitize($con, $_REQUEST["ip"]);
    $Creator=sanitize($con, $_REQUEST["Creator"]);
    $parkingslot_id=sanitize($con, $_REQUEST["id"]);

//    echo ("parkingslot_id :- ".$parkingslot_id."</br>");
//    die();

    $tablename="parking";
    $searchColumn="parkingslot_id";
    $searchColumn_Value=$parkingslot_id;
    $PageName=basename(__FILE__);

    $inTime=udate('H:i:s:u');

    $Delele_Button="Delele_Button".$parkingslot_id;

        /* Log Start*/
        $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
//			echo("LogStart_Value :- $LogStart_Value </br>");
//			die();
        unset($con);
        mysqli_close($con);
        include('inc/db_connect.php');
        /* Log Start*/

        $Procedure= "";
        $Procedure= "Call Delete_Parking('$CurrentDate', $Creator, '$ip', $parkingslot_id);";
//        echo ("$Procedure");
//        die();

        $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(Delete Building)! Error: ".mysqli_error($con), E_USER_ERROR);
            if (mysqli_num_rows($result) != 0) {
                $rows = mysqli_fetch_array($result);
                $LastInsertedID = $rows{0};
                if($LastInsertedID>0) {
                    /* Log Ends*/
                        Log_End($con, $searchColumn_Value, $LogStart_Value);
                        unset($con);
                        mysqli_close($con);
                    /* Log Ends*/
                }
            }

        $Message="";
        $LastInsertedID>0?$Message="Record Deleted":$Message="Record Not Deleted";
        $timeOut=4000;
        $form_no=1;
        $afterSave=2;
        ?>
        <script language="javascript">
            FormSubmit_Message(<?php echo $form_no; ?>, <?php echo $LastInsertedID; ?>, '<?php echo $Message; ?>', <?php echo $timeOut; ?>, <?php echo $afterSave; ?>)
            var divname='<?php echo $Delele_Button; ?>';
            document.getElementById(divname).innerHTML = "Deleted";
        </script>