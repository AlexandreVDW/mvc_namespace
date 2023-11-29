<?php require 'Views/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>
    <p>by: <a href="index.php?page=authors-show&id=<?= $article->authorId ?>"><?= $this->getAuthorName($article->authorId) ?></a></p>

    <?php // TODO: links to next and previous ?>
    <?php if ($previousArticleId): ?>
        <a href="index.php?page=articles-show&id=<?= $previousArticleId ?>">Previous</a>
    <?php endif; ?>

    <?php if ($nextArticleId): ?>
        <a href="index.php?page=articles-show&id=<?= $nextArticleId ?>">Next</a>
    <?php endif; ?>
</section>

<?php require 'Views/includes/footer.php'?>