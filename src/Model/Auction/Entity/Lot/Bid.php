<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Member\Member;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="auction_lot_bids", uniqueConstraints={
 *    @ORM\UniqueConstraint(name="auction_lot_bids_lot_member", columns={"lot_id", "member_id"})
 *})
 */
class Bid
{
    /**
     * Surrogate key
     * @ORM\Column(type="guid")
     * @ORM\Id
     */
    private $id;
    /**
     * @var Lot
     * @ORM\ManyToOne(targetEntity="Lot")
     * @ORM\JoinColumn(name="lot_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $lot;
    /**
     * @var Member
     * @ORM\ManyToOne(targetEntity="App\Model\Auction\Entity\Member\Member")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $member;
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $price;
    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $date;

    public function __construct(Lot $lot, Member $member, int $price, \DateTimeImmutable $date)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->lot = $lot;
        $this->member = $member;
        $this->price = $price;
        $this->date = $date;
    }

    public function isByMember(Member $member): bool
    {
        return $this->member === $member;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
