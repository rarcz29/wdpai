<?php

class Project
{
    private $title;
    private $description;
    private $image;
    private $tool;
    private $private;
    private $likes;
    private $dislikes;
    private $numberOfComments;
    private $originUrl;
    private $repoName;
    private $id;

    public function __construct($title, $description, $image, $tool, $private,
                                $likes, $dislikes, $numberOfComments, $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->tool = $tool;
        $this->private = $private;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->numberOfComments = $numberOfComments;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getTool(): string
    {
        return $this->tool;
    }

    public function setTool(string $tool)
    {
        $this->tool = $tool;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private)
    {
        $this->private = $private;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes)
    {
        $this->likes = $likes;
    }

    public function getDislikes(): int
    {
        return $this->dislikes;
    }

    public function setDislikes(int $dislikes)
    {
        $this->dislikes = $dislikes;
    }

    public function getNumberOfComments(): int
    {
        return $this->numberOfComments;
    }

    public function setNumberOfComments(int $numberOfComments)
    {
        $this->numberOfComments = $numberOfComments;
    }

    public function getOriginUrl(): string
    {
        return $this->originUrl;
    }

    public function setOriginUrl(string $originUrl)
    {
        $this->originUrl = $originUrl;
    }

    public function getRepoName(): string
    {
        return $this->repoName;
    }

    public function setRepoName(string $repoName)
    {
        $this->repoName = $repoName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}