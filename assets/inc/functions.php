<?php
include_once 'psl-config.php';
include_once 'common-function.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = false;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function check_login($email, $password, $con) {
    //die();
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $con->prepare("SELECT userid, fullname, pwd, Privilage FROM users
       WHERE loginid = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $db_privilage);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts

            if (checkbrute($user_id, $con) == true) {
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted. We are using
                // the password_verify function to avoid timing attacks.
                if (password_verify($password, $db_password)) {
                    // Password is correct!
                    // Get the user-agent string of the user.

                       // Login successful.
                        return true;

                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    //$now = time();
                    //$con->query("INSERT INTO login_attempts(user_id, time)
                    //               VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
}

function gmail_login($email, $con)
{
    //die();
    // Using prepared statements means that SQL injection is not possible.
//    echo("email pwd :- $email");
//    die();
    if ($stmt = $con->prepare("SELECT userid, fullname, pwd, Privilage FROM users
       WHERE loginid = ?
        LIMIT 1")
    ) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $db_privilage);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {

            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            $user_id = preg_replace("/[^0-9]+/", "", $user_id);
            $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);

            $PrivilageID = Get_PrivilageID($con, $user_id);
            if (intval($PrivilageID) > 0) {
                $lock_cookietime = (3600 * 24 * 1); // 30 days
                if (!isset($_COOKIE[LOCKCOOKIE])) {
                    setcookie(LOCKCOOKIE, 'lock=' . $email, time() + $lock_cookietime, "/");
                }
                if (isset($_COOKIE[SITECOOKIE])) {
                    unset($_COOKIE[SITECOOKIE]);
                }

                $password_hash = hash("sha512", $db_password . $user_browser);
                $_SESSION["user_id"] = $user_id;
                $_SESSION["login_id"] = $email;
                $_SESSION["username"] = $username;
                $_SESSION["privilage"] = $PrivilageID;
                $_SESSION["login_string"] = $password_hash;
                $_SESSION["pageid"] = $user_id . date("YmdHis");
                $_SESSION["timestamp"] = time();

//                echo("user id :- $user_id");
//                echo("email id :- $email");
//                echo("user name :- $username");
//                echo("privilage :- $PrivilageID");
//                echo("user pwd :- $password_hash");
//                echo("cookie time id :- $lock_cookietime");
//                die();

                // Login successful.
                return true;
            }
        }

    }
}

function Check_Member_ValidDate($con, $loginid)
{
    $Getting_Admin_ValidDate="";
    $sqlQry= "";
    $sqlQry.= " select users.ValidTo, 1designation.ValidTo from users  ";
    $sqlQry.= " inner join 1designation ";
    $sqlQry.= " on users.Privilage=1designation.Privilage";
    $sqlQry.= " where loginid='$loginid'";
//    echo("sqlQry :- $sqlQry </br>");
//    die();
    $result_Valid = mysqli_query($con, $sqlQry);
    //fetch tha data from the database
    if (mysqli_num_rows($result_Valid)!=0)
    {
        while ($row = mysqli_fetch_array($result_Valid, MYSQLI_NUM))
        {
            $ValidTo_Date=$row[0];
            $ValidTo_Check=$row[1];
//            echo("ValidTo_Date :- $ValidTo_Date </br>");
//            echo("ValidTo_Check :- $ValidTo_Check </br>");
//            die();
            if ($ValidTo_Check==1) {
                if($ValidTo_Date != 0) {
                    $Getting_Admin_ValidDate = trim(str_replace("-", "/", $ValidTo_Date));
                    $CurrentDate = date('Y/m/d');
                    //                echo("Getting_Admin_ValidDate :- $Getting_Admin_ValidDate </br>");
                    //                echo("CurrentDate :- $CurrentDate </br>");
                    $diff = strtotime($Getting_Admin_ValidDate) - strtotime($CurrentDate);
                    $diff = round($diff / 86400);
                    //                echo("diff : $diff </br>");
                    //                die();
                    if ($diff <= 0) {
                        $Procedure = "";
                        $Procedure = "update `users` set `active`= 0 where `loginid`='$loginid'";
                        //                    echo ("Procedure :- $Procedure");
                        //                    die();
                        $result_UserActive = mysqli_query($con, $Procedure) or trigger_error("Query Failed(member inactive)! Error: " . mysqli_error($con), E_USER_ERROR);
                    }
                }
            }
        }
    }
//    die();
    mysqli_free_result($result_Valid);
}

function Check_SuperUser_Count($con){
    $Getting_SuperUser_Count=0;
    $sqlQry= "";
    $sqlQry= "SELECT count(*) FROM `users`";
    $sqlQry= $sqlQry."  where Privilage in(select Privilage from 1designation where designation_id=1)";
    //echo ("$sqlQry");
    //die();
    $result = mysqli_query($con, $sqlQry);
    //fetch tha data from the database
    if (mysqli_num_rows($result)!=0)
    {
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            $Getting_SuperUser_Count=$row{0};
        }
    }
    mysqli_free_result($result);
    return $Getting_SuperUser_Count;
}

function login($email, $password, $autologin, $con) {

    $return_value=0;
    // Using prepared statements means that SQL injection is not possible.
//    Check_Member_ValidDate($con, $email);
//    $SuperUser_Count=Check_SuperUser_Count($con);

//    echo("Hi, i have reached here.....");
//    die();
//    if (intval($SuperUser_Count) <= 3) {
      if ($stmt = $con->prepare("SELECT loginid, UserName, UserID, UserPassword, Privilage, Active FROM login_master
       WHERE UserID = ?
        LIMIT 1")
        ) {
            $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($db_LoginID, $db_UserName, $db_UserID, $db_UserPassword, $db_Privilage, $db_Active);
            $stmt->fetch();

            if ($stmt->num_rows == 1) {
                // If the user exists we check if the account is locked
                // from too many login attempts
//            echo("active :- $active </br>");
//            die();
//                if (intval($Init) == 1) {
//                    if (intval($approved) == 1) {
                        if (intval($db_Active) == 1) {
                            if (checkbrute($db_LoginID, $con) == true) {
                                // Account is locked
                                // Send an email to user saying their account is locked
                                return false;
                            } else {
                                // Check if the password in the database matches
                                // the password the user submitted. We are using
                                // the password_verify function to avoid timing attacks.
                                if (password_verify($password, $db_UserPassword)) {
                                    // Password is correct!
                                    // Get the user-agent string of the user.
                                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                                    // XSS protection as we might print this value
                                    $db_LoginID = preg_replace("/[^0-9]+/", "", $db_LoginID);
                                    // XSS protection as we might print this value
                                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $db_UserName);

                                    $PrivilageID = Get_PrivilageID($con, $db_LoginID);
//                                    echo("PrivilageID :-  $PrivilageID </br>");
//                                    die();

                                    if (intval($PrivilageID) > 0) {
                                        $password_hash = hash("sha512", $db_UserPassword . $user_browser);
                                        $_SESSION["user_id"] = $db_LoginID;
                                        $_SESSION["login_id"] = $db_UserID;
                                        $_SESSION["username"] = $db_UserName;
                                        $_SESSION["privilage"] = $PrivilageID;
                                        $_SESSION["login_string"] = $password_hash;
                                        $_SESSION["ip"] = get_client_ip();
                                        $_SESSION["pageid"] = $db_LoginID . date("YmdHis");
                                        $_SESSION["timestamp"] = time();
                                        $lock_cookietime = (3600 * 24 * 1); // 30 days
                                        if (!isset($_COOKIE[LOCKCOOKIE])) {
                                            setcookie(LOCKCOOKIE, 'lock=' . $email, time() + $lock_cookietime, "/");
                                        }

                                        if (isset($_COOKIE[SITECOOKIE])) {
                                            unset($_COOKIE[SITECOOKIE]);
                                        }

//                                        echo("user_id :- ". $db_LoginID . "</br>");
//                                        echo("email :-  ". $db_UserID . "</br>");
//                                        echo("username :-  ". $db_UserName . "</br>");
//                                        echo("PrivilageID :-  ". $PrivilageID . "</br>");
//                                        echo("password_hash :-  ". $password_hash . "</br>");
//                                        echo("time :- ". time() . "</br>");
//                                        die();


//                                        echo("Site Cookie :-  ". SITECOOKIE . "</br>");
//                                        echo("autologin :-  ". $autologin . "</br>");
//                                        die();
                                        if ($autologin == 1) {
                                            //                            echo("cookie_name :-". SITECOOKIE ."</br>");
                                            //                            echo("email :- $email </br>");
                                            //                            echo("password_hash :- $password_hash </br>");
                                            //                            echo("cookie_time :- $cookie_time </br>");
                                            //                            die();
                                            $cookie_time = (3600 * 24 * 30); // 30 days
                                            if (!isset($_COOKIE[SITECOOKIE])) {
                                                setcookie(SITECOOKIE, 'usr=' . $email . '&hash=' . $password_hash, time() + $cookie_time, "/");
                                            }
                                        }

                                        // Login successful.
                                        $return_value = 0;
                                        return $return_value;
                                    } // if (intval($PrivilageID) > 0)
                                    else {
                                        $return_value = 4; // Check Privileged //return false;
                                        return $return_value;
                                    }

                                } // if (password_verify($password, $db_password))
                                else {
                                    // Password is not correct
                                    // We record this attempt in the database
                                    //$now = time();
                                    //$con->query("INSERT INTO login_attempts(user_id, time)
                                    //               VALUES ('$user_id', '$now')");
                                    $return_value = 3; // password is wrong //return false;
                                    return $return_value;
                                }
                            }
                        } // if(intval($active)==1)
                        else {
                            $return_value = 2; // user id is inactive (active=0) //return false;
                            return $return_value;
                        }
//                    } //if(intval($approved)==1) {
//                    else {
//                        $return_value = 6; // user id is inactive (active=0) //return false;
//                        return $return_value;
//                    }
//                } // if(intval($Init)==1) {
//                else {
//                    $_SESSION["change_password"] = $user_id;
//                    $return_value = 5; // user id is inactive (active=0) //return false;
//                    return $return_value;
//                }
            } //if ($stmt->num_rows == 1)
            else {
                // No user exists.
                $return_value = 1; // user id (email id) does not exist //return false;
                return $return_value;
            }
        } //if ($stmt = $con->prepare("SELECT userid, fullname, pwd, Privilage, active FROM users
//    } // if (intval($SuperUser_Count) <= 3) {
//    else{
//        // No user exists.
//        $return_value = 7; // user id (email id) does not exist //return false;
//        return $return_value;
//    }
}

function Get_PrivilageID($con, $user_id)
{
	$Getting_PrivilageID=0;
	$sqlQry= "";
	$sqlQry.= "select designationid from designation_master where Privilage in(";
	$sqlQry.= "select Privilage from login_master";
	$sqlQry.= " where loginid=$user_id)";
//	echo (" </br>$sqlQry </br>");
	//die();
	$result = mysqli_query($con, $sqlQry);
	//fetch tha data from the database 
	if (mysqli_num_rows($result)!=0)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) 
			{
				$Getting_PrivilageID=$row{0};
				//echo("Getting_PrivilageID :- $Getting_PrivilageID </br>");
			}
		}
	//echo "Getting_PrivilageID :- ".$Getting_PrivilageID."</br>";
	//die();
	mysqli_free_result($result);
	return $Getting_PrivilageID;	
}
function checkbrute($user_id, $con) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $con->prepare("SELECT time
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function Get_PageAccess($con, $user_id, $php_page)
{
    $Getting_PageAccess=0;
    $sqlQry= "";
    $sqlQry.= " select pageaccess_member.* from pageaccess_member  ";
    $sqlQry.= " inner join designation_master ";
    $sqlQry.= " on designation_master.designationid=pageaccess_member.designation_id";
    $sqlQry.= " where pageaccess_member.menusub_id in(select menusub_id from 1menusub where url='$php_page')";
    $sqlQry.= " and Privilage in(select Privilage from login_master where loginid=$user_id)";
    $sqlQry.= " and pageaccess_member.Active=1";
//    echo (" </br>$sqlQry </br>");
//    die();
    $result = mysqli_query($con, $sqlQry);
    //fetch tha data from the database
    if (mysqli_num_rows($result)!=0)
    {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            $Getting_PageAccess=$row{0};
            if (intval($Getting_PageAccess) > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
            //echo("Getting_PrivilageID :- $Getting_PrivilageID </br>");
        }
    }
    else
    {
        return false;
    }
    //echo "Getting_PrivilageID :- ".$Getting_PrivilageID."</br>";
    //die();
    mysqli_free_result($result);
}

function Get_SessionTimeout()
{

    if (isset($_COOKIE[SITECOOKIE]))
    {
        parse_str($_COOKIE[SITECOOKIE]);
//        echo("</br></br></br></br>");
//        echo("user name :- $usr </br>");
//        echo("user pwd :- $hash </br>");
//        echo("session user pwd :-". $_SESSION['login_id']  ."</br>");
//        echo("session user pwd :- ". $_SESSION['login_string'] ."</br>");
//        die();
        if(($usr == $_SESSION['login_id']) && ($hash == $_SESSION['login_string']))
        {
            $_SESSION['timestamp'] = time(); //set new timestamp
            return true;
        }
        else
        {
            echo("Session and Cookies mismatch....");
            return false;
        }
    }
    else
    {
//        echo("Comes in expiry....");
//        die();
        if(time() - $_SESSION['timestamp'] > 6) { //subtract new timestamp from the old one
            echo("Session expire....");
            //die();
            return false;
        } else {
            $_SESSION['timestamp'] = time(); //set new timestamp
            return true;
        }
    }
}

function login_check_old($con, $php_page) {
    // Check if all session variables are set
    //echo("0 comes in ...");
    //echo("user_id :- ".$_SESSION['user_id'] );
    //die();
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        //$user = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $con->prepare("SELECT pwd
                                      FROM users 
                                      WHERE userid = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if (hash_equals($login_check, $login_string) ){
                    // Logged In!!!!
                    echo("1 comes in ...</br>");
                    //die();

                    if (Get_PageAccess($con, $user_id, $php_page) != true) {
                        echo("you don't have page access.....");
                        die();
                    }
                    echo("2 comes in ...</br>");
                    //die();

                    if (Get_SessionTimeout() != true) {
                        //echo("False comes");
                        //die();
                        return false;
                    }
                    else
                    {
                        //echo("True comes");
                        //die();
                        return true;
                    }

                    echo("3 comes in ...");
                    //die();


                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}


function Get_EmptyTimeOut_ID($con, $page_id)
{
    $Getting_EmptyTimeOut_ID="";
    $sqlQry= "";
    $sqlQry= "select id from `log_pageaccess`";
    $sqlQry.= " where pageid=$page_id";
    $sqlQry.= " and outtime=0";
//    echo ("$sqlQry </br></br></br>");
    //die();
    $result = mysqli_query($con, $sqlQry);
    //fetch tha data from the database
    if (mysqli_num_rows($result)!=0)
    {
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            if (strlen($Getting_EmptyTimeOut_ID)<=0) {
                $Getting_EmptyTimeOut_ID = $row{0};
            }
            else{
                $Getting_EmptyTimeOut_ID = $Getting_EmptyTimeOut_ID.", ".$row{0};
            }
        }
    }
    mysqli_free_result($result);
    return $Getting_EmptyTimeOut_ID;
}

function Get_PageListID($con, $PageName)
{
    $PageName=trim($PageName);
    $Getting_PageListID=0;
    $sqlQry= "";
    $sqlQry= "select id from `log_pagenamelist`";
    $sqlQry= $sqlQry." where pagename='$PageName'";
//    echo ("sqlQry :- $sqlQry");
//    die();
    mysqli_close($con);
    include('assets/inc/db_connect.php');
    $PageListID_result = mysqli_query($con, $sqlQry) or trigger_error("Query Failed(Select log Page name)! Error: ".mysqli_error($con), E_USER_ERROR);
    if (mysqli_num_rows($PageListID_result)!=0)
    {
        while ($row = mysqli_fetch_array($PageListID_result,MYSQLI_NUM))
        {
            $Getting_PageListID=$row{0};
        }
    }
//    unset($con);
    mysqli_close($con);
    include('assets/inc/db_connect.php');

    if ($Getting_PageListID==0){
        $LagPageList_Proc= "Call Save_LogPageList('$PageName');";
//        echo ("LagPageList_Proc :- $LagPageList_Proc </br>");
//        die();
        $LogPageList_result = mysqli_query($con, $LagPageList_Proc) or trigger_error("Query Failed(Log Page List)! Error: ".mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($LogPageList_result) != 0) {
            $rows = mysqli_fetch_array($LogPageList_result);
            $Getting_PageListID = $rows{0};
        }
    }
    return $Getting_PageListID;
}

function log_pageaccess($con, $page_id, $php_page){

//    echo("php_page :- $php_page </br>");
//    die();
    $PageListID=Get_PageListID($con, $php_page);
    if($PageListID<=0){
        echo("Page ID is not Getting. Contact Administrator....");
        die();
    }
//    echo("PageListID :- $PageListID </br>");
//    die();
    $sqlQry= "";
    $sqlQry= "select id,outtime from `log_pageaccess`";
    $sqlQry.= " where pageid=$page_id";
    $sqlQry.= " and PageNameID=$PageListID";
//    echo ("sqlQry :- $sqlQry </br>");
//    die();
//    unset($con);
//    mysqli_close($con);
    include('assets/inc/db_connect.php');
    $result_log = mysqli_query($con, $sqlQry) or trigger_error("Query Failed(log pageaccess)! Error: ".mysqli_error($con), E_USER_ERROR);
    if (mysqli_num_rows($result_log)!=0)
    {
        while ($row = mysqli_fetch_array($result_log, MYSQLI_NUM))
        {
            $PagesID=$row{0};
            $Outtime=$row{1};
        }
//    echo ("PagesID :- $PagesID");
//    echo ("Outtime :- $Outtime");
//    die();

        if (trim($Outtime) == '00:00:00'){
            $Procedure="";
            $Procedure="call Update_log_pageaccess_refreshcount($PagesID); ";
//            echo ("Procedure :- $Procedure </br>");
//            die();
            $result_Upd = mysqli_query($con, $Procedure) or trigger_error("Query Failed(update log pageaccess)! Error: ".mysqli_error($con), E_USER_ERROR);
        }
        else{

            $EmptyTimeOut_ID="";
            $EmptyTimeOut_ID=Get_EmptyTimeOut_ID($con, $page_id);
//            echo ("EmptyTimeOut_ID :- $EmptyTimeOut_ID </br>");
//              die();
            $time=date("H:i:s");
            if (strlen($EmptyTimeOut_ID)>0) {
                $Procedure_Update = "";
                $Procedure_Update = "call Update_log_pageaccess_outtime($EmptyTimeOut_ID, '$time'); ";
//                echo ("Procedure_Update :- $Procedure_Update </br>");
//                die();
                $result_Updt = mysqli_query($con, $Procedure_Update) or trigger_error("Query Failed(update log pageaccess)! Error: " . mysqli_error($con), E_USER_ERROR);
//                unset($con);
                mysqli_close($con);
                include('assets/inc/db_connect.php');
            }

            $time=date("H:i:s");
            $Creation_Time = date("Y/m/d H:i:s");
            $Creator=$_SESSION['user_id'];
            $ip=$_SESSION['ip'];

            $Procedure_Insert="";
            $Procedure_Insert="call save_log_pageaccess('$Creation_Time', $Creator, '$ip', $page_id, $PageListID, '$time');";
//            echo ("Procedure_Insert :- $Procedure_Insert </br>");
//            die();
            $result_Inc = mysqli_query($con, $Procedure_Insert) or trigger_error("Query Failed(Insert log pageaccess)! Error: ".mysqli_error($con), E_USER_ERROR);
            if (mysqli_num_rows($result_Inc) != 0) {
                $rows = mysqli_fetch_array($result_Inc);
                $LastInsertedID = $rows{0};
            }
//            unset($con);
            mysqli_close($con);

        }
    }
    else{

        $EmptyTimeOut_ID="";
        $EmptyTimeOut_ID=Get_EmptyTimeOut_ID($con, $page_id);
//        echo ("EmptyTimeOut_ID :- $EmptyTimeOut_ID </br>");
//        die();
        $time=date("H:i:s");
        if (strlen($EmptyTimeOut_ID)>0) {
            $Procedure_Update = "";
            $Procedure_Update = "call Update_log_pageaccess_outtime($EmptyTimeOut_ID, '$time'); ";
//        echo ("Procedure_Update :- $Procedure_Update </br>");
//        die();
            $result_Updt = mysqli_query($con, $Procedure_Update) or trigger_error("Query Failed(update log pageaccess)! Error: " . mysqli_error($con), E_USER_ERROR);
            // unset($con);
            mysqli_close($con);
            include('assets/inc/db_connect.php');
        }

        $time=date("H:i:s");
        $Creation_Time = date("Y/m/d H:i:s");
        $Creator=$_SESSION['user_id'];
        $ip=$_SESSION['ip'];

        $Procedure_Insert="";
        $Procedure_Insert="call save_log_pageaccess('$Creation_Time', $Creator, '$ip', $page_id, $PageListID, '$time');";
//        echo ("Procedure_Insert :- $Procedure_Insert </br>");
//        die();
        $result_Inc = mysqli_query($con, $Procedure_Insert) or trigger_error("Query Failed(Insert log pageaccess)! Error: ".mysqli_error($con), E_USER_ERROR);
        if (mysqli_num_rows($result_Inc) != 0) {
            $rows = mysqli_fetch_array($result_Inc);
            $LastInsertedID = $rows{0};
        }
        // unset($con);
        mysqli_close($con);

    }

}

function login_check($con, $php_page) {
    // Check if all session variables are set
//    echo("0 comes in ... </br>");
//    echo("user_id :- ".$_SESSION['user_id'] ." </br>");
//    echo("user_name :- ".$_SESSION['username'] ." </br>" );
//    echo("pwd :- ".$_SESSION['login_string'] ." </br>" );
//    echo("pageid :- ".$_SESSION['pageid'] ." </br>" );
//    die();

    $return_value=0;
    if (isset($_SESSION['user_id'],
        $_SESSION['username'],
        $_SESSION['login_string'],
        $_SESSION['pageid'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];

        //$user = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
//        echo("user_id :- ".$user_id . "</br>");
//        die();




        if ($stmt = $con->prepare("SELECT UserPassword
                                      FROM login_master
                                      WHERE loginid = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if (hash_equals($login_check, $login_string) ){
                    // Logged In!!!!

                        //echo("Passed 4....");
                        //die();

                    if (Get_PageAccess($con, $user_id, $php_page) != true) {
                        $return_value=5; // not having page access
                        return $return_value;
                    }

                    if (Get_SessionTimeout() != true) {
                        //echo("False comes");
                        //die();
                        $return_value=6; // session timeout
                        return $return_value;
                    }

//
                } else {
                    $return_value=4; // if session password doesnot exist
                    return $return_value;
                }
            } else {
                // Not logged in
                $return_value=3; // session userid doesnot exist
                return $return_value;
            }
        } else {
            // Not logged in
            $return_value=2; // error in $stmt (if loop)
            return $return_value;
        }
    } else {
        // Not logged in
        $return_value=1; // if session variables are not exists
        return $return_value;
    }
}



function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function get_client_ip() {
$ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

?>