<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TextBlockRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TextBlockRepository extends EntityRepository
{

    public function getTextBlockByContentBlock($contentBlockId)
    {
        return $this->createQueryBuilder('tb')
            ->where('tb.contentBlock = :contentblockId')
            ->setParameter(':contentblockId', $contentBlockId)
            ->getQuery()
            ->getArrayResult();
    }
}
