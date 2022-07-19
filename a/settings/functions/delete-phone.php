<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header.php');
?>

<body>

    <div class="space">

        <?php
        $email = $_SESSION['phonix-email'];

        require_once('../../../resources/DB/config.php');


        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT uid FROM phone WHERE fromaddress = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $uid = $row['uid'];
                $sql = "DELETE FROM `phone` WHERE uid = '$uid'";
                $conn->query($sql);
            }
            $conn->close();
            sleep(1);
            echo '<script>window.location.href = "../../../a/settings";</script>';
        } else {
            echo 'Error';
            $conn->close();
        }
        ?>
    </div>