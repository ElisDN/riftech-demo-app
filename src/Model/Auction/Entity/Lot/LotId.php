<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Lot;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class LotId
{
    private $id;

    public function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
    }

    public static function next(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
