<?php
session_start();
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailAddress = $_POST['email'];
    $imagePath    = $_POST['generated_path'];
    $language     = $_POST['language'];
    $mail = new PHPMailer(true);
    try {
        // SMTP CONFIG
        $mail->isSMTP();
        $mail->Host       = 'email-smtp.us-east-1.amazonaws.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'AKIAUBZLK7TSJEKXM2MI';
        $mail->Password   = 'BBc2gUUwlL5AJDpi+1AwAd1S69suROYIW28hQmlPebfP';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // FROM + TO
        $mail->setFrom('odslabs@option1world.com', 'Adib Ai Photo');
        $mail->addAddress($emailAddress);
        // SUBJECT
        $mail->Subject = "ADIB National Day AI Photo";
        // EMAIL BODY BASED ON LANGUAGE
        if ($language === 'ar') {
            $message = "
            <html>
            <head><title>نتيجة الصورة بواسطة الذكاء الاصطناعي</title></head>
            <body>
                <h1>مرحباً!</h1>
                <p>شكراً لحضوركم فعالية اليوم الوطني لمصرف أبوظبي الإسلامي. مرفق، يرجى العثور على صورتك التي تم إنشاؤها بواسطة الذكاء الاصطناعي.</p>
                <img src='{$imagePath}' alt='الصورة'>
                <p>أطيب التحيات,<br><b>ADIB</b></p>
            </body>
            </html>";
        } else {
            $message = "
            <html>
            <head><title>AI Image Result</title></head>
            <body>
                <h1>Hello!</h1>
                <p>Thank you for attending the ADIB National Day event. Attached, please find your AI-generated photo.</p>
                <img src='{$imagePath}' alt='Image'>
                <p>Best Regards,<br><b>ADIB</b></p>
            </body>
            </html>";
        }
        $mail->isHTML(true);
        $mail->Body = $message;
        // SEND EMAIL
        if ($mail->send()) {
            echo "Email successfully sent!";
            header("Location: index.php");
            exit;
        } else {
            echo "Email failed to send!";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
