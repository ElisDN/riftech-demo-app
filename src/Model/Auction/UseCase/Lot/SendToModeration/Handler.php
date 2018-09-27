<?php

declare(strict_types=1);

namespace App\Model\Auction\UseCase\Lot\SendToModeration;

use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\LotRepository;
use App\Model\Flusher;

class Handler
{
    private $lots;
    private $flusher;

    public function __construct(LotRepository $lots, Flusher $flusher)
    {
        $this->lots = $lots;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $lot = $this->lots->get(new LotId($command->id));

        $lot->sendToModeration(new \DateTimeImmutable());

        $this->flusher->flush();
    }
}
