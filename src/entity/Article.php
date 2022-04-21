<?php
require_once '../core/Entity.php';
class Article extends Entity
{
    protected string $title;
    protected string $content;
    protected DateTime $created_at;
    protected bool $is_archived;

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = new DateTime($created_at);

        return $this;
    }

    /**
     * Get the value of is_archived
     */
    public function getIs_archived()
    {
        return $this->is_archived;
    }

    /**
     * Set the value of is_archived
     *
     * @return  self
     */
    public function setIs_archived($is_archived)
    {
        $this->is_archived = $is_archived;

        return $this;
    }
}
