<?php

namespace Classes;

require_once __DIR__ . "/Connection.php";
require __DIR__ . "/../../vendor/autoload.php";

use PDO;
use PDOException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Emails extends Connection
{

    public function generateOrderToken()
    {
        return strtoupper(bin2hex(random_bytes(4)));
    }

    public function insert($email, $number)
    {
        $token = $this->generateOrderToken();
        try {
            $stmt = $this->getPdo()->prepare("UPDATE users SET device_token=:token WHERE mobile = :number");
    
            $stmt->bindParam(':number', $number, \PDO::PARAM_INT);
            $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
            $user = $stmt->execute();
    
            if($user){
                $this->change($email, $token);
            }
        } catch (\PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            throw new Exception("An error occurred. Please try again later.");
        }
    }
    
    public function change($email, $token)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address format: $email");
        }
    
        $mail = new PHPMailer(true);
    
        // PHPMailer settings
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
    
        $mail->Username   = 'pentest840@gmail.com';
        $mail->Password   = 'fsknccytyhayzofj';
    
        $mail->setFrom('pentest840@gmail.com');
        $mail->addAddress($email);
    
        $mail->isHTML(true);
        $mail->Subject = 'ZLCollection Support';
        $mail->Body    = "Hello $email,<br><br>Your code is: <strong>$token</strong><br><br>Best regards,<br>The Team";
        $mail->AltBody = "Hello,\n\nYour code is: $token\n\nBest regards,\nThe Team";
    
        $mail->send();
    }
    
    
}
