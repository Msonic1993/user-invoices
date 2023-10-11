<?php

declare(strict_types=1);

namespace App\Core\User\Infrastructure\Mail;

use App\Common\Mailer\MailerInterface;
use App\Core\User\Domain\Exception\EmailMessageException;
use App\Core\User\Domain\Message\EmailMessageInterface;

class Messenger implements MailerInterface, EmailMessageInterface
{
    private const VALID_EMAIL_PATTERN = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    public function send(string $recipient, string $subject, string $message): void
    {
        if (preg_match(self::VALID_EMAIL_PATTERN, $recipient)) {
            throw new EmailMessageException('Email pattern is not valid. Email message cannot be sent');
        }

        echo sprintf('Email do użytkownika %s został wysłany', $recipient);
    }
}