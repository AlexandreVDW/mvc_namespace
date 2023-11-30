<?php

// Index.php (rooter)

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomepageController;
use App\Controllers\ArticleController;
use App\Controllers\AuthorController;

$page = $_GET['page'] ?? null;

switch ($page) {
    case 'articles':
    case 'articles-index':
        (new ArticleController())->index();
        break;
    case 'articles-show':
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new ArticleController())->show($id);
        } else {
            // Handle the case where no valid id is provided
            (new ArticleController())->index();
        }
        break;
    case 'articles-create':
        (new ArticleController())->create();
        break;
    case 'articles-update': // Ajout du cas pour la mise à jour des articles
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new ArticleController())->update($id);
        } else {
            // Handle the case where no valid id is provided
            (new ArticleController())->index();
        }
        break;
    case 'articles-delete': // Ajout du cas pour la suppression des articles
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new ArticleController())->delete($id);
        } else {
            // Handle the case where no valid id is provided
            (new ArticleController())->index();
        }
        break;
    case 'authors': // Add a case for the authors index page
        (new AuthorController())->index();
        break;
    case 'authors-show': // Add a case for the authors show page
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new AuthorController())->show($id);
        } else {
            // Handle the case where no ID is provided
        }
        break;
    case 'authors-create':
        (new AuthorController())->create();
        break;
    case 'authors-update':
        $id = $_GET['id'] ?? null;
        if ($id) {
            (new AuthorController())->update($id);
        } else {
            // Handle the case where no valid id is provided
            (new AuthorController())->index();
        }
        break;
    default:
        // Handle the case where no valid page is provided
        (new HomepageController())->index();
        break;   
}