<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

use Webmozart\Assert\Assert;

class Name
{
    private $last;
    private $first;
    private $middle;

    public function __construct(string $last, string $first, string $middle)
    {
        Assert::notEmpty($last);
        Assert::notEmpty($first);

        $this->last = $last;
        $this->first = $first;
        $this->middle = $middle;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function getFirst(): string
    {
        return $this->first;
    }

    public function getMiddle(): string
    {
        return $this->middle;
    }
}
