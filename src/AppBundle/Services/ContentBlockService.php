<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class ContentBlockService
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getContentBlock()
    {
        $contentBlocks = $this->em->getRepository('AppBundle:ContentBlock')->findAll();
        return $contentBlocks;

    }
}