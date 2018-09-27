<?php

declare(strict_types=1);

namespace App\Model\Auction\Entity\Member;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable
 */
class Name
{
    /**
     * @ORM\Column(type="string")
     */
    private $last;
    /**
     * @ORM\Column(type="string")
     */
    private $first;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $middle;

    public function __construct(string $last, string $first, string $middle)
    {
        Assert::notEmpty($last);
        Assert::notEmpty($first);

        $this->last = $last;
        $this->first = $first;
        $this->middle = $middle;
    }

    public function getLast(): string
    {
        return $this->last;
    }

    public function getFirst(): string
    {
        return $this->first;
    }

    public function getMiddle(): string
    {
        return $this->middle;
    }
}
