<?php 
require_once 'Views/includes/header.php';
?>
<h2>Add an author:</h2>
<form action="index.php?page=authors-create" method="post">
<label for="author">Name:</label>
<input type="text" name="author">
<br>
<input type="submit" value="Submit">
</form>

<?php require_once 'Views/includes/footer.php'?>