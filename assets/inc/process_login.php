<?php
include('db_connect.php');
include('functions.php');
sec_session_start();

$username = $_POST['userid'];
$password = $_POST['pwd']; // The hashed password.
$autologin=$_POST['autologin'];

//echo("username :- $username </br>");
//echo("password :- $password </br>");
//echo("autologin :- $autologin </br>");
//die();

    if (isset($_POST["userid"])) {
            echo("Userid success.....");
//            die();
            if (isset($_POST['userid'], $_POST['pwd'], $_POST['autologin'])) {
                $userid = $_POST['userid'];
                $password = $_POST['pwd']; // The hashed password.
                $autologin = $_POST['autologin']; // The hashed password.
                $Login_ReturnValue=0;
                $Login_ReturnValue=login($userid, $password, $autologin, $con);
                echo " Login_ReturnValue :- $Login_ReturnValue ";
//                die();

                if ($Login_ReturnValue == 0) {
                    if (isset($_COOKIE[SITECOOKIE])) {
                        parse_str($_COOKIE[SITECOOKIE]);
                        if (($usr == $_SESSION['login_id']) && ($hash == $_SESSION['login_string'])) {
                            $_SESSION['timestamp'] = time(); //set new timestamp
                            return true;
                        } else {
                            include("logout.php");
                            return false;
                        }
                    }
                    ?>
                    <script language="JavaScript" type="text/javascript">
                        window.location = "dashboard.php";
                    </script>
                    <?php
                } else {
                            $errormsg="";
                            // The correct POST variables were not sent to this page.
                            if ($Login_ReturnValue==1){
                                $errormsg="UserID does not exist...";
                            }
                            elseif ($Login_ReturnValue==2){
                                $errormsg='User is inactive...';
                            }
                            elseif ($Login_ReturnValue==3){
                                $errormsg='Password is wrong...';
                            }
                            elseif ($Login_ReturnValue==4){
                                $errormsg='Dont have Privileges...';
                            }
                            elseif ($Login_ReturnValue==5){
                                $errormsg='Change Password First...';
                            }
                            elseif ($Login_ReturnValue==6){
                                $errormsg='Not Approved...';
                            }
                    ?>
                    <script>
                        alert('<?php echo $errormsg; ?>');
                        var code=<?php echo $Login_ReturnValue; ?>;
//                        alert("code :- " + code);
                        if (code!=5) {
                            window.location = "login.php";
                        }
                        else {
                            window.location = "change_password.php";
                        }
                    </script>
                    <?php
                }
            } else {
                echo("Please provide all details...");
                //die();
            }
    } else {
        //    echo("Hi.....");
        echo 'Please Select userid...';
        //die();
    }

?>