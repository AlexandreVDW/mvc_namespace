<?php

declare(strict_types=1);

namespace App\Models;

class Article
{
    public $id;
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    public $authorId;

    public function __construct($id, string $title, ?string $description, ?string $publishDate, $authorId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->authorId = $authorId;
    }

    public function formatPublishDate($format = 'd-m-Y H:i:s')
    {
    // Check if publishDate is not null
    if ($this->publishDate) {
        // Create a DateTime object from the publishDate property
        $date = new \DateTime($this->publishDate);

        // Return the date in the specified format
        return $date->format($format);
    }

    // Return null if publishDate is null
    return null;
    }
}