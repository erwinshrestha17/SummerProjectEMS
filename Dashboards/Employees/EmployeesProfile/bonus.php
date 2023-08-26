<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header('Location: ../LogIn-Logout/AdminLogin.php');
    exit;
}else{
    $adminID= $_SESSION['id'];
    $adminfullname="";
    $adminimage="";

    $host        = "host = 127.0.0.1";
    $port        = "port = 5432";
    $dbname      = "dbname = emsdb";
    $credentials = "user = postgres password=admin";
    $conn = pg_connect( "$host $port $dbname $credentials"  );
    if(!isset($conn)){
        echo die("Database connection failed");
    }

    // Employee All data
    $empID=$_SESSION['id'];
    $sql =<<<Eof
            SELECT * FROM employeeslist where employeesid=$empID;
    Eof;
    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
        //header('Location:employeesprofile.php');
        exit;
    }

    while ($let = pg_fetch_assoc($ret)) {
        $id = $let['employeesid'];
        $email = $let['email'];
        $position = $let['position'];
        $organization = $let['organization'];
        $salary = $let['salary'];
        $fullname= $let['fullname'];
        $phonenumber = $let['phonenumber'];
        $empimage=$let['image'];
    }


    // Admin Profile Image
    $query=<<<EOF
        SELECT * FROM adminlists WHERE adminid=$adminID;
EOF;
    $ret1 = pg_query($conn, $query);
    if(!$ret1) {
        echo pg_last_error($conn);
        exit;
    }

    while ($let = pg_fetch_assoc($ret1)) {
        $adminimage=$let['image'];
        $salary=$let['salary'];

    }
    pg_close($conn);
    $totalbonus = isset($_SESSION['totalbonus']);

}
?>

<!Doctype html>
<html lang="eng">
<head>
    <title>Bonus</title>
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Employee Profiles</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Profile</h6>
            </nav>
        </div>

        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline border-0">
                <a href='../EmployeesProfile/adminprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
                    <img src="../../Admin//Onboarding/img/<?php echo $empimage?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
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
                        <img   src="../../Admin/Onboarding/img/<?php echo $empimage ?>" class="w-100 border-radius-lg shadow-sm" width="130" height="60">
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
                                <a href='employeesprofile.php' class='text-secondary font-weight-bold text-xs' data-toggle='tooltip' data-original-title='Edit user' >
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

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Bonuses</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <?php
                                    $medical_allowance=$salary * 0.05;
                                    $stock =$salary*0.04;
                                    $transportation=$salary*0.03;
                                    $food=$salary*0.03;

                                    $totalbonus = $medical_allowance+$stock+$transportation+$food;
                                    $_SESSION['totalbonus']=$totalbonus;

                                ?>
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Earnings</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <div  class='d-flex flex-column justify-content-center'>
                                            <td><h6 class='mb-0 text-sm'>1</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Medical Allowance</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Rs <?php echo $medical_allowance;?></h6></td>
                                            <td><h6 class='mb-0 text-sm'></h6></td>

                                        </div>
                                    </tr>
                                    <tr>
                                        <div  class='d-flex flex-column justify-content-center'>
                                            <td><h6 class='mb-0 text-sm'>2</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Stock</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Rs <?php echo $stock  ?></h6></td>
                                            <td><h6 class='mb-0 text-sm'></h6></td>

                                        </div>
                                    </tr>
                                    <tr>
                                        <div  class='d-flex flex-column justify-content-center'>
                                            <td><h6 class='mb-0 text-sm'>3</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Food</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Rs <?php echo $food  ?></h6></td>
                                            <td><h6 class='mb-0 text-sm'></h6></td>

                                        </div>
                                    </tr>
                                    <tr>
                                        <div  class='d-flex flex-column justify-content-center'>
                                            <td><h6 class='mb-0 text-sm'>4</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Transportation</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Rs <?php echo $transportation;?> </h6></td>
                                            <td><h6 class='mb-0 text-sm'></h6></td>

                                        </div>
                                    </tr>
                                    <tr>
                                        <div  class='d-flex flex-column justify-content-center'>
                                            <td><h6 class='mb-0 text-sm'>5</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Total</h6></td>
                                            <td><h6 class='mb-0 text-sm'>Rs <?php echo $totalbonus;?> </h6></td>
                                            <td><h6 class='mb-0 text-sm'></h6></td>

                                        </div>
                                    </tr>
                                    <tbody>

                                    </tbody>
                                </table>
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