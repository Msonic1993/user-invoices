<?php

namespace App\Core\User\Domain\Message;

interface EmailMessageInterface
{
    public function send(string $recipient, string $subject, string $message): void;
}