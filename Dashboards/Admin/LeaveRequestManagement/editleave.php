<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}

$adminID = $_SESSION['id'];
$fullname = "";
$image = "";
$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}
$sql = <<<Eof
            SELECT * FROM adminlists where adminid=$adminID;
    Eof;
$ret = pg_query($conn, $sql);
if (!$ret) {
    echo pg_last_error($conn);
    exit;
}

while ($let = pg_fetch_assoc($ret)) {
    $fullname = $let['fullname'];
    $image = $let['image'];
}
pg_close($conn);
?>
<?php
/*
$sqlSelect = <<<EOF
SELECT * FROM employeeslist
EOF;
$result = pg_query($conn, $sqlSelect);
if (!$result) {
echo pg_last_error($conn);
exit;
}


// Truncate the salaryoverview table
$sqlTruncate = "TRUNCATE TABLE public.salaryoverview";
$resultTruncate = pg_query($conn, $sqlTruncate);

if (!$resultTruncate) {
echo pg_last_error($conn);
exit;
}

// Now, you can proceed with inserting new data as shown in your previous code.
while ($let = pg_fetch_assoc($result)) {
$_SESSION['employeesid'] = $let['employeesid'];
$username1 = $let['username'];
$email1 = $let['email'];
$position1 = $let['position'];
$organization1 = $let['organization'];
$salary1 = $let['salary'];
$image1 = $let['image'];

$empid=$_SESSION['employeesid'];
// Insert data into salaryoverview table
$sqlInsert = <<<EOF
INSERT INTO public.salaryoverview (employeesid, username, email, position, organization, salary, image)
VALUES ($empid, '$username1', '$email1', '$position1', '$organization1', $salary1, '$image1')
EOF;

$result2 = pg_query($conn, $sqlInsert);
if (!$result2) {
    echo pg_last_error($conn);
    exit;
}
}
*/
?>


<!Doctype html>
<html lang="eng">
<head>
    <title>Leave Types</title>
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
    <style>

    </style>
</head>
<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="../Dashboards/AdminDashboard.php" >
            <img src="../../Assets/img/img.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Admin <?php echo $fullname ?> </span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">


    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
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

                <!--ADDING EMPLOYEES-->
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
                <!--SALARY OVERVIEW-->
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
                            <span class="nav-link-text ms-1">Leave Type</span>
                        </a>
                    </li>
                </ul>
            </li>

            <hr class="horizontal light mt-0 mb-2">
            <!--ADMIN-->
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
                    <!--REGISTRATION-->
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Leave Types</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Types</h6>
            </nav>
        </div>

        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../AdminSettings/adminprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../AdminSettings/img/<?php echo $image ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <?php
    $host        = "host = 127.0.0.1";
    $port        = "port = 5432";
    $dbname      = "dbname = emsdb";
    $credentials = "user = postgres password=admin";
    $conn = pg_connect( "$host $port $dbname $credentials"  );
    if(!isset($conn)){
        echo die("Database connection failed");
    }
    $id=$_POST['edit'];
    $sql =<<<Eof
       SELECT * FROM leavetypes where leavetypeid=$id
    Eof;
    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        exit;
    }
    $let=pg_fetch_assoc($ret);
    $name=$let['name'];
    $entitled=$let['entitled'];
    ?>
    <!-- Form Start -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Updating Details</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <form role="form" action="updateleavedata.php" method="post" enctype="multipart/form-data">


                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name" name="name" value="<?php echo $name;?>" required pattern="[A-Za-z ]+" title="Only alphabetic characters and spaces are allowed." >
                                    <div class="p-2"></div>
                                    <input type="number" class="form-control" name="entitled" value="<?php echo $entitled;?>" required pattern="[A-Za-z ]+" max="10" >

                                </div>

                                <div class="text-center">
                                    <button type="submit" name="btn-leave-edit"  class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   FORM END  -->



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


