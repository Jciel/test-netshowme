<?php

declare(strict_types=1);

namespace App\Service;

use Zend\Diactoros\UploadedFile;

/**
 * Class FileService
 * @package App\Service
 */
class FileService
{
    /**
     * @param UploadedFile $file
     */
    public function saveFileInHD(UploadedFile $file)
    {
        $file->moveTo("./uploads/" . $file->getClientFilename());
    }
}
