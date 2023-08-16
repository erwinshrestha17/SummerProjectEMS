<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: EmployeesLogin.php');
    exit;
}
?>


<!Doctype html>
<html lang="eng">
<head>
    <title>Employees Dashboard</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../Employees/Assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../Employees/Assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS -->
    <link id="pagestyle" href="../Employees/Assets/css/material-dashboard.min.css" rel="stylesheet" />
</head>
<body>
<?php include 'EmployeesNavbar.php' ?>
<?php include 'EmployeesSidebar.php' ?>

<script src="../Employees/Assets/js/bootstrap.bundle.min.js"></script>
<script src="../Employees/Assets/js/perfect-scrollbar.min.js"></script>
<script src="../Employees/Assets/js/smooth-scrollbar.min.js"></script>

</body>
</html>