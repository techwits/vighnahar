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

    $consignorid=sanitize($con, $_REQUEST["consignorid"]);
    $consigneeid=sanitize($con, $_REQUEST["consigneeid"]);
    $productid=sanitize($con, $_REQUEST["productid"]);
    $minimumrate=sanitize($con, $_REQUEST["minimumrate"]);
    if($minimumrate==""){
        $minimumrate=0;
    }
    $cartoonrate=sanitize($con, $_REQUEST["cartoonrate"]);
    if($cartoonrate==""){
        $cartoonrate=0;
    }
    $itemrate=sanitize($con, $_REQUEST["itemrate"]);
    if($itemrate==""){
        $itemrate=0;
    }

//    echo ("error_msg:- ".$error_msg."</br>");
//    echo ("AddEdit:- ".$AddEdit."</br>");
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("consignorid:- ".$consignorid."</br>");
//    echo ("consigneeid:- ".$consigneeid."</br>");
//    echo ("productid:- ".$productid."</br>");
//    echo ("minimumrate:- ".$minimumrate."</br>");
//    echo ("cartoonrate:- ".$cartoonrate."</br>");
//    echo ("itemrate:- ".$itemrate."</br>");
//    die();

    if(trim($error_msg)=="") {

                if ($AddEdit==0) {
                    $sqlQry= "";
                    $sqlQry= "select cnid from `consignee_master` where 1=1";
                    $sqlQry.=" and caid=$consignorid ";
                    if ($consigneeid>0){
                        $sqlQry.=" and cnid=$consigneeid ";
                    }
                    $sqlQry.=" and Active=1";
//                    echo ("Check sqlQry :- $sqlQry </br>");
//                    die();
                    mysqli_close($con);
                    include('assets/inc/db_connect.php');
                    $sqlrs = mysqli_query($con, $sqlQry);
                    if (mysqli_num_rows($sqlrs)!=0)
                    {
                        while ($row = mysqli_fetch_array($sqlrs,MYSQLI_NUM))
                        {
                                $db_consigneeID=0;
                                $db_consigneeID=$row{0};
                                $ConsignorConsigneeRate=0;
                                $ConsignorConsigneeRate=Check_ConsignorConsigneeRate($con, $consignorid, $db_consigneeID, $productid);
                                if($ConsignorConsigneeRate==0) {
                                    include('assets/inc/db_connect.php');

                                    $tablename = "rate_master";
                                    $searchColumn = "rmid";
                                    $searchColumn_Value = $AddEdit;
                                    $PageName = basename(__FILE__);
                                    $CurrentDate = date('Y-m-d h:i:s');
                                    $inTime = udate('H:i:s:u');
                                    $Creator = $session_userid;
                                    $ip = $session_ip;

                                    /* Log Start*/
                                        $LogStart_Value = Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
                                    /* Log Start*/


                                    $Procedure = "Call Save_Rate('$CurrentDate', $session_userid, '$session_ip', $consignorid, $db_consigneeID, $productid, $minimumrate, $cartoonrate, $itemrate);";
//                                  echo ("Procedure:- ".$Procedure."</br>");
//                                  die();
                                    include('assets/inc/db_connect.php');
                                    $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                                    if (mysqli_num_rows($result) != 0) {
                                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                                        $LastInsertedID = $row{0};
                                    }
                                    mysqli_free_result($result);
                                    include('assets/inc/db_connect.php');

                                    /* Log Ends*/
                                        Log_End($con, $searchColumn_Value, $LogStart_Value);
                                    /* Log Ends*/
                                }
                            else{
                                    $error_msg= "For this consigee rate has been already added. Please check.........";
                                    ?>
                                        <script type="text/javascript">
                                            show_error('<?php echo $error_msg; ?>');
                                        </script>
                                    <?php
                                    die();
                            }
                        }
                        ?>
                            <script language="javascript">
                                ClearAllControls(0);
                            </script>
                        <?php
                    }
                    else{
                        $error_msg= "Consignee is not available. Please check";
                            ?>
                                <script type="text/javascript">
                                    show_error('<?php echo $error_msg; ?>');
                                </script>
                            <?php
                        die();
                    }

                }
                else{

                        $tablename="rate_master";
                        $searchColumn="rmid";
                        $searchColumn_Value=$AddEdit;
                        $PageName=basename(__FILE__);
                        $CurrentDate = date('Y-m-d h:i:s');
                        $inTime=udate('H:i:s:u');
                        $Creator=$session_userid;
                        $ip=$session_ip;

                        /* Log Start*/
                            $LogStart_Value=Log_Start($con, $CurrentDate, $Creator, $ip, $PageName, $inTime, $tablename, $searchColumn, $searchColumn_Value);
                        /* Log Start*/

                        $IDTableName="rate_master";
                        $IDColumnName="rmid";
                        $IDExist=Check_IDExist($con, $IDTableName, $IDColumnName, $AddEdit);
                        if($IDExist>0) {
                            $Procedure = "Call Update_Rate($AddEdit, '$CurrentDate', $session_userid, '$session_ip', $consignorid, $consigneeid, $productid, $minimumrate, $cartoonrate, $itemrate);";
    //                      echo ("Procedure:- ".$Procedure."</br>");
    //                      die();
                            include('assets/inc/db_connect.php');

                            $result = mysqli_query($con, $Procedure) or trigger_error("Query Failed(save masters)! Error: " . mysqli_error($con), E_USER_ERROR);
                            if (mysqli_num_rows($result) != 0) {
                                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                                $LastInsertedID = $row{0};
                            }
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

                            $error_msg= "Rate ID is not getting. Please contact system administrator....";
                            ?>
                                <script type="text/javascript">
                                    show_error('<?php echo $error_msg; ?>');
                                </script>
                            <?php

                    }
                }
    }
    else{
        ?>
            <script type="text/javascript">
                show_error('<?php echo $error_msg; ?>');
            </script>
        <?php
    }

?>