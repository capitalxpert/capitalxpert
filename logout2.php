<?php
session_start(); 

session_unset(); 

session_destroy(); 

header("Location: login2.html"); 
exit();
?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>
