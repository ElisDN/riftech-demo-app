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

    public function edit(Email $email, Name $name): void
    {
        $this->email = $email;
        $this->name = $name;
    }

    public function getId(): MemberId
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
