<?php


class Project
{
    private $title;
    private $description;
    private $image;
    private $tool;
    private $visibility;
// TODO: visibility as a bool value
    public function __construct($title, $description, $image, $tool, $visibility)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->tool = $tool;
        $this->visibility = $visibility;
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
}