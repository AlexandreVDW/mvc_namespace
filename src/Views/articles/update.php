<?php 

// Views/articles/update.php

require_once 'Views/includes/header.php';

use App\Models\Author;

// Fetch the authors from the database
$authors = Author::getAll();
?>
<h2>Update Article :</h2>
<form action="index.php?page=articles-update&id=<?php echo $article->id; ?>" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo $article->title; ?>">
    <br>
    <label for="description">Description:</label>
    <textarea name="description"><?php echo $article->description; ?></textarea>
    <br>
    <label for="publish_date">Publish date:</label>
    <input type="datetime-local" name="publish_date" value="<?php echo $article->publishDate; ?>">
    <br>
    <label for="author">Author:</label>
    <select name="author">
        <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author->getId(); ?>" <?php echo ($author->getId() == $article->authorId) ? 'selected' : ''; ?>><?php echo $author->getName(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <input type="submit" value="Update">
</form>

<?php require_once 'Views/includes/footer.php'?>
