<?php

declare(strict_types=1);

namespace App\Core\User\Application\EventSubscriber;

use App\Core\User\Domain\Event\UserCreatedEvent;
use App\Core\User\Domain\Exception\EmailMessageException;
use App\Core\User\Domain\Message\EmailMessageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCreatedSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly EmailMessageInterface $message, private readonly LoggerInterface $logger)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::class => 'onUserCreated',
        ];
    }

    public function onUserCreated(UserCreatedEvent $event): void
    {
        try {
            $this->message->send(
                $event->user->getEmail(),
                'Zarejestrowano nowe konto',
                'Zarejestrowano konto w systemie. Aktywacja konta trwa do 24h'
            );
        } catch (EmailMessageException $e) {
            $this->logger->error(sprintf('Adres email %s jest błędny. Wiadomość nie została wysłana', $event->user->getEmail()));
        }
    }
}