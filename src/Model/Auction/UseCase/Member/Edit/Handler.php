<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Member\Edit;

use App\Model\Auction\Entity\Member\Email;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\MemberRepository;
use App\Model\Auction\Entity\Member\Name;
use App\Model\Flusher;

class Handler
{
    private $members;
    private $flusher;

    public function __construct(MemberRepository $members, Flusher $flusher)
    {
        $this->members = $members;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $member = $this->members->get(new MemberId($command->id));

        $member->edit(
            new Email($command->email),
            new Name(
                $command->name->last,
                $command->name->first,
                $command->name->middle
            )
        );

        $this->flusher->flush();
    }
}
