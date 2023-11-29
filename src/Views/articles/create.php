<?php 
require_once 'Views/includes/header.php';

use App\Models\Author;

// Fetch the authors from the database
$authors = Author::getAll();
?>
<h2>Add an article :</h2>
<form action="index.php?page=articles-create" method="post">
<label for="title">Title:</label>
<input type="text" name="title">
<br>
<label for="description">description:</label>
<textarea name="description"></textarea> 
<br>
<label for="publish_date">Publish date:</label>
<input type="datetime-local" name="publish_date">
<br>
<label for="author">Author:</label>
<select name="author">
    <?php foreach ($authors as $author): ?>
        <option value="<?php echo $author->getId(); ?>"><?php echo $author->getName(); ?></option>
    <?php endforeach; ?>
</select>
<br>
<input type="submit" value="Submit">
</form>

<?php require_once 'Views/includes/footer.php'?>