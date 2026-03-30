<?php
namespace Kernel\Email;

use Kernel\Email\Interface\EmailInterface;

class Email
{
    private EmailInterface $driver;

    private string $to;
    private string $subject;
    private string $body;

    public function __construct(EmailInterface $driver)
    {
        $this->driver = $driver;
    }

    public function to(string $email): self
    {
        $this->to = $email;
        return $this;
    }

    public function subject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    public function body(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function send(): bool
    {
        return $this->driver->send(
            $this->to,
            $this->subject,
            $this->body
        );
    }
}