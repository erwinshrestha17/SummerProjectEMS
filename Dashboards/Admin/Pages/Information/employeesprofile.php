<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}

?>
<!Doctype html>
<html lang="eng">
<head>
    <title>Profiles</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../Assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../Assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS -->
    <link id="pagestyle" href="../Assets/css/material-dashboard.min.css" rel="stylesheet" />
</head>
<body>
<?php include '../Dashboards/AdminSidebar.php' ?>

<script src="../Assets/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/js/perfect-scrollbar.min.js"></script>
<script src="../Assets/js/smooth-scrollbar.min.js"></script>

</body>
</html>