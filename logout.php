<?php
session_start();

// Set the login session to "0" (logged out state)
$_SESSION['login'] = "0";

// Unset all session variables to log out the user
session_unset();

// Optionally, destroy the session if you want to completely clear all session data
// session_destroy();

// Set a logout message
$_SESSION['errmsg'] = "You have successfully logged out";

// Redirect to the index page
header("Location: index.php");
exit();
?>
