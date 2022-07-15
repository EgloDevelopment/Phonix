<?php
session_start();
include('../../../resources/headers/header.php');
?>



<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require '../../../resources/PHPMailer/src/Exception.php';
require '../../../resources/PHPMailer/src/PHPMailer.php';
require '../../../resources/PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

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


    $email = $_SESSION['email'];
    $name = $_SESSION['name'];

    $sendto = $_POST['to'];
    $sendname = $_POST['name'];
    //Recipients
    $mail->setFrom('eglo@courvix.com', "$email | $name");
    $mail->addAddress("$sendto", "$sendname");
    $mail->addReplyTo("$email", "$name");


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>