<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Member\Create;

use App\Model\Auction\Entity\Member\Email;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\Member;
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
        $id = new MemberId($command->id);

        if ($this->members->hasById($id)) {
            throw new \DomainException('Member already exists.');
        }

        $member = new Member(
            $id,
            new Email($command->email),
            new Name(
                $command->name->last,
                $command->name->first,
                $command->name->middle
            )
        );

        $this->members->add($member);

        $this->flusher->flush();
    }
}
