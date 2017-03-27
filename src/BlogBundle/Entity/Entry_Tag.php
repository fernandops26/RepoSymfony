<?php

namespace BlogBundle\Entity;

/**
 * Entry_Tag
 */
class Entry_Tag
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $entryId;

    /**
     * @var int
     */
    private $tagId;


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
     * Set entryId
     *
     * @param integer $entryId
     *
     * @return Entry_Tag
     */
    public function setEntryId($entryId)
    {
        $this->entryId = $entryId;

        return $this;
    }

    /**
     * Get entryId
     *
     * @return int
     */
    public function getEntryId()
    {
        return $this->entryId;
    }

    /**
     * Set tagId
     *
     * @param integer $tagId
     *
     * @return Entry_Tag
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }

    /**
     * Get tagId
     *
     * @return int
     */
    public function getTagId()
    {
        return $this->tagId;
    }
}

