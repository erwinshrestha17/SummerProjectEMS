<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/TestEmployeesLogin.php');
    exit;
}

$_SESSION['authenticated-registration']= false;


$adminID= $_SESSION['id'];

$host = "host = 127.0.0.1";
$port = "port = 5432";
$dbname = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect("$host $port $dbname $credentials");

if (!isset($conn)) {
    echo die("Database connection failed");
}
$sql =<<<Eof
            SELECT * FROM adminlists where id=$adminID;
    Eof;
$ret = pg_query($conn, $sql);
if(!$ret) {
    echo pg_last_error($conn);
    exit;
}

while ($let = pg_fetch_assoc($ret)) {
    $id = $let['id'];
    $username = $let['username'];
    $email = $let['email'];
    $position = $let['position'];
    $organization = $let['organization'];
    $employeeddate = $let['date'];
    $salary = $let['salary'];
    $fullname= $let['fullname'];
    $phonenumber = $let['phonenumber'];

}

?>

<?php
/*
$employeesid_err=$username_err=$email_err=$roles_err=$branch_err=$employeddate_err=$password_err="";
if(isset($_POST['submit'])){

    if(!empty($_POST['employeesid'])) {
        $employeesid = $_POST['employeesid'];
    }else{
        $employeesid_err =" <p> * ID Can Not Be Empty</p> ";
    }
    echo "<br>";
    if(!empty($_POST['username'])) {
        $username = $_POST['username'];
    }else{
        $username_err = "<p>* User Name Can Not Be Empty</p>";
    }
    echo "<br>";
    if(!empty($_POST['email'])) {
        $email = $_POST['email'];
    }else{
        $email_err = "<p> * Email Can Not Be Empty </p>";
    }
    echo "<br>";
    if(!empty($_POST['password'])) {
        $password = $_POST['password'];
    }else{
        $password_err = "<p> * Password Can Not Be Empty </p>";
    }
    echo "<br>";
    if(!empty($_POST['role'])) {
        $roles = $_POST['role'];
    }else{
        $roles_err = "<p> * Role Can Not Be Empty </p>";
    }
    echo "<br>";
    if(!empty($_POST['branch'])) {
        $branch = $_POST['branch'];
    }else{
        $branch_err = "<p> * Branch Can Not Be Empty </p>";
    }
    echo "<br>";
    if(!empty($_POST['employeddate'])) {
        $employeddate = $_POST['employeddate'];
    }else{
        $employeddate_err= "<p> * Employeed Date Can Not Be Empty </p>";
    }
    echo "<br>";
}

$host        = "host = 127.0.0.1";
$port        = "port = 5432";
$dbname      = "dbname = emsdb";
$credentials = "user = postgres password=admin";

$conn = pg_connect( "$host $port $dbname $credentials"  );

if(!isset($conn)){
    echo die("Database connection failed");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $query1 = "INSERT INTO employeeslist (id, username, email, position, organization, date) VALUES ($employeesid,'$username ', '$email','$roles','$branch','$employeddate')";
    $result1 = pg_query($conn, $query1);
    $query2 = "INSERT INTO employeeslogin (id, email, password) VALUES ($employeesid, '$email','$password')";
    $result2 = pg_query($conn, $query2);

    if ($result1 && $result2) {
        echo "Data inserted successfully.";
        header("Location: addingEmployees.php");
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}
*/
?>

<!Doctype html>
<html lang="eng">
<head>
    <title>Adding Employees </title>
    <link rel="icon" type="image/png" href="../Assets/img/img.png">

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

    <style>
        input[type="date"]::before {
            content: attr(placeholder);
            width: 100%;
        }
        input[type="date"]:focus::before,
        input[type="date"]:valid::before { display: none }
    </style>
</head>
<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="../Dashboards/AdminDashboard.php">
            <img src="../Assets/img/img.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Admin <?php echo $fullname ?></span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">


    <div class="animated bounceInDown  w-auto  max-height-vh-100" >
        <ul class="navbar-nav">
            <!-- EMPLOYEES INFORMATION-->
            <!--By using js class='sub-menu' active and deactivated in others according to the button clicked  -->
            <li class='sub-menu' >
                <a class="nav-link text-white " href="#">
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
                        <a class="nav-link text-white" href="../LeaveManagement/leaverequestoverview.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Leave Request Overview</span>
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
                        <a class="nav-link text-white" href="../AdminSettings/adminoverviews.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Overview</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../AdminSettings/adminregistration.php">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10" >table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Registration</span>
                        </a>
                    </li>
                    <!--PROFILE-->

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
                <h6 class="font-weight-bolder mb-0">Registration</h6>
            </nav>
        </div>

        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../AdminSettings/adminprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../Assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->




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
                            <form role="form" action="insertdata.php" method="post">

                                <div class="input-group input-group-outline mb-3">
                                    <input type="number" class="form-control" placeholder="Employees ID" name="employeesid"  required>

                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control" placeholder="Full Name" name="fullname"  required>
                                    <div class="p-2"></div>
                                    <input type="text" class="form-control" placeholder="User Name" name="username"  required>

                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email"  required>
                                    <div class="p-2"></div>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required >

                                </div>

                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-select form-select-lg mb-2" name="role" required>
                                        <option class="outline mb-3" selected value="role">Select Roles</option>
                                        <option class="outline mb-3" name="role">Sr Software Engineer</option>
                                        <option class="outline mb-3" name="role">Jr Web Developer</option>
                                        <option class="outline mb-3" name="role">Full stack developer</option>
                                    </select>
                                    <div class="p-2"></div>


                                    <select class="form-select form-select-lg mb-2 " name="branch" required>
                                        <option class="outline mb-3" selected value="branch">Branch</option>
                                        <option class="outline mb-3" name="branch">Kathmandu</option>
                                        <option class="outline mb-3" name="branch" >Butwal</option>
                                        <option class="outline mb-3" name="branch">Pokhara</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="date" class="form-control" placeholder="Employed" name="employeddate"  required>
                                    <div class="p-2"></div>
                                    <input type="number" class="form-control" placeholder="Salary" name="salary"  required>

                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="tel" class="form-control" placeholder="Mobile" name="phonenumber" minlength="10" maxlength="10" required>

                                </div>

                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="../Assets/js/perfect-scrollbar.min.js"></script>
<script src="../Assets/js/smooth-scrollbar.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

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



