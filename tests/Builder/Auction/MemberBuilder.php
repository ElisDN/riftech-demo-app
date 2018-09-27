<?php

declare(strict_types=1);

namespace Test\Builder\Auction;

use App\Model\Auction\Entity\Member\Email;
use App\Model\Auction\Entity\Member\Member;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\Name;

class MemberBuilder
{
    private $id;
    private $email;
    private $name;

    public function __construct()
    {
        $this->id = MemberId::next();
        $this->email = new Email('mail@example.com');
        $this->name = new Name('Last', 'First', 'Middle');
    }

    public function build(): Member
    {
        return new Member(
            $this->id,
            $this->email,
            $this->name
        );
    }
}
