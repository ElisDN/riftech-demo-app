<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Member\Member;
use Doctrine\Common\Collections\ArrayCollection;

class Lot
{
    private const STATUS_DRAFT = 'draft';
    private const STATUS_ON_MODERATION = 'on_moderation';
    private const STATUS_ACTIVE = 'active';

    /**
     * @var LotId
     */
    private $id;
    /**
     * @var Member
     */
    private $member;
    /**
     * @var \DateTimeImmutable
     */
    private $createDate;
    /**
     * @var Content
     */
    private $content;
    /**
     * @var Price
     */
    private $price;
    /**
     * @var string
     */
    private $status;
    /**
     * @var \DateTimeImmutable|null
     */
    private $onModerationDate;
    /**
     * @var \DateTimeImmutable|null
     */
    private $publishDate;
    /**
     * @var \DateTimeImmutable|null
     */
    private $updateDate;
    /**
     * @var string|null
     */
    private $rejectReason;
    /**
     * @var ArrayCollection|Bid[]
     */
    private $bids;

    public function __construct(LotId $id, Member $member, \DateTimeImmutable $date, Content $content, Price $price)
    {
        $this->id = $id;
        $this->member = $member;
        $this->createDate = $date;
        $this->content = $content;
        $this->price = $price;
        $this->status = self::STATUS_DRAFT;
        $this->bids = new ArrayCollection();
    }

    public function edit(Content $content): void
    {
        if (!$this->isDraft() && !$this->isOnModeration()) {
            throw new \DomainException('Unable to edit not a draft.');
        }
        $this->content = $content;
    }

    public function sendToModeration(\DateTimeImmutable $date): void
    {
        if (!$this->isDraft()) {
            throw new \DomainException('Lot is not a draft.');
        }
        $this->status = self::STATUS_ON_MODERATION;
        $this->onModerationDate = $date;
    }

    public function moderate(\DateTimeImmutable $date): void
    {
        if (!$this->isOnModeration()) {
            throw new \DomainException('Lot is not on moderation.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->onModerationDate = null;
        $this->rejectReason = null;
        $this->publishDate = $date;
    }

    public function reject(string $reason): void
    {
        $this->status = self::STATUS_DRAFT;
        $this->rejectReason = $reason;
        $this->publishDate = null;
    }

    public function makeBid(Member $member, int $price, \DateTimeImmutable $date): void
    {
        if (!$this->isActive()) {
            throw new \DomainException('Lot is not active.');
        }

        if ($member === $this->member) {
            throw new \DomainException('Unable to make bid by owner.');
        }

        foreach ($this->bids as $bid) {
            if ($bid->isByMember($member)) {
                throw new \DomainException('Bid is already placed.');
            }
        }

        if ($price <= $this->getCurrentPrice()) {
            throw new \DomainException('Price is too small.');
        }

        $this->bids->add(new Bid($this, $member, $price, $date));
    }

    public function getCurrentPrice(): int
    {
        if ($this->bids->count()) {
            return max($this->bids->map(function (Bid $bid) {
                return $bid->getPrice();
            })->toArray());
        }
        return $this->price->getStart();
    }

    public function getLastBidDate(): ?\DateTimeImmutable
    {
        if ($this->bids->count()) {
            /** @var Bid $last */
            $last = $this->bids->last();
            return $last->getDate();
        }
        return null;
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isOnModeration(): bool
    {
        return $this->status === self::STATUS_ON_MODERATION;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getId(): LotId
    {
        return $this->id;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function getCreateDate(): \DateTimeImmutable
    {
        return $this->createDate;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getOnModerationDate(): ?\DateTimeImmutable
    {
        return $this->onModerationDate;
    }

    public function getUpdateDate(): ?\DateTimeImmutable
    {
        return $this->updateDate;
    }

    public function getPublishDate(): ?\DateTimeImmutable
    {
        return $this->publishDate;
    }

    public function getRejectReason(): ?string
    {
        return $this->rejectReason;
    }
}
