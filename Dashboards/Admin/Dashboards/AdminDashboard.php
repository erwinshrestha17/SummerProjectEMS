<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}

$adminID= $_SESSION['id'];
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
            SELECT * FROM adminlists where adminid=$adminID;
    Eof;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}

while ($let = pg_fetch_assoc($ret)) {
    $id = $let['adminid'];
    $image=$let['image'];
    $fullname=$let['fullname'];

}


?>
<!Doctype html>
<html lang="eng">
<head>
    <title>Admin Dashboard</title>
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
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="AdminDashboard.php">
            <img src="../../Assets/img/img.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white"> Admin <?php echo $fullname?></span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">


    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" >
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

            <!-- ATTENDANCE-->
            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1"> Attendance</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../Attendance/attendanceoverview.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Attendance Overview</span>
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

            <!--Leave Management-->

            <li class="sub-menu">
                <a class="nav-link text-white" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Leave Management</span>
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../LeaveRequestManagement/leaverequestsoverview.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Leave Request Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../LeaveRequestManagement/leavetype.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Leave Types</span>
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
                    <!--OVERVIEW-->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../AdminSettings/adminoverviews.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Overview</span>
                        </a>
                    </li>
                    <!--Registration-->

                    <li class="nav-item">
                        <a class="nav-link text-white" href="../AdminSettings/adminregistration.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Registration</span>
                        </a>
                    </li>
                    <!--CHANGE PASSWORD-->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../AdminSettings/changepassword.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Change Password</span>
                        </a>
                    </li>


                </ul>
            </li>



        </ul>

    </div>
    <!--LOG OUT-->
    <div class="sidenav-footer position-absolute w-100 bottom-0  ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../LogIn-Logout/logout.php" type="button">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAZVJREFUWEftlztKBEEURc8FPxtQ0HWM4BcUQyM3YCaCuAMTNRAX4A/BJYiKYj4mugQxFzEQF2BypaR7KIYZZ6ZaqA7mQQf9eVWn3+dWlaiZqWY8DIF6ZaRShGwvA4vAWK+JOrz/AK4kfcbvkoFsnwA7CSCxS4BalfRSPkwCsr0O3FSEKd2fJS1UBdoFDotBHoFmAtxe4fMtabwq0D5QDnggKdwPZLbdgpBamUpN2RDoz/Dbzhsh2w1gRtJFIM0KZHsDuASOyuK1vQKEK1hT0sBdNnBR2x4BToGtYuKkbuqW+4GAbE8Cd8BcNGAeINuzwC0w1fZ3SQLYTaP6ilBULymLZcfsKBK9+IN+gTaBcyDUz79YJaCipeeL+pnInrISwPY0cA8E/SktT1FHUKGOgv4EHQqWFygCCzp0nF0Y2zoi6FFDUhDKvEtHp1bLupYNgVLUr44pq90mfw14SIluB58nSeGw+WtJm/yi9c+A7YpQ78VB8bUyUAEVjtJLwGgC2BtwLekr9k2OUAJAXy5DoF5hql2EfgDdIfYldluSXAAAAABJRU5ErkJggg==" alt=""/>
                
                log out</a>
        </div>
    </div>

</aside>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
        </div>

        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../AdminSettings/adminprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >

                    <img src="../AdminSettings/img/<?php echo $image?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>


    </nav>
    <!-- End Navbar -->
    <?php
    $sql =<<<Eof
            SELECT COUNT(employeesid) as count FROM employeeslist;
    Eof;
    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        exit;
    }
    $count_emp_id=0;
    while ($let = pg_fetch_assoc($ret)) {
        $count_emp_id = $let['count'];

    }

    ?>

    <div class="container-fluid py-4">
        <div class="row ">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>

                        <?php
                        $sql =<<<Eof
                         SELECT total FROM invoice;
                         Eof;
                        $ret = pg_query($conn, $sql);
                        if(!$ret) {
                            echo pg_last_error($conn);
                            exit;
                        }
                        $count_month_expenditure =0;
                        while ($let = pg_fetch_assoc($ret)) {
                            $count_month_expenditure += $let['total'];

                        }

                        ?>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Monthly Expenditure</p>
                            <h4 class="mb-0">Rs <?php echo $count_month_expenditure?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                       <?php /* <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>*/?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Employees Activity</p>
                            <h4 class="mb-0"><?php echo $count_emp_id?> </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                       <?php /* <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> */?>
                    </div>
                </div>
            </div>
            <?php /*
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">New Clients</p>
                            <h4 class="mb-0">0</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Sales</p>
                            <h4 class="mb-0">Rs 0</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                    </div>
                </div>
            </div>

            */?>


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
    let win = Navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        let options = {
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
    let win = Navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        let options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
</body>
</html>


