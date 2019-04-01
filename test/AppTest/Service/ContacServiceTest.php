<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\ContactService;
use App\Service\Factory\ContactServiceFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\UploadedFile;

class ContacServiceTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    /** @var ContactService */
    private $contactService;

    protected function setUp()
    {
        $this->container = require "./config/container.php";

        $factory = new ContactServiceFactory();

        $this->contactService = $factory($this->container);
    }

    public function testSaveMessageData()
    {
        $file = new UploadedFile(
            "./test.txt",
            2,
            4,
            "test.txt",
            "plain/text"
        );

        $data = [
            "name" => "teste",
            "email" =>"teste@gmail.com",
            "phone" => "99999999999",
            "message" => "test message",
            "file" => $file,
            "ip" => "[::1]"
        ];

        $result = $this->contactService->saveMessageData($data);

        $this->assertTrue($result);
    }
}
