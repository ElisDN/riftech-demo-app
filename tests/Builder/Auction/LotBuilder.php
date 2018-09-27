<?php

declare(strict_types=1);

namespace Test\Builder\Auction;

use App\Model\Auction\Entity\Lot\Content;
use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\Price;
use App\Model\Auction\Entity\Member\Member;

class LotBuilder
{
    private $id;
    private $member;
    private $date;
    private $content;
    private $price;
    private $active;

    public function __construct(Member $member)
    {
        $this->id = LotId::next();
        $this->member = $member;
        $this->date = new \DateTimeImmutable();
        $this->content = new Content('Name', 'Description');
        $this->price = new Price(1000, 35000);
        $this->active = false;
    }

    public function withPrice(Price $price): self
    {
        $clone = clone $this;
        $clone->price = $price;
        return $clone;
    }

    public function active(): self
    {
        $clone = clone $this;
        $clone->active = true;
        return $clone;
    }

    public function build(): Lot
    {
        $lot = new Lot(
            $this->id,
            $this->member,
            $this->date,
            $this->content,
            $this->price
        );

        if ($this->active) {
            $lot->sendToModeration(new \DateTimeImmutable());
            $lot->moderate(new \DateTimeImmutable());
        }

        return $lot;
    }
}
