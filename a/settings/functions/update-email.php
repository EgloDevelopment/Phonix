<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header.php');
?>

<body>

    <div class="space">

        <?php

        $email1 = clear($_POST['newemail1']);
        $email2 = clear($_POST['newemail2']);
        $id = $_SESSION['id'];

        if ($email1 === $email2) {

            require_once('../../../resources/DB/config.php');


            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE `users` SET `email`='$email1' WHERE id = '$id'";

            if ($conn->query($sql) === TRUE) {
                echo '<script>window.location.href = "../../../a/logout";</script>';
            } else {
                echo 'Error with database, contact admin.';
            }
        } else {
            echo 'Names do not match.';
            return;
        }
        ?>
    </div>