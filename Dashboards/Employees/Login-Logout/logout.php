<?php
session_start();
session_destroy();
header('Location:EmployeesLogin.php');
exit;
?>