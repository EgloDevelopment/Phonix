<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header.php');
?>

<body>

    <div class="space">

        <?php

        $password1 = clear($_POST['newpass1']);
        $password2 = clear($_POST['newpass2']);
        $id = $_SESSION['id'];

        if ($password1 === $password2) {
            $hashedpassword = password_hash($password1, PASSWORD_DEFAULT);
        } else {
            echo 'Passwords do not match.';
            return;
        }


        require_once('../../../resources/DB/config.php');


        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `users` SET `password`='$hashedpassword' WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>window.location.href = "../../../a/settings";</script>';
        } else {
            echo 'Error with database, contact admin.';
        }
        ?>
    </div>