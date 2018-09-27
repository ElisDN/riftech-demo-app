<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

class Price
{
    /**
     * @var int
     */
    private $start;
    /**
     * @var int|null
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
