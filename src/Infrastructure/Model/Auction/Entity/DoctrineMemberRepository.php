<?php

declare(strict_types=1);

namespace App\Infrastructure\Model\Auction\Entity;

use App\Model\Auction\Entity\Member\Member;
use App\Model\Auction\Entity\Member\MemberId;
use App\Model\Auction\Entity\Member\MemberRepository;
use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineMemberRepository implements MemberRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(Member::class);
        $this->em = $em;
    }

    public function hasById(MemberId $id): bool
    {
        return $this->repo->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->andWhere('t.id = :id')
            ->setParameter(':id', $id->getId())
            ->getQuery()->getSingleScalarResult() > 0;
    }

    public function get(MemberId $id): Member
    {
        /** @var Member $member */
        if (!$member = $this->repo->find($id->getId())) {
            throw new EntityNotFoundException('Member is not found.');
        }
        return $member;
    }

    public function add(Member $member): void
    {
        $this->em->persist($member);
    }
}
