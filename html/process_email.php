<?php
session_start();

if (isset($_POST['clear_session'])) {
    session_unset();
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Session cleared!'];
    header("Location: index.php");
    exit();
}

require '../../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $smtp_host = $_POST["smtp_host"];
    $smtp_port = $_POST["smtp_port"];
    $smtp_username = $_POST["smtp_username"];
    $smtp_password = $_POST["smtp_password"];
    $to_email = $_POST["to_email"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];

    // Store form data in session
    $_SESSION['form_data'] = $_POST;

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_username;
        $mail->Password   = $smtp_password;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtp_port;

        //Recipients
        $mail->setFrom($smtp_username, 'PHP Mailer');
        $mail->addAddress($to_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        // echo '<pre>';
        // var_dump($mail);
        // echo '</pre>';

        $mail->send();
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Email sent successfully!'];
    } catch (Exception $e) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Email could not be sent. Error: ' . $mail->ErrorInfo];
    }

    header("Location: index.php"); // Redirect back to the form
    exit();
} else {
    // If someone tries to access this file directly
    header("Location: index.php");
    exit();
}
?>