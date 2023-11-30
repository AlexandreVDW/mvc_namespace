<?php 

// Views/authors/update.php

require_once 'Views/includes/header.php';

// Fetch the existing author to pre-fill the form
$author = $this->getAuthorById($_GET['id']);

?>
<h2>Update Author:</h2>
<form action="index.php?page=authors-update&id=<?= $author->getId(); ?>" method="post">
    <label for="author">Name:</label>
    <input type="text" name="author" value="<?= $author->getName(); ?>">
    <br>
    <input type="submit" value="Update">
</form>

<?php require_once 'Views/includes/footer.php'?>