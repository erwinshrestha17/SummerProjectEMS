<!-- php script start -->
<?php
//include('../DatabaseConnection/databaseconnections.php');
$email="";
$password="";
$email_err = $pass_err = $login_Err = "";


if( $_SERVER["REQUEST_METHOD"] === "POST" ) {

    if (empty($_POST["email"])) {
        $email_err = " <p> * Email Can Not Be Empty</p> ";
    } else {
        $email = $_REQUEST["email"];
    }

    if (empty($_POST["password"])) {
        $pass_err = " <p > * Password Can Not Be Empty</p> ";
    } else {
        // Decrypting hash


       // $dbPassword = $rows['password'];
        $password = $_REQUEST["password"];
       // $password_decoded = password_verify($password,$dbPassword);
        //pg_close($conn);
    }

    if( !empty($email) && !empty($password) ){

        $host        = "host = 127.0.0.1";
        $port        = "port = 5432";
        $dbname      = "dbname = emsdb";
        $credentials = "user = postgres password=admin";

        $conn = pg_connect( "$host $port $dbname $credentials"  );
        if(!isset($conn)){
            echo die("Database connection failed");
        }


        $sql = <<<EOF
            SELECT * FROM adminlogin where email='$email' and password='$password'
        EOF;
        $result = pg_query( $conn , $sql);
        if ( pg_num_rows($result) > 0 ){
            while( $rows = pg_fetch_assoc($result) ){
                session_start();
                session_unset();
                $_SESSION['authenticated']= true;
                $_SESSION['id'] =$rows['id'];
                $_SESSION['email'] = $rows['email'];
                $_SESSION['username'] = $rows['username'];
                $_SESSION['fullname'] = $rows['fullname'];
                $_SESSION['role']=$rows['position'];
                $_SESSION['branch']=$rows['organization'];

                header("Location: ../Dashboards/AdminDashboard.php");
            }
        }else{
            $login_Err = "<div class='alert alert-danger alert-dismissible fade show'>
            
            <strong style='text-decoration-color: white'>Invalid Email/Password</strong>
            <button type='submit' class='btn-close bg-gradient-primary' data-dismiss='alert'  >
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
        pg_close($conn);


    }


}

?>
<!-- php script end -->
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Admin Sign IN
    </title>
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
    <!-- CSS Files -->
    <link id="pagestyle" href="../Assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="sign-in-basic">
<!-- Navbar Transparent -->
<!-- End Navbar -->
<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0"> Sign in</h4>
                            <div class="text-center my-5"> <?php echo $login_Err; ?> </div>
                            <div class="row mt-3">
                                <div class="col-2 text-center ms-auto">
                                    <a class="btn btn-link px-3" href="javascript:;">
                                        <i class="fa fa-facebook text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center px-1">
                                    <a class="btn btn-link px-3" href="javascript:;">
                                        <i class="fa fa-github text-white text-lg"></i>
                                    </a>
                                </div>
                                <div class="col-2 text-center me-auto">
                                    <a class="btn btn-link px-3" href="javascript:;">
                                        <i class="fa fa-google text-white text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form role="form" class="text-start" method="post" action="">
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo  $email?>">
                            </div>
                            <?php echo $email_err?>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control " id="password" name="password" value="<?php echo $password ?>" aria-describedby="basic-addon1">
                                <div class="input-group-append ">
                                     <span class="input-group-text pe-1 " onclick="password_show_hide();">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </span>
                                </div>
                            </div>
                            <?php echo $pass_err?>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                            </div>
                            <p class=" mt-4 text-sm text center">Not an admin? <a href="../../../Employees/Pages/Login-Logout/EmployeesLogin.php" class="text-primary">Log-In </a>as Employee now</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../Assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../Assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../Assets/js/plugins/perfect-scrollbar.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="../Assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>
</body>
</html>