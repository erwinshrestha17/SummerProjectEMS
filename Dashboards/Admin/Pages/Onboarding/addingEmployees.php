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
    <title>Adding EMployees </title>
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
<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <img src="../Assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">


    <div class="animated bounceInDown  w-auto  max-height-vh-100" >
        <ul class="navbar-nav">
            <!-- EMPLOYEES INFORMATION-->
            <!--By using js class='sub-menu' active and deactivated in others according to the button clicked  -->
            <li class='sub-menu' >
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Information</span>
                </a>

                <ul class="navbar-nav">

                    <!-- EMPLOYEES LIST-->

                    <li class="nav-item " >
                        <a class="nav-link text-white " href="../Information/employeeslist.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Employees List</span>
                        </a>
                    </li>

                    <!-- EMPLOYEES PROFILE-->

                    <li class="nav-item" id="">
                        <a class="nav-link text-white <?php //echo isset($page) && $page == 'employeesprofile' ? 'active-menu' : '' ?>" href="../Information/employeesprofile.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Employees Profiles</span>
                        </a>
                    </li>


                </ul>
            </li>
            <!-- EMPLOYEES ONBOARDING-->
            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1"> Onboarding</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../Onboarding/addingEmployees.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Adding Employees</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!--LEAVE MANAGEMENT-->

            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Leave Management</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../LeaveManagement/leaverequest.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Leave request</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--PAYROLL & COMPENSATION-->

            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Payroll & Compensation</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../Payroll-Compensation/salaryoverview.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Salary Overview</span>
                        </a>
                    </li>
                </ul>
            </li>

            <hr class="horizontal light mt-0 mb-2">

            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Admin</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../AdminSettings/adminsettings.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Overview</span>
                        </a>
                    </li>
                </ul>
            </li>



        </ul>

    </div>
    <!--LOG OUT-->
    <div class="sidenav-footer position-absolute w-100 bottom-0  ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../LogIn-Logout/logout.php" type="button">log out</a>
        </div>
    </div>

</aside>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adding Employees</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Tables</h6>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Database Connection -->
    <?php

    $host        = "host = 127.0.0.1";
    $port        = "port = 5432";
    $dbname      = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect( "$host $port $dbname $credentials"  );

    if(!isset($conn)){
        echo die("Database connection failed");
    }

    $sql =<<<Eof
SELECT * FROM employeeslist
Eof;


    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        exit;
    }
    ?>

    <!-- Form Start -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Employees Registration</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <form role="form" action="" method="post">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="number" class="form-control" placeholder="Employees ID">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="User Names">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="password" class="form-control" placeholder="Password">
                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-select form-select-lg mb-2 p-2">
                                        <option class="outline mb-3" selected >Select Roles</option>
                                        <option class="outline mb-3" value="1">One</option>
                                        <option class="outline mb-3" value="2">Two</option>
                                        <option class="outline mb-3" value="3">Three</option>
                                    </select>
                                    <select class="form-select form-select-lg mb-2 ">
                                        <option class="outline mb-3" selected >Branch</option>
                                        <option class="outline mb-3" value="1">One</option>
                                        <option class="outline mb-3" value="2">Two</option>
                                        <option class="outline mb-3" value="3">Three</option>
                                    </select>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="date" class="form-control" placeholder="Employed">

                                </div>

                                <div class="text-center">
                                    <button type="button" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Register</button>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <form>

    </form>



</main>






<script src="../Assets/js/perfect-scrollbar.min.js"></script>
<script src="../Assets/js/smooth-scrollbar.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
</script>

</body>
</html>