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
    $masterrecord=sanitize($con, $_REQUEST["masterrecord"]);

//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("mastertable:- ".$mastertable."</br>");
//    echo ("masterrecord:- ".$masterrecord."</br>");
//    die();




    $Table_ColumnName=$_REQUEST["mastertable"];
    if(strlen(trim($Table_ColumnName))>0){
        $Split_Master = explode("||", $Table_ColumnName);

        $tablename=$Split_Master[0];
        $searchColumn=$Split_Master[1];
        $searchColumn_Value=$AddEdit;
        $PageName=basename(__FILE__);
        $CurrentDate = date('Y-m-d h:i:s');
        $inTime=udate('H:i:s:u');
        $Creator=$session_userid;
        $ip=$session_ip;

        $FirstColumnName="";
        $FirstColumnName=Get_FirstColumnName($con, $Split_Master[0]);
        if(strlen(trim($FirstColumnName))>0) {
            $MasterDataID = Get_MasterDataID($con, $Split_Master[0], $Split_Master[1], $masterrecord, $FirstColumnName);
//            echo("MasterDataID :- $MasterDataID </br>");
//            die();
            if($MasterDataID>0){

                        if(trim($error_msg)=="") {
                            if ($AddEdit==0) {
                                /* Log Start*/
                                    $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
                                /* Log Start*/
                                $Procedure = "Call Delete_Master('$CurrentDate', $session_userid, '$session_ip', '$Split_Master[0]', '$FirstColumnName', $MasterDataID);";
                            }
                            echo ("Procedure:- ".$Procedure."</br>");
                            die();
                            unset($con);
                            include('assets/inc/db_connect.php');
                            $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                            if (mysqli_num_rows($result) != 0) {
                                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                                $LastInsertedID = $row{0};

                                /* Log Ends*/
                                    Log_End($con, $searchColumn_Value, $LogStart_Value);
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

            }
        }
        else{
            echo("First Column Name is not getting. Please chemck.....");
            die();
        }

    }

?>
