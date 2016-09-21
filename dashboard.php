<?php
include('assets/inc/db_connect.php');
include('assets/inc/common-function.php');
include('assets/inc/functions.php');
sec_session_start();
?>

<?php

//    echo("Previlage ID :- ". $_SESSION["privilage"] . "</br>");
    $PrivilageID=$_SESSION["privilage"];
//    echo("sdsd PrivilageID :- ". $PrivilageID . "</br>");
//die();
    if($PrivilageID==1){
        ?>
            <script type="text/JavaScript">
                window.open("superadmindashboard.php","_self")
            </script>
        <?php
    }
    elseif($PrivilageID==2){
        ?>
            <script type="text/JavaScript">
                window.open("admindashboard.php","_self")
            </script>
        <?php
    }
    elseif($PrivilageID==3){
        ?>
            <script type="text/JavaScript">
                window.open("userdashboard.php","_self")
            </script>
        <?php
    }
?>