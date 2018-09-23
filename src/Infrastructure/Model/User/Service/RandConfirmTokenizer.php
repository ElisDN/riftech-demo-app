<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\User\Service;

use App\Model\User\Entity\User\ConfirmToken;
use App\Model\User\Service\ConfirmTokenizer;

class RandConfirmTokenizer implements ConfirmTokenizer
{
    private $interval;

    public function __construct(\DateInterval $interval)
    {
        $this->interval = $interval;
    }

    public function generate(): ConfirmToken
    {
        return new ConfirmToken(
            (string)random_int(100000, 999999),
            (new \DateTimeImmutable())->add($this->interval)
        );
    }
}
