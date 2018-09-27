<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

class Content
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
}
