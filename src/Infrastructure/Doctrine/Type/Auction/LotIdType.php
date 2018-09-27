<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\Auction;

use App\Model\Auction\Entity\Lot\LotId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class LotIdType extends GuidType
{
    public const NAME = 'auction_lot_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof LotId ? $value->getId() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new LotId($value) : null;
    }

    public function getName(): string {
        return self::NAME;
    }
}