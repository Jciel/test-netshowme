<?php

declare(strict_types=1);

namespace AppTest\Listener;

use App\Document\ContactMessage;
use App\Document\File;
use App\Event\SendEmailEvent;
use App\Listener\Factory\SendEmailEventListenerFactory;
use App\Listener\SendEmailEventListener;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\EventManager\Event;

class SendEmailEventListenerTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    /** @var SendEmailEventListener */
    protected $sendEmailListener;

    protected function setUp()
    {
        $this->container = require "./config/container.php";

        $factory = new SendEmailEventListenerFactory();
        $this->sendEmailListener = $factory($this->container);
    }

    public function testExecute()
    {
        $file = new File(
            "./test.txt",
            "txt",
            2,
            "/uploads/test.txt",
        );

        $message = new ContactMessage(
            "teste",
            "teste@gmail.com",
            "99999999999",
            "test message",
            "[::1]",
            $file
        );

        $sendEmailEvent = new SendEmailEvent($message);

        $event = new Event(SendEmailEvent::class, null, $sendEmailEvent);

        $result = $this->sendEmailListener->execute($event);

        $this->assertTrue($result);
    }
}
