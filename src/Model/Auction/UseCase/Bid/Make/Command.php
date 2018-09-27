<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Bid\Make;

class Command
{
    /**
     * @var string
     */
    public $lot;
    /**
     * @var string
     */
    public $member;
    /**
     * @var int
     */
    public $price;
}
