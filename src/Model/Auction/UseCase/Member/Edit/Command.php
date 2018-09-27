<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Member\Edit;

use App\Model\Auction\UseCase\Member\Edit\Command\Name;

class Command
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $email;
    /**
     * @var Name
     */
    public $name;
}
