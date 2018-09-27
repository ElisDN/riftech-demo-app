<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Price
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $start;
    /**
     * @var int|null
     * @ORM\Column(type="integer", nullable=true)
     */
    private $blitz;

    public function __construct(int $start, ?int $blitz)
    {
        $this->start = $start;
        $this->blitz = $blitz;
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getBlitz(): ?int
    {
        return $this->blitz;
    }
}
