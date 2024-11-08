<form method="POST" action="create_article.php">
    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Image URL:</label>
    <input type="text" name="image"><br>

    <label>Content:</label>
    <textarea name="content" required></textarea><br>

    <label>Visible:</label>
    <input type="checkbox" name="visible"><br>

    <button type="submit">Save Article</button>
</form>
