<?php

declare(strict_types=1);

namespace App\Service;

use App\Document\ContactMessage;
use App\Document\File;
use App\Event\SendEmailEvent;
use Doctrine\ODM\MongoDB\DocumentManager;
use Zend\Diactoros\UploadedFile;
use Zend\EventManager\EventManager;

/**
 * Class ContactService
 * @package App\Service
 */
class ContactService
{
    /** @var DocumentManager */
    private $documentManager;

    /** @var EventManager */
    private $eventManager;

    /**
     * ContactService constructor.
     * @param DocumentManager $documentManager
     * @param EventManager $eventManager
     */
    public function __construct(DocumentManager $documentManager, EventManager $eventManager)
    {
        $this->documentManager = $documentManager;
        $this->eventManager = $eventManager;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function saveMessageData(array $data): bool
    {
        /** @var UploadedFile $fileUpload */
        $fileUpload = $data["file"];

        $file = new File(
            $fileUpload->getClientFilename(),
            $fileUpload->getClientMediaType(),
            $fileUpload->getSize(),
            "/uploads/" . $fileUpload->getClientFilename()
        );

        $contactMessage = new ContactMessage(
            $data["name"],
            $data["email"],
            $data["phone"],
            $data["message"],
            $data["ip"],
            $file
        );

        $this->documentManager->persist($contactMessage);
        $this->documentManager->flush();

        $sendEmailEvent = new SendEmailEvent($contactMessage);

        $this->eventManager->trigger(SendEmailEvent::class, $this, $sendEmailEvent);

        return true;
    }
}
