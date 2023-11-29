<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\DatabaseManager;
use App\Models\Article;
use App\Models\Author;

class ArticleController
{
    private $dbManager;

    public function __construct() {
        $this->dbManager = new DatabaseManager();
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'Views/articles/index.php';
    }

    private function getArticles()
    {
        $rawArticles = $this->dbManager->query("SELECT * FROM articles");

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['id'],$rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id_author']);
        }

        return $articles;
    }
    private function getAuthorName($authorId)
    {
        $stmt = $this->dbManager->getPdo()->prepare("SELECT author FROM author WHERE id = :id");
        $stmt->execute([':id' => $authorId]);
        $authorName = $stmt->fetchColumn();

        return $authorName;
    }

    public function show($id)
    {
    // Validate the $id parameter
    if (!is_numeric($id)) {
        // Handle invalid $id parameter
        return;
    }

    // Fetch the article from the database using a prepared statement
    $stmt = $this->dbManager->getPdo()->prepare("SELECT * FROM articles WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $rawArticle = $stmt->fetch(\PDO::FETCH_ASSOC);

    // Check if the article exists
    if (!$rawArticle) {
        // Handle non-existing article
        return;
    }

    // Convert the raw article into an Article object
    $article = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id_author']);

    // Fetch the previous and next article IDs
    $previousStmt = $this->dbManager->getPdo()->prepare("SELECT id FROM articles WHERE id < :id ORDER BY id DESC LIMIT 1");
    $previousStmt->execute([':id' => $id]);
    $previousArticleId = $previousStmt->fetchColumn();

    $nextStmt = $this->dbManager->getPdo()->prepare("SELECT id FROM articles WHERE id > :id ORDER BY id ASC LIMIT 1");
    $nextStmt->execute([':id' => $id]);
    $nextArticleId = $nextStmt->fetchColumn();

    // Load the view and pass the Article object to it
    require './Views/articles/show.php';
    }
}