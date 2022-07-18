<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header.php');
?>

<body>

    <div class="space">

        <?php
        $uid = $_POST['uid'];
        require_once('../../../resources/DB/config.php');


        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM `spam` WHERE uid = '$uid'";

        if ($conn->query($sql) === TRUE) {
            echo '<script>window.location.href = "../login";</script>';
        } else {
            echo 'Error with database, contact admin.';
        }
        ?>
    </div>