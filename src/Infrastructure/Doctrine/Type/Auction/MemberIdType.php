<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\Auction;

use App\Model\Auction\Entity\Member\MemberId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class MemberIdType extends GuidType
{
    public const NAME = 'auction_member_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof MemberId ? $value->getId() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new MemberId($value) : null;
    }

    public function getName(): string {
        return self::NAME;
    }
}