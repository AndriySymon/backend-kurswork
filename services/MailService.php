<?php

namespace services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService{
    private $mailer;

    public function __construct(){
        $this->mailer = new PHPMailer(true);

        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'ipz235_sag@student.ztu.edu.ua'; 
        $this->mailer->Password = 'bimb glyt ifen ffmm'; 
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;

        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->Encoding = 'base64';

        $this->mailer->setFrom('ipz235_sag@student.ztu.edu.ua', 'Симон Андрій');
        $this->mailer->addAddress('ipz235_sag@student.ztu.edu.ua');
    }
    public function sendOrderEmail($firstName, $lastName, $email, $phone, $city, $address, $items, $totalPrice){
        $body = "Нове замовлення від {$firstName} {$lastName}\n";
        $body .= "Email: {$email}\nМісто: {$city}\nАдреса: {$address}\nНомер телефону: {$phone}\n\n";
        $body .= "Список товарів:\n";

        foreach($items as $item){
            $body .= "- {$item['name']} (x{$item['quantity']}) - {$item['price']} грн\n";
        }

        $body .= "\nЗагальна сума: {$totalPrice} грн\n";

        $this->mailer->Subject = 'Нове замовлення';
        $this->mailer->Body = $body;

        try {
            $this->mailer->send();
            return true;
        } catch (Exception $e){
            error_log("Помилка при надсиланні email: " . $this->mailer->ErrorInfo);
            return false;
        }
    }
    public function sendCancelOrderEmail($orderId, $userEmail, $userName, $userPhone){
        $this->mailer->Subject = "Скасування замовлення №{$orderId}";
        $body = "
            <h2>Замовлення скасоване</h2>
            <p><strong>Користувач: </strong> {$userName}</p>
            <p><strong>Email: </strong>{$userEmail}</p>
            <p><strong>Номер телефону: </strong>{$userPhone}</p>
            <p><strong>Номер замовлення: </strong>{$orderId}</p>
            <p>Замовлення було скасоване користувачем.</p>
        ";

        $this->mailer->isHTML(true);
        $this->mailer->Body = $body;

        $this->mailer->send();
    }
}