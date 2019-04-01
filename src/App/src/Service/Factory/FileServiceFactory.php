<?php

declare(strict_types=1);

namespace App\Service\Factory;

use App\Service\FileService;
use Psr\Container\ContainerInterface;

/**
 * Class FileServiceFactory
 * @package App\Service\Factory
 */
class FileServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return FileService
     */
    public function __invoke(ContainerInterface $container): FileService
    {
        return new FileService();
    }
}
