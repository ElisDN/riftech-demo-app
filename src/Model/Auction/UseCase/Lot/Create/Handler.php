<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Lot\Create;

use App\Model\Auction\Entity\Lot\Content;
use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\LotRepository;
use App\Model\Auction\Entity\Lot\Price;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\MemberRepository;
use App\Model\Flusher;

class Handler
{
    private $lots;
    private $members;
    private $flusher;

    public function __construct(LotRepository $lots, MemberRepository $members, Flusher $flusher)
    {
        $this->lots = $lots;
        $this->members = $members;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $member = $this->members->get(new MemberId($command->member));

        $lot = new Lot(
            LotId::next(),
            $member,
            new \DateTimeImmutable(),
            new Content(
                $command->name,
                $command->description
            ),
            new Price(
                $command->price->start,
                $command->price->blitz
            )
        );

        $this->lots->add($lot);

        $this->flusher->flush();
    }
}
