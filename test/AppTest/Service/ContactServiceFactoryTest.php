<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\ContactService;
use App\Service\Factory\ContactServiceFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContactServiceFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = require "./config/container.php";
    }

    public function testContactServiceFactory()
    {
        $factory = new ContactServiceFactory();

        $this->assertInstanceOf(ContactServiceFactory::class, $factory);

        $contactService = $factory($this->container);

        $this->assertInstanceOf(ContactService::class, $contactService);
    }
}
