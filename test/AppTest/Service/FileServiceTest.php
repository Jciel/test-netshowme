<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Service\Factory\FileServiceFactory;
use App\Service\FileService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\UploadedFile;

class FileServiceTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    /** @var FileService */
    private $filerService;

    protected function setUp()
    {
        $this->container = require "./config/container.php";
        $factory = new FileServiceFactory();
        $this->filerService = $factory($this->container);
    }

    public function testSaveFileInHD()
    {
        $file = new UploadedFile(
            fopen("./test/AppTest/Service/test.txt", "r"),
            2,
            0,
            "test.txt",
            "plain/text"
        );

        $this->filerService->saveFileInHD($file);

        $this->assertFileExists("./uploads/test.txt");
    }
}
