<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Confirm;

class Command
{
    public $email;
    public $token;
}
