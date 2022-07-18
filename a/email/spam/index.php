<?php
error_reporting(0);
session_start();
include('../../../resources/headers/header-no-fade.php');
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../../../a/email">Inbox</a>
                    </li>
                    <li class="nav-item">
                        <form action="../../../a/email/spam" method="POST">
                            <a class="nav-link" href="javascript:;" onclick="parentNode.submit();">Spam</a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="../../../a/email" method="POST">
                            <input type="hidden" name="action" value="sent">
                            <a class="nav-link" href="javascript:;" onclick="parentNode.submit();">Sent</a>
                        </form>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="../../../a/email" method="POST">
                    <input type="hidden" name="action" value="send">
                    <button class="btn btn-outline-success" type="submit">Send</button>
                </form>
            </div>
        </div>
    </nav>
    <div style="width: 100%; height: 15px;"></div>

    <?php
    $owner = $_SESSION['phonix-email'];
    require_once('../../../resources/DB/config.php');


    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM spam WHERE owner ='$owner'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $uid = $row['uid'];
            $from = $row['fromaddress'];
            $subject = $row['subject'];
            $body = $row['body'];
            echo "<form action='' method='POST'><div class='email-list' onclick='parentNode.submit();'>";
            $name = strtok($from, '|');
            echo "<input type='hidden' name='action' value='view'>";
            echo "<input type='hidden' name='uid' value='$uid'>";
            echo "<h6 class='email-list-space'>$name</h6>";
            echo "<h7 class='email-list-space'>$subject</h7>";
            echo "<hr style='height: 1px;'>";
            echo "</div></form>";
        }
    } else {
        echo '<div style="margin-left: 10px;"><p>No spam.</p></div>';
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['action'] == 'view') {
            $posteduid = $_POST['uid'];
            echo "<iframe src='../../../a/email/spam/view.php?uid=$posteduid' style='width:80%; margin-left: 20%; height:100%; border-left: 1px solid black; z-index: 999; position:fixed; top:50px; left:0; bottom:0; right:0;'>
  Your browser does not support the viewer.</iframe>";
        } else {
            echo "<iframe src='../../../a/email/view.php' style='width:80%; margin-left: 20%; height:100%; border-left: 1px solid black; z-index: 999; position:fixed; top:50px; left:0; bottom:0; right:0; '>
    Your browser does not support the viewer.</iframe>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>