<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Lot\Reject;

class Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $reason;
}
