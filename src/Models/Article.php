<?php

//Models/Article.php

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
    
    public function save()
    {
        // Get a DatabaseManager instance
        $dbManager = new DatabaseManager();

        // Prepare an INSERT statement
        $stmt = $dbManager->getPdo()->prepare("INSERT INTO articles (title, description, publish_date, id_author) VALUES (:title, :description, :publish_date, :id_author)");

        // Bind the form data to the statement and execute it
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':publish_date' => $this->publishDate,
            ':id_author' => $this->authorId
    ]);
    }

    public function update()
    {
        $dbManager = new DatabaseManager();

        $stmt = $dbManager->getPdo()->prepare("UPDATE articles SET title = :title, description = :description, publish_date = :publish_date, id_author = :id_author WHERE id = :id");

        $stmt->execute([
            ':id' => $this->id,
            ':title' => $this->title,
            ':description' => $this->description,
            ':publish_date' => $this->publishDate,
            ':id_author' => $this->authorId
        ]);
    }

    public function delete()
    {
        // Get a DatabaseManager instance
        $dbManager = new DatabaseManager();

        // Prepare a DELETE statement
        $stmt = $dbManager->getPdo()->prepare("DELETE FROM articles WHERE id = :id");

        // Bind the article ID to the statement and execute it
        $stmt->execute([':id' => $this->id]);
    }
}