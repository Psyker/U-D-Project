<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TextBlock
 *
 * @ORM\Table(name="text_block")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TextBlockRepository")
 */
class TextBlock
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @var string
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var integer
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ContentBlock", inversedBy="textBlocks")
     * @ORM\JoinColumn()
     * @var ContentBlock
     */
    private $contentBlock;


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
     * @return TextBlock
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
     * Set content
     *
     * @param string $content
     *
     * @return TextBlock
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return ContentBlock
     */
    public function getContentBlock()
    {
        return $this->contentBlock;
    }


    public function setContentBlock(ContentBlock $contentBlock)
    {
        $this->contentBlock = $contentBlock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }


    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

}

