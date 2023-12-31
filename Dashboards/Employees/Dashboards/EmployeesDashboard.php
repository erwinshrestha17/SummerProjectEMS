<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/EmployeesLogin.php');
    exit;
}

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
    $fullname= $let['fullname'];
    $images=$let['image'];
}
pg_close($conn);
?>



<!Doctype html>
<html lang="eng">
<head>
    <title>Employees Dashboard</title>
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
<body>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="EmployeesDashboard.php" target="_self">
            <img src="../../Assets/img/img.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Welcome <?php echo $fullname ?> </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="animated bounceInDown w-auto  max-height-vh-100" >
        <ul class="navbar-nav">

            <!-- ATTENDANCE -->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Attendance</span>
                </a>
                <ul class="navbar-nav">
                    <!-- CHECK IN  -->
                    <li class="nav-item" id="">
                        <a class="nav-link text-white" href="../Attendance/checkin.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Check In</span>
                        </a>
                    </li>
                    <!-- CHECK OUT  -->
                    <li class="nav-item" id="">
                        <a class="nav-link text-white" href="../Attendance/checkout.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Check Out</span>
                        </a>
                    </li>


                </ul>
            </li>


            <!--SALARY REQUEST-->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Salary</span>
                </a>
                <ul class="navbar-nav">
                    <!-- Request Salary-->
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


            <!--Leave Management-->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Leave Management </span>
                </a>
                <ul class="navbar-nav">
                    <!-- Leave Request-->
                    <li class="nav-item" id="">
                        <a class="nav-link text-white" href="../LeaveManagement/leaverequest.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Leave Request</span>
                        </a>
                    </li>
                </ul>
            </li>




            <hr class="horizontal light mt-0 mb-2">
            <!-- Change Password-->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Password</span>
                </a>
                <ul class="navbar-nav">
                    <!-- Change Password-->
                    <li class="nav-item" id="">
                        <a class="nav-link text-white" href="../EmployeesProfile/changepassword.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-end">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Change password</span>
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
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
        </div>
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../EmployeesProfile/employeesprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../../Admin/Onboarding/img/<?php echo $images?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Leave Request Response -->
    <?php
    $host = "host = 127.0.0.1";
    $port = "port = 5432";
    $dbname = "dbname = emsdb";
    $credentials = "user = postgres password=admin";

    $conn = pg_connect("$host $port $dbname $credentials");

    if (!isset($conn)) {
        echo die("Database connection failed");
    }
    $sql =<<<Eof
            SELECT * FROM leavemanagement where employeesid=$employeeID;
    Eof;
    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        exit;
    }
    $status = ''; // Initialize with a default value
    $leavefrom = ''; // Initialize other variables with default values
    $leaveto = '';
    while ($let = pg_fetch_assoc($ret)) {
        $status=$let['status'];
        $leavefrom=$let['leavefrom'];
        $leaveto=$let['leaveto'];
    }

    ?>

    <div class="container-fluid py-4">
        <div class="row ">
            <div class="col-xl-4 col-sm-8">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">report</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Leave Request</p>
                            <?php
                            if ($status==="Approved"){
                                echo '<h4 class="mb-0">Approved</h4>';

                            }elseif ($status==="Declined"){
                                echo '<h4 class="mb-0">Declined</h4>';

                            }elseif($status==="Pending"){
                                echo '<h4 class="mb-0">Pending</h4>';

                            }else{
                                echo '<h4 class="mb-0">No Request Sent</h4>';
                            }
                            ?>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <?php
                            if ($status==="Approved"){
                                echo '<p class="mb-0"><span class="text-success text-sm font-weight-bolder">Enjoy Holiday</span></p> ';

                            }elseif ($status==="Declined"){
                                echo '<p class="mb-0"><span class="text-danger text-sm font-weight-bolder">Better Luck Next Time</span></p> ';
                            }elseif($status==="Pending"){
                                echo '<p class="mb-0"><span class="text-primary text-sm font-weight-bolder">Wait For The Response</span></p> ';
                            }else{
                                echo '<p class="mb-0"><span class="text- text-sm font-weight-bolder">Enjoy Work Time</span></p> ';

                            }

                        ?>
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
    let win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        let options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<script src="../../Assets/js/material-dashboard.min.js?v=3.1.0"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $('.sub-menu ul').hide();
    $(".sub-menu a").click(function () {
        $(this).parent(".sub-menu").children("ul").slideToggle("100");
        $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
    });
</script>
<script>
    let win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        let options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
</body>
</html>