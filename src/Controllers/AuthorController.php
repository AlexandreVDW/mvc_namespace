<?php

// Controllers/AuthorController.php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\DatabaseManager;
use App\Models\Article;
use App\Models\Author;

class AuthorController
{
    private $dbManager;

    public function __construct() {
        $this->dbManager = new DatabaseManager();
    }

    public function index()
    {
        $authors = $this->getAuthors();
        require 'Views/authors/index.php';
    }

    private function getAuthors()
    {
        $rawAuthors = $this->dbManager->query("SELECT * FROM author");
        $authors = [];
        foreach ($rawAuthors as $rawAuthor) {
            $authors[] = new Author($rawAuthor['id'], $rawAuthor['author']);
        }
        return $authors;
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return;
        }

        $stmt = $this->dbManager->getPdo()->prepare("SELECT * FROM author WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $rawAuthor = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$rawAuthor) {
            return;
        }

        $author = new Author($rawAuthor['id'], $rawAuthor['author']);

        $stmt = $this->dbManager->getPdo()->prepare("SELECT * FROM articles WHERE id_author = :id");
        $stmt->execute([':id' => $id]);
        $rawArticles = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            $articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id_author']);
        }

        require './Views/authors/show.php';
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author = new author(null, $_POST['author']);
            $author->save();

            header("Location: /mvc_namespace/src/index.php?page=authors");
            exit;
        } else {
            require './Views/authors/create.php';
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $existingAuthor = $this->getAuthorById($id);

            // Utilise les méthodes publiques pour accéder et mettre à jour les propriétés
            $existingAuthor->setName($_POST['author']);

            // Enregistre l'auteur mis à jour
            $existingAuthor->update();

            // Redirige vers la page avec tous les auteurs
            header("Location: /mvc_namespace/src/index.php?page=authors");
            exit;
        } else {
            // Récupère l'auteur existant pour pré-remplir le formulaire
            $author = $this->getAuthorById($id);

            // Charge la vue avec l'auteur existant
            require './Views/authors/update.php';
        }
    }

    private function getAuthorById($id)
    {
        $stmt = $this->dbManager->getPdo()->prepare("SELECT * FROM author WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $rawAuthor = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$rawAuthor) {
            return;
        }

        return new Author($rawAuthor['id'], $rawAuthor['author']);
    }
}