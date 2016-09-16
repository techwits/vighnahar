<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->

<?php
$error_msg="";
$CurrentDate = date('Y-m-d h:i:s');
$lridlist="";
$searchvalue="";
if(isset($_REQUEST["Fill_LRIdList"])) {
    include('assets/inc/db_connect.php');
    include('assets/inc/common-function.php');

    $AddEdit = sanitize($con, $_REQUEST["AddEdit"]);
    $session_userid = sanitize($con, $_REQUEST["session_userid"]);
    $session_ip = sanitize($con, $_REQUEST["session_ip"]);

    $financialyear = sanitize($con, $_REQUEST["financialyear"]);
    $rmdate = sanitize($con, $_REQUEST["rmdate"]);
    $vehicleid = sanitize($con, $_REQUEST["vehicleid"]);
    $transporterid = sanitize($con, $_REQUEST["transporterid"]);
    $lridlist = sanitize($con, $_REQUEST["Fill_LRIdList"]);
    $Get_LRId = sanitize($con, $_REQUEST["Get_LRId"]);
    $LRIDExist=Check_LRIDExist($con, $Get_LRId);
    $Valid_LRID="";
    if($LRIDExist>0) {
        $LRIDExist_ForRM = Check_LRIDExist_ForRM($con, $Get_LRId);
//        echo("LRIDExist_ForRM :- $LRIDExist_ForRM </br>");

        if ($LRIDExist_ForRM == 0) {
            ?>
            <script type="text/javascript">
//                alert("OK.");
                    Fill_LRIdList=document.getElementById("lrid_list1").value
                    if(Fill_LRIdList=="") {
                        document.getElementById("lrid_list1").value = <?php echo $Get_LRId; ?>;
                    }
                    else{
                        document.getElementById("lrid_list1").value = Fill_LRIdList + "," + <?php echo $Get_LRId; ?>;
                    }
                // alert("Fill_LRIdList :- " + Fill_LRIdList);
                Valid_LRIDs=document.getElementById("lrid_list1").value;
                display_LR('<?php echo $AddEdit; ?>', '<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $financialyear; ?>', '<?php echo $rmdate; ?>', '<?php echo $vehicleid; ?>', '<?php echo $transporterid; ?>', '<?php echo $lridlist; ?>', '<?php echo $Get_LRId; ?>', '<?php echo $LRIDExist; ?>', Valid_LRIDs);
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                show_error("This LR no's Road Memo has been already done. please check........");
                //                return false;
                Valid_LRIDs=document.getElementById("lrid_list1").value;
                document.getElementById("lrno").value="";
                display_LR('<?php echo $AddEdit; ?>', '<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $financialyear; ?>', '<?php echo $rmdate; ?>', '<?php echo $vehicleid; ?>', '<?php echo $transporterid; ?>', '<?php echo $lridlist; ?>', '<?php echo $Get_LRId; ?>', '<?php echo $LRIDExist; ?>', Valid_LRIDs);
            </script>
            <?php
            die();
        }
    }
    else{
        ?>
            <script type="text/javascript">
                show_error("LR No does not exist. Please check........");
                Valid_LRIDs=document.getElementById("lrid_list1").value;
                display_LR('<?php echo $AddEdit; ?>', '<?php echo $session_userid; ?>', '<?php echo $session_ip; ?>', '<?php echo $financialyear; ?>', '<?php echo $rmdate; ?>', '<?php echo $vehicleid; ?>', '<?php echo $transporterid; ?>', '<?php echo $lridlist; ?>', '<?php echo $Get_LRId; ?>', '<?php echo $LRIDExist; ?>', Valid_LRIDs);
            </script>
        <?php
        die();
    }
//    echo ("session_userid:- ".$session_userid."</br>");
//    echo ("session_ip:- ".$session_ip."</br>");
//    echo ("financialyear:- ".$financialyear."</br>");
//    echo ("rmdate:- ".$rmdate."</br>");
//    echo ("vehicleid:- ".$vehicleid."</br>");
//    echo ("transporterid:- ".$transporterid."</br>");
//    echo ("lridlist:- ".$lridlist."</br>");
//    echo ("Get_LRId:- ".$Get_LRId."</br>");
//    echo ("Valid_LRID:- ".$Valid_LRID."</br>");
//    die();
//
}

?>
