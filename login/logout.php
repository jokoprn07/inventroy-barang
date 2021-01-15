<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('id', '', 0, '/');
setcookie('guaheker', '', 0, '/');
Header("Location: index.php");
exit;

?>