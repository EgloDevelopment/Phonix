<?php
session_start();
include('../resources/headers/header-no-secure.php');
error_reporting(0);

if ($_SESSION['logged-in'] == 'true') {
    echo '<script>window.location.href = "../../";</script>';
} else {
    echo '';
}

?>

<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h1 class="center">Login</h1>
                <br>
                <form action="" method="POST">
                    <input type="username" class="form-control" name="email" placeholder="Email">
                    <br>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <br>
                    <div class="center">
                        <button type="submit" class="btn btn-outline-primary">Login</button>
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

    $email = $_POST['email'];
    $escemail = clear("$email");

    $password = $_POST['password'];
    $escpassword = clear("$password");


    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT id, email, password FROM users WHERE email = '$escemail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $dbemail = $row["email"];
            $dbpassword = $row["password"];
        }
    } else {
        echo 'Account does not exist.';
    }
    //$isPasswordCorrect = password_verify($escpassword, $dbpassword);
    if ($dbemail == $escemail) {
        if (password_verify($escpassword, $dbpassword)) {
            $sql = "SELECT * FROM users WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dbpassword = 'Password';
                    $_SESSION['logged-in'] = 'true';
                    $_SESSION['id'] = $row["id"];
                    $_SESSION['email'] = $row["email"];
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['owner-id'] = $row["ownerid"];
                    $_SESSION['2fa'] = $row['2fa'];
                    $_SESSION['last-login'] = $row["lastlogin"];
                    $_SESSION['account-created'] = $row["created"];
                }

                $sql = "SELECT * FROM settings";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['smtp-url'] = $row["smtpurl"];
                        $_SESSION['smtp-port'] = $row["smtpport"];
                        $_SESSION['smtp-username'] = $row["smtpusername"];
                        $_SESSION['smtp-password'] = $row['smtppassword'];
                    }    

                } else {
                    echo 'SMTP settings are not set.';
                }
            } else {
                echo 'Wrong username or password.';
            }
        } else {
            echo 'Wrong username or password.';
        }
    }
    $conn->close();
}



    ?>
