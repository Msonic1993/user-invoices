<?php

declare(strict_types=1);

namespace App\Core\User\Infrastructure\Message;

use App\Common\Mailer\MailerInterface;
use App\Core\User\Domain\Exception\EmailMessageException;
use App\Core\User\Domain\Message\EmailMessageInterface;

class Messenger implements MailerInterface, EmailMessageInterface
{
    public function send(string $recipient, string $subject, string $message): void
    {
        if (!strpos($recipient, '@')) {
            throw new EmailMessageException('Email pattern is not valid. Email message cannot be sent');
        }

        echo sprintf('Email do użytkownika %s został wysłany', $recipient);
    }
}