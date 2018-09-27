<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

interface LotRepository
{
    public function add(Lot $member): void;

    public function get(LotId $id): Lot;
}
