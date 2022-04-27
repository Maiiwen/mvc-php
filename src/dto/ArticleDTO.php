<?php

namespace App\DTO;


use App\Entity\Article;
use DateTime;

class ArticleDTO
{
    private int $_id;
    private string $_title;
    private string $_content;
    private DateTime $_created_at;

    public function __construct(Article $article)
    {
        $this->_id = $article->getId();
        $this->_title = $article->getTitle();
        $this->_content = $article->getRawContent();
        $this->_created_at = $article->getCreated_at();
    }

    /**
     * Get the value of _id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of _title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Get the value of _content
     */
    public function getContent()
    {
        return BBCode($this->_content);
    }
    public function getRawContent()
    {
        return $this->_content;
    }

    /**
     * Get the value of _createdAt
     */
    public function getCreated_at()
    {
        return $this->_created_at;
    }
}
