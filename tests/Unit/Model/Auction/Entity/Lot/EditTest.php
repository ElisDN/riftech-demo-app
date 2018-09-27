<?php

declare(strict_types=1);

namespace Test\Unit\Model\Auction\Entity\Lot;

use App\Model\Auction\Entity\Lot\Content;
use PHPUnit\Framework\TestCase;
use Test\Builder\Auction\LotBuilder;
use Test\Builder\Auction\MemberBuilder;

class EditTest extends TestCase
{
    public function testDraft(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $lot->sendToModeration($date = new \DateTimeImmutable());

        $lot->edit($content = new Content('Title', 'New Description'));

        self::assertEquals($content, $lot->getContent());
    }

    public function testOnModeration(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $lot->sendToModeration(new \DateTimeImmutable());

        $lot->edit($content = new Content('Title', 'New Description'));
        self::assertEquals($content, $lot->getContent());
    }

    public function testActive(): void
    {
        $member = (new MemberBuilder())->build();
        $lot = (new LotBuilder($member))->build();

        $lot->sendToModeration(new \DateTimeImmutable());
        $lot->moderate(new \DateTimeImmutable());

        $this->expectExceptionMessage('Unable to edit not a draft.');

        $lot->edit($content = new Content('Title', 'New Description'));
    }
}
