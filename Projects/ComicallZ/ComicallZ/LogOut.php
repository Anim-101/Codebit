<?php
session_start();
$_SESSION['verification']=0;
session_destroy();
header('Location:Main.html');
?>