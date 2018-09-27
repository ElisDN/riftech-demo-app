<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Lot\Edit;

class Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
}
