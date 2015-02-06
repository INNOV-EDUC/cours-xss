<?php

namespace WCS\XSSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{






    // YAML GENERATED CODE
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $author;

    /**
     * @var \WCS\XSSBundle\Entity\Sweet
     */
    private $sweet;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
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
     * Set author
     *
     * @param string $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set sweet
     *
     * @param \WCS\XSSBundle\Entity\Sweet $sweet
     * @return Comment
     */
    public function setSweet(\WCS\XSSBundle\Entity\Sweet $sweet = null)
    {
        $this->sweet = $sweet;

        return $this;
    }

    /**
     * Get sweet
     *
     * @return \WCS\XSSBundle\Entity\Sweet 
     */
    public function getSweet()
    {
        return $this->sweet;
    }
}
