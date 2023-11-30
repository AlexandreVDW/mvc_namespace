<?php require 'Views/includes/header.php'?>

<h2>Confirm Deletion</h2>
<p>Are you sure you want to delete this article?</p>

<form action="index.php?page=articles-delete&id=<?= $article->id ?>" method="post">
    <input type="submit" value="Delete">
</form>

<?php require 'Views/includes/footer.php'?>