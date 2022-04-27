<?php

namespace App\DTO;


use App\Entity\Comment;
use DateTime;

class CommentDTO
{
    private int $_id;
    private string $_content;
    private string $_author;
    private DateTime $_created_at;

    public function __construct(Comment $comment)
    {
        $this->_id = $comment->getId();
        $this->_content = $comment->getContent();
        $this->_author = $comment->getAuthor();
        $this->_created_at = $comment->getCreated_at();
    }

    /**
     * Get the value of _id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Get the value of _content
     */
    public function getContent()
    {
        return $this->_content;
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

    /**
     * Get the value of _author
     */
    public function getAuthor()
    {
        return $this->_author;
    }
}
