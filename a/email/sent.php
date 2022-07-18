<?php
error_reporting(0);
session_start();
include('../../resources/headers/header.php');
?>

<body>

    <div class="space">

        <?php
        $owner = $_SESSION['phonix-email'];
        require_once('../../resources/DB/config.php');


        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM sent WHERE fromaddress = '$owner'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $from = $row['fromaddress'];
                $to = $row['toaddress'];
                $time = $row['time'];
                $uid = $row['uid'];
                echo "<b>From:</b> $from";
                echo "<br>";
                echo "<b>To:</b> $to";
                echo "<br>";
                echo "<b>Time:</b> $time";
                echo "<br>";
                echo "<b>ID:</b> $uid";
                echo "<hr style='width: 20%'>";
            }
        } else {
            echo "No messages have been sent.";
        }
        ?>
    </div>