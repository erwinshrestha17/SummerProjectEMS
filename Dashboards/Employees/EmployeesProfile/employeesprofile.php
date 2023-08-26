<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}else{

    $employeeID= $_SESSION['id'];
    $fullname="";
    $image="";

    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }
    $sql =<<<Eof
            SELECT * FROM employeeslist where employeesid=$employeeID;
    Eof;
    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        exit;
    }

    while ($let = pg_fetch_assoc($ret)) {
        $email = $let['email'];
        $position = $let['position'];
        $organization = $let['organization'];
        $salary = $let['salary'];
        $fullname= $let['fullname'];
        $phonenumber = $let['phonenumber'];
        $images=$let['image'];

    }
    pg_close($conn);
}
?>




<!Doctype html>
<html lang="eng">
<head>
    <title>Employees Profiles</title>
    <link rel="icon" type="image/png" href="../../Assets/img/img.png">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../../Assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../Assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS -->
    <link id="pagestyle" href="../../Assets/css/material-dashboard.min.css" rel="stylesheet" />
</head>
<body class="g-sidenav-show  bg-gray-200">

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="../Dashboards/EmployeesDashboard.php" target="_self">
            <img src="../../Assets/img/img.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Welcome <?php echo $fullname ?> </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="animated bounceInDown w-auto  max-height-vh-100" >
        <ul class="navbar-nav">
            <!-- EMPLOYEES INFORMATION-->


            <!--SALARY REQUEST-->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Salary</span>
                </a>
                <ul class="navbar-nav">
                    <!-- EMPLOYEES PROFILE-->
                    <li class="nav-item" id="">
                        <a class="nav-link text-white" href="../SalaryRequest/salaryrequest.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Request Salary</span>
                        </a>
                    </li>


                </ul>
            </li>


        </ul>
    </div>
    <!--LOG OUT-->
    <div class="sidenav-footer position-absolute w-100 bottom-0  ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../Login-Logout/logout.php" type="button">log out</a>
        </div>
    </div>
</aside>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Employee Profiles</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Profile</h6>
            </nav>
        </div>

        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../EmployeesProfile/adminprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../../Admin//Onboarding/img/<?php echo $images?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->





    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img   src="../../Admin/Onboarding/img/<?php echo $images ?>" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <?php echo $fullname;?>
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            <?php echo $position?> / <?php echo $organization?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a href='../Dashboards/EmployeesDashboard.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                                    <button class='btn btn-lg bg-gradient-primary btn-sm w-40 mt-2 mb-0' >
                                        <i class="material-icons text-lg position-relative">home</i>
                                        Close
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--Account Details -->
            <div class="row">
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <h6 class="mb-0">Bank Account Details</h6>
                            </div>
                            <div class="card-body p-3">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl">
                                        <img src="../../Assets/img/illustrations/pattern-tree.svg" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                                        <span class="mask bg-gradient-dark opacity-10"></span>
                                        <div class="card-body position-relative z-index-1 p-3">
                                            <i class="material-icons text-white p-2">wifi</i>
                                            <h6 class="text-white text-uppercase">Shine Resunga Development Bank LTD </h6>
                                            <h5 class="text-white mt-4 mb-5 pb-2"> 4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                                            <div class="d-flex">
                                                <div class="d-flex">

                                                    <div class="me-4">
                                                        <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                        <h6 class="text-white mb-0"><?php echo $fullname?></h6>
                                                    </div>
                                                    <div>
                                                        <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                        <h6 class="text-white mb-0">11/26</h6>
                                                    </div>
                                                </div>
                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                    <img class="w-60 mt-2" src="../../Assets/img/logos/mastercard.png" alt="logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="card pt-1">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Salary</h6>
                                        <span class="text-xs">Base Salary</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">Rs <?php echo $salary?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="card pt-1">
                                    <a href="#">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="material-icons opacity-10">account_balance_wallet</i>
                                            </div>
                                        </div>

                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Bonus</h6>
                                            <span class="text-xs">Incentives Payment</span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">Rs 0</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- General Information -->

            <div class="row">
                <div class="row">

                    <div class="col-12 col-xl-6">
                        <div class="card card-plain h-100 bg-transparent shadow-xl">
                            <div class="card-header pb-0 p-2">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">General Information</h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="javascript:;">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <p class="text-sm">

                                    Hi, I’m <?php echo $fullname?> : If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                                </p>
                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">VAT Number: </strong>600678956</li>
                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $fullname ?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp;<?php echo $phonenumber?> </li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $email?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; <?php echo $organization?></li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Education:</strong> &nbsp; Oxford College , Tribhuvan University</li>

                                    <li class="list-group-item border-0 ps-0 pb-0">
                                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </a>
                                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-instagram fa-lg"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Skills-->

                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Skills</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 pb-0">
                                <div class="row">
                                    <div class=" flex-column">
                                        <button type="button" class="btn bg-gradient-primary w-auto ">Java</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" flex-column">
                                        <button type="button" class="btn bg-gradient-primary w-auto ">Java Script</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" flex-column">
                                        <button type="button" class="btn bg-gradient-primary w-auto ">React</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" flex-column">
                                        <button type="button" class="btn bg-gradient-primary w-auto ">Python</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Invoices -->

            <div class="row mt-2" >
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Invoices</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">View All</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 pb-0">
                                <ul class="list-group">
                                    <?php
                                    $host = "host = 127.0.0.1";
                                    $port = "port = 5432";
                                    $dbname = "dbname = emsdb";
                                    $credentials = "user = postgres password=admin";

                                    $conn = pg_connect("$host $port $dbname $credentials");

                                    if (!isset($conn)) {
                                        echo die("Database connection failed");
                                    }

                                    $sqlinvoice = <<<EOF
        SELECT * FROM invoice WHERE employeesid = $employeeID;
    EOF;

                                    $ret = pg_query($conn, $sqlinvoice);

                                    if (!$ret) {
                                        echo pg_last_error($conn);
                                        exit;
                                    }

                                    while ($let = pg_fetch_assoc($ret)) {
                                        $invoiceID = $let['invoiceid'];
                                        $month = $let['month'];
                                        $day=$let['day'];
                                        $year=$let['year'];
                                        $total = $let['total'];

                                        echo "
        <li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>
            <div class='d-flex flex-column'>
                <h6 class='mb-1 text-dark font-weight-bold text-sm'>$month , $day 20$year</h6>
       
                <span class='text-xs'>#MS-$invoiceID</span>
            </div>
            <div class='d-flex align-items-center text-sm'>
                RS $total
                <button class='btn btn-link text-dark text-sm mb-0 px-0 ms-4'>
                    <i class='material-icons text-lg position-relative me-1'>picture_as_pdf</i> PDF
                </button>
            </div>
        </li>";
                                    }

                                    pg_close($conn);
                                    ?>


                                </ul>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Invoices</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <?php
                                                    $host = "host = 127.0.0.1";
                                                    $port = "port = 5432";
                                                    $dbname = "dbname = emsdb";
                                                    $credentials = "user = postgres password=admin";

                                                    $conn = pg_connect("$host $port $dbname $credentials");

                                                    if (!isset($conn)) {
                                                        echo die("Database connection failed");
                                                    }
                                                    $sqlinvoice = <<<EOF
                                                        SELECT * FROM invoice WHERE employeesid = $employeeID;
                                                    EOF;
                                                    $ret = pg_query($conn, $sqlinvoice);
                                                    if (!$ret) {
                                                        echo pg_last_error($conn);
                                                        exit;
                                                    }
                                                    while ($let = pg_fetch_assoc($ret)) {
                                                        $invoiceID = $let['invoiceid'];
                                                        $month = $let['month'];
                                                        $total = $let['total'];
                                                        echo "
                                                                <li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>
                                                                    <div class='d-flex flex-column'>
                                                                        <h6 class='mb-1 text-dark font-weight-bold text-sm'>$month , $day 20$year</h6>
                                                                        <span class='text-xs'>#MS-$invoiceID</span>
                                                                    </div>
                                                                    <div class='d-flex align-items-center text-sm'>
                                                                        RS $total
                                                                        <button class='btn btn-link text-dark text-sm mb-0 px-0 ms-4'>
                                                                            <i class='material-icons text-lg position-relative me-1'>picture_as_pdf</i> PDF
                                                                        </button>
                                                                    </div>
                                                                </li>";
                                                    }

                                                    pg_close($conn);
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </div>

</main>

<!--   Core JS Files   -->
<script src="../../Assets/js/bootstrap.bundle.min.js"></script>
<script src="../../Assets/js/perfect-scrollbar.min.js"></script>
<script src="../../Assets/js/smooth-scrollbar.min.js"></script>
<script src="../../Assets/js/core/popper.min.js"></script>
<script src="../../Assets/js/core/bootstrap.min.js"></script>
<script src="../../Assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../Assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="../../Assets/js/material-dashboard.min.js?v=3.1.0"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
</body>
</html>