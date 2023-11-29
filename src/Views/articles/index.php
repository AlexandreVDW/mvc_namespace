<?php require 'Views/includes/header.php'?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <a href="index.php?page=articles-show&id=<?= $article->id ?>">
                    <?= $article->title ?>
                </a> 
                (<?= $article->formatPublishDate() ?>)
                by: <a href="index.php?page=authors-show&id=<?= $article->authorId ?>"><?= $this->getAuthorName($article->authorId) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'Views/includes/footer.php'?>