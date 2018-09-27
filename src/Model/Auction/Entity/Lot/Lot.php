<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Member\Member;

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

    public function __construct(LotId $id, Member $member, \DateTimeImmutable $date, Content $content, Price $price)
    {
        $this->id = $id;
        $this->member = $member;
        $this->createDate = $date;
        $this->content = $content;
        $this->price = $price;
        $this->status = self::STATUS_DRAFT;
    }

    public function sendToModeration(\DateTimeImmutable $date): void
    {
        $this->status = self::STATUS_ON_MODERATION;
        $this->onModerationDate = $date;
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
}
