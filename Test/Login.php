<html>
<head>
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body{
            background-color:#edede9 ;
        }
        h3{
            align-content: center;
        }
        .Card{
            padding: 40px;
            background-color: #F3FFEB;
            max-width: 360px;
            border-radius: 20px;
            margin: 60px auto;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;;
        }
    </style>
</head>
<body>
<section class="Card">
    <form action="Admin/AdminDashboard.php" method="post" onsubmit="validateEmail()">
        <div class="form-group">
            <h3>Admin Log In</h3>
        </div>
        <br>

        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Select Your Department</option>
                <option value="1">Admin</option>
                <option value="2">Managers</option>
            </select>
        </div>

        <br>

        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" >
        </div>
        <br>

        <div class="form-group">
            <label for="exampleInputPassword1"></label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="Password" ">
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
            <label class="form-check-label" for="flexCheckChecked">
                Remember me
            </label>
        </div>
        <br>

        <button type="submit" class="btn btn-primary"">Log In </button>
    </form>

</section>
<script>
    const email = document.getElementById('exampleInputEmail1').value;
    const password = document.getElementById('exampleInputPassword1').value;

    function validateEmail(){
        const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        /*if (email.value.match(validRegex)) {
            alert("Valid email address!");
            return true;
        } else {
            alert("Invalid email address!");
            return false;
        }

         */

        return validRegex.test(email)
    }
</script>
</body>
</html>



