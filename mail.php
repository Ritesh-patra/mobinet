<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $phoneModel = $_POST['phoneModel'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';            // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'patrasagarika654@gmail.com';  // Your Gmail
        $mail->Password = 'your-app-password';     // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $fullName);
        $mail->addAddress('patrasagarika654@gmail.com'); // Receiver Email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Quote Request from ' . $fullName;
        $mail->Body    = "
            <h2>New Mobile Quote Request</h2>
            <p><strong>Name:</strong> {$fullName}</p>
            <p><strong>Mobile Number:</strong> {$mobile}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone Model:</strong> {$phoneModel}</p>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
