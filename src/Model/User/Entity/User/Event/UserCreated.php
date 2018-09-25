<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User\Event;

use App\Model\User\Entity\User\ConfirmToken;
use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\UserId;

class UserCreated
{
    public $id;
    public $email;
    public $confirmToken;

    public function __construct(UserId $id, Email $email, ConfirmToken $confirmToken)
    {
        $this->id = $id;
        $this->email = $email;
        $this->confirmToken = $confirmToken;
    }
}
