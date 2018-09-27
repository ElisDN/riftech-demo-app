<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Member\Member;

class Bid
{
    /**
     * @var Lot
     */
    private $lot;
    /**
     * @var Member
     */
    private $member;
    /**
     * @var int
     */
    private $price;
    /**
     * @var \DateTimeImmutable
     */
    private $date;

    public function __construct(Lot $lot, Member $member, int $price, \DateTimeImmutable $date)
    {
        $this->lot = $lot;
        $this->member = $member;
        $this->price = $price;
        $this->date = $date;
    }

    public function isByMember(Member $member): bool
    {
        return $this->member === $member;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
