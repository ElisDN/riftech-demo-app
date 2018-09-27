<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

class Member
{
    /**
     * @var MemberId
     */
    private $id;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var Email
     */
    private $email;

    public function __construct(MemberId $id, Email $email, Name $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }
}
