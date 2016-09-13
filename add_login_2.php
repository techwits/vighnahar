<!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/pages/datatables_api.js"></script>
<!-- /theme JS files -->

<?php
    $error_msg="";
    $CurrentDate = date('Y-m-d h:i:s');

    $searchvalue="";
    if(isset($_REQUEST["searchvalue"])) {
        include('assets/inc/db_connect.php');
        include('assets/inc/common-function.php');

        $searchvalue = sanitize($con, $_REQUEST["searchvalue"]);
        $searchin = sanitize($con, $_REQUEST["searchin"]);
    }

    if (strlen($searchvalue)==0){
        $searchvalue="";
        $searchin=1;
        $TableHeading="Last Top 5 Records..";
    }
    else{
        $TableHeading=$searchvalue." Results..";
    }
    $columnname="";
    $pre_wildcharacter="";
    $post_wildcharacter="";
    if ($searchin==1){
        $columnname="UserName like";
        $pre_wildcharacter="%";
        $post_wildcharacter="%";
    }
?>

<!-- Single row selection -->
    <table class="table datatable-selection-single">
        <thead>
        <tr>
            <th>User Name</th>
            <th>Login ID</th>
            <th>Last Login</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $User_LoginID=1;
            $cols="loginid, CreationDate, ModificationDate, Creator, ip, UserName, UserID, last_login, Active";
            $sqlQry= "select $cols from `login_master`";
            $sqlQry = $sqlQry . " where $columnname '$pre_wildcharacter$searchvalue$post_wildcharacter'";
            $sqlQry= $sqlQry." and loginid>=$User_LoginID";
            $sqlQry= $sqlQry." and Active=1";
            $sqlQry= $sqlQry." order by loginid desc";
            $sqlQry= $sqlQry." limit 0,5";
    //        echo ("Check sqlQry :- $sqlQry </br>");
    //        die();
            unset($con);
            include('assets/inc/db_connect.php');
            $result = mysqli_query($con, $sqlQry);
            if (mysqli_num_rows($result)!=0){
                while ($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                    $loginid=$row[0];
                    $CreationDate=$row[1];
                    $ModificationDate=$row[2];
                    $Creator=$row[3];
                    $ip=$row[4];
                    $UserName=$row[5];
                    $UserID=$row[6];
                    $last_login=$row[7];
                    $last_login=substr($last_login,0,strpos($last_login," "));
                    $Active=$row[8];
                    $div_merchantcontrols="";
                    $div_panel="";
                    ?>
                        <tr>
                            <td><a href="#" onclick="return editlogin(<?php echo $loginid; ?>, '<?php echo $CreationDate; ?>', '<?php echo $ModificationDate; ?>', '<?php echo $Creator; ?>', '<?php echo $ip; ?>', '<?php echo $UserName; ?>', '<?php echo $UserID; ?>', '<?php echo $last_login; ?>', '<?php echo $Active; ?>', '<?php echo $Active; ?>', '<?php echo $Active; ?>');"><?php echo $UserName; ?></a> </td>
                            <td><?php echo $UserID; ?></td>
                            <td><?php echo $last_login; ?></td>
                        </tr>
                    <?php
                }
            }
        ?>
        </tbody>
    </table>
<!-- /single row selection -->