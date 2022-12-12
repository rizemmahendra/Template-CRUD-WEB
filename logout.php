<?php  
session_start();
session_unset();
$_SESSION = [];
session_destroy();
header("Location: login.php");

setcookie("id", "", time() - 3600);
setcookie("key", "", time() - 3600);
?>