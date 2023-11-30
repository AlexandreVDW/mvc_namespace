<!DOCTYPE html>
<html>
<head>
    <title><?= $author->getName() ?></title>
</head>
<body>
<?php require 'Views/includes/header.php'?>
    <div class="author-details">
        <h1><?= $author->getName() ?></h1>
        <a href="index.php?page=authors-update&id=<?= $author->getId(); ?>">Update Name of the author</a>
    </div>
    <div class="article-list">
        <?php foreach ($articles as $article): ?>
            <p>
                <a href="index.php?page=articles-show&id=<?= $article->id ?>">
                    <strong><?= $article->title ?></strong>
                </a>
                <small><?= $article->formatPublishDate() ?></small>
            </p>
        <?php endforeach; ?>
        
    </div>
<?php require 'Views/includes/footer.php'?>
</body>
</html>