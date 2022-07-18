<?php
error_reporting(0);
session_start();
include('resources/headers/header.php');
?>

<body>

    <div class="top-space">
        <div class="center">
            <h1>Welcome, <?php echo $_SESSION['name'] ?></h1>
            <p>Where do you want to go?</p>
            <br>
            <a href="a/email" class="btn btn-primary">Email</a>
            <a href="a/phone" class="btn btn-primary">Phone</a>
            <br>
            <br>
            <a href="a/logout" class="btn btn-outline-danger">Logout</a>
        </div>
    </div>

</body>