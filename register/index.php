<?php

session_start();
include('../resources/headers/header-no-secure.php');
error_reporting(0);

if ($_SESSION['logged-in'] == 'true') {
    echo '<script>window.location.href = "../";</script>';
} else {
    echo '';
}
?>

<body>

    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h1 class="center">Register</h1>
                <br>
                <form action="" method="POST">
                    <input type="username" class="form-control" name="email" placeholder="Email">
                    <br>
                    <input type="username" class="form-control" name="name" placeholder="Name">
                    <br>
                    <input type="password" class="form-control" name="password1" placeholder="Password">
                    <br>
                    <input type="password" class="form-control" name="password2" placeholder="Confirm password">
                    <br>
                    <div class="center">
                        <button type="submit" class="btn btn-outline-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../resources/DB/config.php');

    $ownerid = getString(20);

    $email = $_POST['email'];
    $escemail = clear("$email");

    $name = $_POST['name'];
    $escname = clear("$name");

    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $escpassword = clear("$password1");

    if ($password1 == $password2) {
        $hashedpassword = password_hash($escpassword, PASSWORD_DEFAULT);
    } else {
        echo 'Passwords do not match.';
        return;
    }

    if (strlen($password1) >= '6') {
        echo '';
    } else {
        echo 'Password is too short. Must be 6 characters.';
        return;
    }



    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT email FROM users WHERE email = '$escemail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['register-action'] = 'email-exists';
    } else {
        $sql = "INSERT INTO `users`(`email`, `name`, `password`, `ownerid`, `2fa`, `lastlogin`) VALUES ('$escemail', '$escname','$hashedpassword','$ownerid','1', 'first-login')";

        if ($conn->query($sql) === TRUE) {
            echo 'Account created.';
        } else {
            echo 'Error with database, contact admin.';
        }
    }

}
    ?>
