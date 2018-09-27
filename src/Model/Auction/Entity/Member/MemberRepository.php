<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

interface MemberRepository
{
    public function hasById(MemberId $id): bool;

    public function add(Member $member): void;

    public function get(MemberId $id): Member;
}
