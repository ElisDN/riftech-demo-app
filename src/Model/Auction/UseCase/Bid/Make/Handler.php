<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Bid\Make;

use App\Model\Auction\Entity\Lot\Content;
use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\LotRepository;
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
        $lot = $this->lots->get(new LotId($command->lot));
        $member = $this->members->get(new MemberId($command->member));

        $lot->makeBid(
            $member,
            $command->price,
            new \DateTimeImmutable()
        );

        $this->flusher->flush();
    }
}
