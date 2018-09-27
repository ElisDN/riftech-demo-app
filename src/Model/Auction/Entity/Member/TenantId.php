<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

use Webmozart\Assert\Assert;

class TenantId
{
    private $id;

    public function __construct(string $id)
    {
        Assert::notEmpty($id);
        $this->id = $id;
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
