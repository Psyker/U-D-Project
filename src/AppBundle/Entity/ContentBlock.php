<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentBlock
 *
 * @ORM\Table(name="content_block")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentBlockRepository")
 */
class ContentBlock
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TextBlock", mappedBy="contentBlock", cascade={"remove", "persist"})
     * @var TextBlock
     */
    private $textBlocks;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ContentBlock
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return TextBlock
     */
    public function getTextBlocks()
    {
        return $this->textBlocks;
    }

    /**
     * @param TextBlock $textBlocks
     */
    public function setTextBlocks(TextBlock $textBlocks)
    {
        $this->textBlocks = $textBlocks;
    }

}

