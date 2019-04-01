<?php

declare(strict_types=1);

namespace App;

use App\Handler\ContactPageHandler;
use App\Handler\Factory\ContactPageHandlerFactory;
use App\Listener\Factory\SendEmailEventListenerFactory;
use App\Listener\SendEmailEventListener;
use App\Service\ContactService;
use App\Service\Factory\ContactServiceFactory;
use App\Service\Factory\FileServiceFactory;
use App\Service\FileService;
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\MongoDB\Configuration;
use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Helderjs\Component\DoctrineMongoODM\AnnotationDriverFactory;
use Helderjs\Component\DoctrineMongoODM\ConfigurationFactory;
use Helderjs\Component\DoctrineMongoODM\ConnectionFactory;
use Helderjs\Component\DoctrineMongoODM\DocumentManagerFactory;
use Helderjs\Component\DoctrineMongoODM\EventManagerFactory;
use Helderjs\Component\DoctrineMongoODM\MappingDriverChainFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        $this->registryAnnotations();

        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                \Doctrine\Common\Cache\ArrayCache::class => \Doctrine\Common\Cache\ArrayCache::class,
            ],
            'factories'  => [
                Configuration::class   => ConfigurationFactory::class,
                Connection::class => ConnectionFactory::class,
                EventManager::class => EventManagerFactory::class,
                DocumentManager::class => DocumentManagerFactory::class,
                AnnotationDriver::class => AnnotationDriverFactory::class,
                MappingDriverChain::class => MappingDriverChainFactory::class,

//                HANDLES
                ContactPageHandler::class => ContactPageHandlerFactory::class,

//                SERVICES
                ContactService::class => ContactServiceFactory::class,
                FileService::class => FileServiceFactory::class,


                \Zend\EventManager\EventManager::class => \Zend\Mvc\Service\EventManagerFactory::class,
                SendEmailEventListener::class => SendEmailEventListenerFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }

    private function registryAnnotations()
    {
        AnnotationDriver::registerAnnotationClasses();
    }
}
