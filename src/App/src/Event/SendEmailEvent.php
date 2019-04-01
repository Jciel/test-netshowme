<?php

namespace App\Event;

use App\Document\ContactMessage;
use App\Document\File;

/**
 * Class SendEmailEvent
 * @package App\Event
 */
class SendEmailEvent
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var File
     */
    private $file;

    /**
     * SendEmailEvent constructor.
     * @param ContactMessage $contactMessage
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->name = $contactMessage->getName();
        $this->email = $contactMessage->getEmail();
        $this->phone = $contactMessage->getPhone();
        $this->message = $contactMessage->getMessage();
        $this->ip = $contactMessage->getIp();
        $this->createdAt = $contactMessage->getCreatedAt();
        $this->file = $contactMessage->getFile();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }
}
