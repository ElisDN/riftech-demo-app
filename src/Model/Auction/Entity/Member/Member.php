<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="auction_members")
 */
class Member
{
    /**
     * @var MemberId
     * @ORM\Column(type="auction_member_id")
     * @ORM\Id
     */
    private $id;
    /**
     * @var Name
     * @ORM\Embedded(class="Name")
     */
    private $name;
    /**
     * @var Email
     * @ORM\Column(type="auction_member_email")
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
