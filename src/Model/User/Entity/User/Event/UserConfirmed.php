<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User\Event;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\UserId;

class UserConfirmed
{
    public $id;
    public $email;

    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}
