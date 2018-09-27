<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Auction\Entity;

use App\Model\Auction\Entity\Lot\Lot;
use App\Model\Auction\Entity\Lot\LotId;
use App\Model\Auction\Entity\Lot\LotRepository;
use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineLotRepository implements LotRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Lot::class);
        $this->em = $em;
    }

    public function get(LotId $id): Lot
    {
        /** @var Lot $member */
        if (!$member = $this->repo->find($id->getId())) {
            throw new EntityNotFoundException('Lot is not found.');
        }
        return $member;
    }

    public function add(Lot $member): void
    {
        $this->em->persist($member);
    }
}
