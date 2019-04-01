<?php

declare(strict_types=1);

namespace App\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="ContactMessage")
 */
class ContactMessage
{
    /**
     * @var int
     * @ODM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $phone;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $message;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $ip;

    /**
     * @var DateTime
     *
     * @ODM\Field(type="date")
     */
    private $createdAt;

    /**
     * @var File
     *
     * @ODM\ReferenceOne(targetDocument="File", storeAs="id", cascade={"persist", "delete"})
     */
    private $file;


    public function __construct(string $name, string $email, string $phone, string $message, string $ip, File $file)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
        $this->ip = $ip;
        $this->file = $file;
        $this->createdAt = new DateTime("now");
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
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
