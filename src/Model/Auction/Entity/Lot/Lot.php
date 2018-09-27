<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Member\Member;

class Lot
{
    /**
     * @var LotId
     */
    private $id;
    /**
     * @var Member
     */
    private $member;
    /**
     * @var \DateTimeImmutable
     */
    private $createDate;
    /**
     * @var Content
     */
    private $content;
    /**
     * @var Price
     */
    private $price;

    public function __construct(LotId $id, Member $member, \DateTimeImmutable $date, Content $content, Price $price)
    {
        $this->id = $id;
        $this->member = $member;
        $this->createDate = $date;
        $this->content = $content;
        $this->price = $price;
    }

    public function getId(): LotId
    {
        return $this->id;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getCreateDate(): \DateTimeImmutable
    {
        return $this->createDate;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
