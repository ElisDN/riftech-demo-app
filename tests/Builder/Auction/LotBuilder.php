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

    public function __construct(Member $member)
    {
        $this->id = LotId::next();
        $this->member = $member;
        $this->date = new \DateTimeImmutable();
        $this->content = new Content('Name', 'Description');
        $this->price =  new Price(1000, 35000);
    }

    public function build(): Lot
    {
        return new Lot(
            $this->id,
            $this->member,
            $this->date,
            $this->content,
            $this->price
        );
    }
}
