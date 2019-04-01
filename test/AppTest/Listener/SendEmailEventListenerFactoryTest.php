<?php

declare(strict_types=1);

namespace AppTest\Listener;

use App\Listener\Factory\SendEmailEventListenerFactory;
use App\Listener\SendEmailEventListener;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class SendEmailEventListenerFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = require "./config/container.php";
    }

    public function testSendEmailListenerFactory()
    {
        $factory = new SendEmailEventListenerFactory();

        $this->assertInstanceOf(SendEmailEventListenerFactory::class, $factory);

        $sendEmailListener = $factory($this->container);

        $this->assertInstanceOf(SendEmailEventListener::class, $sendEmailListener);
    }
}
