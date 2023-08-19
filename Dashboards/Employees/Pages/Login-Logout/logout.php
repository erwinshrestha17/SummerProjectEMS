<?php
session_start();
session_destroy();
header('Location:TestEmployeesLogin.php');
exit;
?>