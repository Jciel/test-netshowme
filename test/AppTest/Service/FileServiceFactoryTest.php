<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\Factory\FileServiceFactory;
use App\Service\FileService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class FileServiceFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = require "./config/container.php";
    }

    public function testContactServiceFactory()
    {
        $factory = new FileServiceFactory();

        $this->assertInstanceOf(FileServiceFactory::class, $factory);

        $fileService = $factory($this->container);

        $this->assertInstanceOf(FileService::class, $fileService);
    }
}
