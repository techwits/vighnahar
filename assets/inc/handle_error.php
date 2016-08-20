<?php

//echo("get_return_value :- $get_return_value");
//die();
if ($get_return_value==1 || $get_return_value==2 || $get_return_value==3 || $get_return_value==4 || $get_return_value==7)
{
        ?>
            <script language="JavaScript">
                    window.location.href = 'login.php';
            </script>
        <?php
}
elseif($get_return_value==5)
{
//        include_once("error500.php");
//        die();
       ?>
            <script language="JavaScript">
                    window.location.href = 'login.php';
            </script>
        <?php
}
elseif($get_return_value==6)
{
       ?>
            <script language="JavaScript">
                    window.location.href = 'login.php';
            </script>
        <?php
}
elseif($get_return_value==7)
{
    ?>
    <script language="JavaScript">
        alert("Big Error.....");
        window.location.href = 'login.php';
    </script>
    <?php
}
?>