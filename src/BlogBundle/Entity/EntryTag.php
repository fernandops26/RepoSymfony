<?php

namespace BlogBundle\Entity;
use \BlogBundle\Entity\Tag;
use \BlogBundle\Entity\Entry;

/**
 * Entry_Tag
 */
class EntryTag
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Entry
     */
    private $entry;

    /**
     * @var Tag
     */
    private $tag;


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
     * Set entry
     *
     * @param Entry $entry
     *
     * @return EntryTag
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return Entry
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set tag
     *
     * @param Tag $tag
     *
     * @return EntryTag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }
}

