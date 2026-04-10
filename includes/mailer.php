<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 1. Load Composer (Only if not already loaded)
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * We don't load Dotenv here globally because this file is usually 
 * included in other scripts that already have config.php (and thus Dotenv) loaded.
 * However, we keep a safety check inside the function.
 */

function sendStatusEmail($recipientEmail, $recipientName, $status, $trackingNo) {
    // 2. Safety Check: If $_ENV is empty, load Dotenv manually
    if (!isset($_ENV['SMTP_EMAIL']) && file_exists(__DIR__ . '/../.env')) {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        
        $mail->Username   = $_ENV['SMTP_EMAIL'] ?? ''; 
        $mail->Password   = $_ENV['SMTP_PASS'] ?? ''; 
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($_ENV['SMTP_EMAIL'], 'Brgy. Old Poblacion');
        $mail->addAddress($recipientEmail, $recipientName);

        $mail->isHTML(true);
        $mail->Subject = "Update: Clearance Request #$trackingNo";
        $mail->Body    = "
            <div style='font-family: sans-serif; color: #333; max-width: 600px; margin: auto; border: 1px solid #eee; padding: 20px; border-radius: 15px;'>
                <h2 style='color: #2563eb; margin-top: 0;'>Clearance Status Update</h2>
                <p>Hello <b>$recipientName</b>,</p>
                <p>Your request with tracking number <b style='color: #2563eb;'>$trackingNo</b> is now <b>$status</b>.</p>
                <p>Log in to the portal to check further details or visit the Barangay Hall for verification.</p>
                <hr style='border:none; border-top:1px solid #eee; margin: 20px 0;'>
                <small style='color: #94a3b8; display: block; text-align: center;'>This is an automated message from Brgy. Old Poblacion. Please do not reply.</small>
            </div>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Optional: error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}