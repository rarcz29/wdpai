<?php

class Comment
{
    private $id;
    private $creator;
    private $text;
    private $date;

    public function __construct(int $id, string $creator, string $text, string $date)
    {
        $this->id = $id;
        $this->creator = $creator;
        $this->text = $text;
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function setCreator(string $creator)
    {
        $this->creator = $creator;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }
}