<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Content
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    public $name;
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    public $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
}
