<?php

namespace App\Models;

class Author
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function getAll()
    {
        // Get a DatabaseManager instance
        $dbManager = new DatabaseManager();

        // Prepare a SELECT statement
        $stmt = $dbManager->getPdo()->prepare("SELECT * FROM author");

        // Execute the statement
        $stmt->execute();

        // Fetch all the authors as an associative array
        $authorsArray = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Create an array to hold the Author objects
        $authors = [];

        // Loop through the results and create Author objects
        foreach ($authorsArray as $authorData) {
            $authors[] = new Author($authorData['id'], $authorData['author']);
        }

        // Return the array of Author objects
        return $authors;
    }
    public function save()
    {
        // Get a DatabaseManager instance
        $dbManager = new DatabaseManager();

        // Prepare an INSERT statement
        $stmt = $dbManager->getPdo()->prepare("INSERT INTO author (author) VALUES (:author)");

        // Bind the form data to the statement and execute it
        $stmt->execute([
            ':author' => $this->name
        ]);
    }
}
?>