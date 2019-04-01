<?php

declare(strict_types=1);

namespace App\Service\Factory;

use App\Event\SendEmailEvent;
use App\Listener\SendEmailEventListener;
use App\Service\ContactService;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Container\ContainerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\LazyListener;

/**
 * Class ContactServiceFactory
 * @package App\Service\Factory
 */
class ContactServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return ContactService
     */
    public function __invoke(ContainerInterface $container): ContactService
    {
        /** @var DocumentManager $documentManager */
        $documentManager = $container->get(DocumentManager::class);

        /** @var EventManager $eventManager */
        $eventManager = $container->get(EventManager::class);

        $eventManager->addIdentifiers([SendEmailEventListener::class]);

        $lazyListener = new LazyListener([
            "listener" => SendEmailEventListener::class,
            "method" => "execute"
        ], $container);

        $eventManager->attach(SendEmailEvent::class, $lazyListener);

        return new ContactService($documentManager, $eventManager);
    }
}
