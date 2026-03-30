<?php

namespace Kernel\Email\Drivers;

use Kernel\Email\Interface\EmailInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SmtpEmail implements EmailInterface
{

    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function send(string $to, string $subject, string $body): bool
    {
        $mailer = new PHPMailer(true);

        try {
            $mailer->isSMTP();
            $mailer->Host = $this->config['host'];
            $mailer->SMTPAuth = true;
            $mailer->Username = $this->config['username'];
            $mailer->Password = $this->config['password'];
            $mailer->SMTPSecure = $this->config['encryption'] ?? 'tls';
            $mailer->Port = $this->config['port'];

            $mailer->setFrom(
                $this->config['from_address'],
                $this->config['from_name'] ?? 'App'
            );

            $mailer->addAddress($to);
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $body;

            return $mailer->send();

        } catch (Exception $e) {
            // log error if needed
            throw new \Exception($e->getMessage());
        }
    }
}