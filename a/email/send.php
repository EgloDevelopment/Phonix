<?php
error_reporting(0);
session_start();
include('../../resources/headers/header.php');
?>

<body>
    <div class="space">
        <div style="width: 80%">
            <form action="" method="POST">
                <input type="email" name="to" class="form-control" placeholder="Recipient email" value="<?php echo $_GET['e'] ?>" required>
                <br>
                <input type="text" name="name" class="form-control" placeholder="Recipient name" value="<?php echo $_GET['n'] ?>">
                <br>
                <input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo $_GET['s'] ?>" required>
                <br>
                <textarea name="body" class="form-control" placeholder="Message"></textarea>
                <br>
                <input type="submit" id="center" class="btn btn-outline-primary" value="Send">
            </form>
        </div>
    </div>
</body>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../../resources/DB/config.php');
    require '../../resources/PHPMailer/src/Exception.php';
    require '../../resources/PHPMailer/src/PHPMailer.php';
    require '../../resources/PHPMailer/src/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $host = $_SESSION['smtp-url'];
        $username = $_SESSION['smtp-username'];
        $password = $_SESSION['smtp-password'];
        $port = $_SESSION['smtp-port'];

        $mail->isSMTP();
        $mail->Host = "$host";
        $mail->SMTPAuth = true;
        $mail->Username = "$username";
        $mail->Password = "$password";
        $mail->SMTPSecure = "starttls";
        $mail->Port = $port;
        $mail->CharSet = 'UTF-8';


        $email = $_SESSION['phonix-email'];
        $name = $_SESSION['name'];

        $sendto1 = $_POST['to'];
        $sendto = clear($sendto1);
        $sendname1 = $_POST['name'];
        $sendname = clear($sendname1);
        $subject1 = $_POST['subject'];
        $subject = clear($subject1);
        $body1 = $_POST['body'];
        $body = clear($body1);
        $string = getString(20);
        //Recipients
        $mail->setFrom("$email", "$name");
        $mail->addAddress("$sendto", "$sendname");
        $mail->addReplyTo("$email", "$name");


        //Content
        $mail->isHTML(true);
        $mail->Subject = "$subject";
        $mail->Body    = "$body";

        $mail->send();
        $sql = "INSERT INTO `sent`(`fromaddress`, `toaddress`, `uid`) VALUES ('$email', '$sendto', '$string')";

        if ($conn->query($sql) === TRUE) {
            echo '';
        } else {
            echo 'Error with database, contact admin.';
            return;
        }
        echo '<div class="space"><p>Message has been sent.</p></div>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>