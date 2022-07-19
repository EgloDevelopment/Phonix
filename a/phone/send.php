<?php
error_reporting(0);
session_start();
include('../../resources/headers/header.php');
?>

<body>
    <div class="space">
        <div style="width: 80%">
            <form action="" method="POST">
                <input type="phone" name="to" class="form-control" placeholder="Enter recipient phone number" value="<?php echo $_GET['n']; ?>" required>
                <br>
                <textarea name="body" class="form-control" placeholder="Message" required></textarea>
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
        $body1 = $_POST['body'];
        $body = clear($body1);
        $string = getString(20);

        //Recipients
        $mail->setFrom("$email", "$name");
        $mail->addAddress("$sendto@mms.att.net", "$sendname");
        $mail->AddBcc("$sendto@message.alltel.com", "$sendname");
        $mail->AddBcc("$sendto@messaging.nextel.com", "$sendname");
        $mail->AddBcc("$sendto@messaging.sprintpcs.com", "$sendname");
        $mail->AddBcc("$sendto@tms.suncom.com", "$sendname");
        $mail->AddBcc("$sendto@tmomail.net", "$sendname");
        $mail->AddBcc("$sendto@voicestream.net", "$sendname");
        $mail->AddBcc("$sendto@vtext.com", "$sendname");
        $mail->AddBcc("$sendto@msg.fi.google.com", "$sendname");
        $mail->AddBcc("$sendto@text.republicwireless.com", "$sendname");
        $mail->AddBcc("$sendto@message.ting.com", "$sendname");
        $mail->AddBcc("$sendto@email.uscc.net", "$sendname");
        $mail->AddBcc("$sendto@vmobl.com", "$sendname");
        $mail->addReplyTo("$email", "$name");


        //Content
        $mail->isHTML(false);
        $mail->Subject = "$subject";
        $mail->Body    = "$body";

        $mail->send();
        $sql = "INSERT INTO `phone`(`tonumber`, `fromaddress`, `uid`) VALUES ('$sendto', '$email', '$string')";

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