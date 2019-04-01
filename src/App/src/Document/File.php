<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="File")
 */
class File
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
    private $type;

    /**
     * @var int
     *
     * @ODM\Field(type="int")
     */
    private $size;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    private $path;

    public function __construct(string $name, string $type, int $size, string $path)
    {
        $this->name = $name;
        $this->type = $type;
        $this->size = $size;
        $this->path = $path;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
