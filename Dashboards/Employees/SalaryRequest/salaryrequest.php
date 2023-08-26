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
        $username = $let['username'];
        $email = $let['email'];
        $position = $let['position'];
        $organization = $let['organization'];
        $salary = $let['salary'];
        $fullname= $let['fullname'];
        $images=$let['image'];

    }
    $_SESSION['employeeid']=$employeeID;
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['position']=$position;
    $_SESSION['organization']=$organization;
    $_SESSION['salary']=$salary;
    $_SESSION['image']=$images;
    $totalbonus = isset($_SESSION['totalbonus']);

}
?>



<!Doctype html>
<html lang="eng">
<head>
    <title>Request Salary</title>
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
        input[type="date"]::before {
            content: attr(placeholder);
            width: 100%;
        }
        input[type="date"]:focus::before,
        input[type="date"]:valid::before { display: none }
    </style>

</head>
<body>
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



            <!--SALARY REQUEST-->
            <li class='sub-menu'>
                <a class="nav-link text-white ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Salary</span>
                </a>
                <ul class="navbar-nav">
                    <!-- SALARY REQUEST -->
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Salary Request</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Request</h6>
            </nav>
        </div>
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../../Employees/EmployeesProfile/employeesprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../../Admin/Onboarding/img/<?php echo $images?>"alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Request Salary</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <?php
                            $allowedDate = strtotime(date("Y-m-23")); // Set allowed date to the 15th day of the current month
                            $currentDate = strtotime(date("Y-m-d")); // Get the current date

                            if ($currentDate >= $allowedDate) {
                            // Allow the user to send requests
                            // Your form code and request processing code here
                            } else {
                            // Display a message indicating that requests are not allowed yet
                            echo '<p>Requests are not allowed until ' . date("F j, Y", $allowedDate) . '</p>';
                            }

                            ?>

                            <form role="form" action="insertdata.php" method="post" enctype="multipart/form-data">
                                <div id="alertContainer"  style="z-index: 1050">

                                </div>
                                <?php

                                $day= (string) date('d');
                                $month=(string) date('m');
                                $year= (string) date('y');
                                $currentmonth= (string)$month;
                                switch ($currentmonth) {
                                    case '01':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control ' placeholder='Month' name='month' value='January'  required>
                                                    
                                                    
                                                    
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '02':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='February'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '03':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='March'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '04':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='Aoril'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '05':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='MAY'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '06':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='JUN'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '07':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='JULY'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '08':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='AUGUST'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '09':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='SEPTEMBER'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '10':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='OCTOBER'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '11':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='NOVEMBER'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    case '12':
                                        echo "  <div class='input-group input-group-outline mb-3'>
                                                    <input type='text' class='form-control' placeholder='Month' name='month' value='DECEMBER'  required>
                                                 </div>";
                                        $_SESSION['day']=$day;
                                        $_SESSION['year']=$year;
                                        break;
                                    default:
                                        echo "Month not recognized.";
                                        break;
                                }
                                ?>


                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Check if successAlert session variable is set
        <?php if (isset($_SESSION['successAlert']) && $_SESSION['successAlert']) { ?>
        var alertContainer = document.getElementById("alertContainer");
        var successAlertHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Request sent successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
        alertContainer.innerHTML = successAlertHTML;
        <?php
        // Clear the successAlert session variable
        unset($_SESSION['successAlert']);
        }
        ?>

        // Check if duplicateRequest session variable is set
        <?php if (isset($_SESSION['duplicateRequest']) && $_SESSION['duplicateRequest']) { ?>
        var alertContainer = document.getElementById("alertContainer");
        var duplicateAlertHTML = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Request already sent!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
        alertContainer.innerHTML = duplicateAlertHTML;
        <?php
        // Clear the duplicateRequest session variable
        unset($_SESSION['duplicateRequest']);
        }
        ?>
    });
</script>


<script src="../../Assets/js/bootstrap.bundle.min.js"></script>
<script src="../../Assets/js/perfect-scrollbar.min.js"></script>
<script src="../../Assets/js/smooth-scrollbar.min.js"></script>
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