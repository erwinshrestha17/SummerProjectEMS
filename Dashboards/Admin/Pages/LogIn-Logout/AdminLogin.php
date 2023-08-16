<!-- php script start -->
<?php

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
        $password = $_REQUEST["password"];
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
SELECT * FROM admin where email='$email' and password='$password'
EOF;
        $result = pg_query( $conn , $sql);
        if ( pg_num_rows($result) > 0 ){
            while( $rows = pg_fetch_assoc($result) ){
                session_start();
                session_unset();
                $_SESSION['authenticated']= true;
                $_SESSION["email"] = $rows["email"];
                header("Location: ../Dashboards/AdminDashboard.php");
            }
        }else{
            $login_Err = "<div class='alert alert-warning alert-dismissible fade show'>
            <strong>Invalid Email/Password</strong>
            <button type='button' class='close' data-dismiss='alert' >
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
        pg_close($conn);


    }


    }

?>
<!-- php script end -->


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="../Assets/css/style.css" rel="stylesheet">

    <title>Admin LogIn</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg {
            background-image: url("../../../background.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

    </style>
</head>
<body >



<div class="bg">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">

                                <h4 class="text-center">Hello, Admin</h4>
                                <div class="text-center my-5"> <?php echo $login_Err; ?> </div>

                                <form method="POST" action="">

                                    <div class="form-group">
                                        <label >Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                        <?php echo $email_err; ?>
                                    </div>

                                    <div class="form-group">
                                        <label >Password :</label>
                                        <input type="password" class="form-control" name="password" >
                                        <?php echo $pass_err; ?>

                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Log-In" class="btn btn-primary btn-lg w-100 " name="signin" >
                                    </div>
                                    <p class=" login-form__footer">Not an admin? <a href="../../../Employees/EmployeesLogin.php" class="text-primary">Log-In </a>as Employee now</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../Assets/plugins/common/common.min.js"></script>
<script src="../Assets/js/custom.min.js"></script>
<script src="../Assets/js/settings.js"></script>
<script src="../Assets/js/gleek.js"></script>
<script src="../Assets/js/styleSwitcher.js"></script>


</body>
</html>