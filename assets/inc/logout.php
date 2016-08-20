<?php
include_once 'functions.php';

if (isset($_COOKIE[SITECOOKIE]))
{
	setcookie(SITECOOKIE, "", time()-3600, "/");
}
if (isset($_COOKIE[LOCKCOOKIE]))
{
	setcookie(LOCKCOOKIE, "", time()-3600, "/");
}

sec_session_start();

// Unset all session values
$_SESSION = array();

// get session parameters
$params = session_get_cookie_params();

// Delete the actual cookie.
setcookie(session_name(),
	'', time() - 42000,
	$params["path"],
	$params["domain"],
	$params["secure"],
	$params["httponly"]);

// Destroy session
session_destroy();
//header('Location: ../login.php');
?>