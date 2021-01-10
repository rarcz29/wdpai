<?php


class Project
{
    private $title;
    private $description;
    private $image;
    private $tool;
    private $visibility;
    private $likes;
    private $dislikes;
    private $comments;
    private $numberOfComments;
    private $originUrl;
    private $repoName;
    private $id;

// TODO: visibility as a bool value
    public function __construct($title, $description, $image, $tool, $visibility,
                                $likes, $dislikes, $comments, $numberOfComments, $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->tool = $tool;
        $this->visibility = $visibility;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
        $this->comments = $comments;
        $this->numberOfComments = $numberOfComments;
        $this->originUrl = $originUrl;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getTool(): string
    {
        return $this->tool;
    }

    public function setTool($tool): void
    {
        $this->tool = $tool;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function setVisibility($visibility): void
    {
        $this->visibility = $visibility;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function getDislikes(): int
    {
        return $this->dislikes;
    }

    public function setDislikes($dislikes): void
    {
        $this->dislikes = $dislikes;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function getNumberOfComments(): int
    {
        return $this->numberOfComments;
    }

    public function setNumberOfComments($numberOfComments): void
    {
        $this->numberOfComments = $numberOfComments;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOriginUrl(): string
    {
        return $this->originUrl;
    }

    public function setOriginUrl($originUrl): void
    {
        $this->originUrl = $originUrl;
    }

    public function getRepoName()
    {
        return $this->repoName;
    }

    public function setRepoName($repoName): void
    {
        $this->repoName = $repoName;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }
}