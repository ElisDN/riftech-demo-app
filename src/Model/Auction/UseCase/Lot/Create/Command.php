<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Lot\Create;

use App\Model\Auction\UseCase\Lot\Create\Command\Price;

class Command
{
    /**
     * @var string
     */
    public $member;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var Price
     */
    public $price;
}
