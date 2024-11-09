<form method="POST" action="create_article.php">
    <label>Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label>Content:</label>
    <textarea name="content" id="editor" required></textarea><br>

    <label>Visible:</label>
    <input type="checkbox" name="visible" value="1"><br>

    <button type="submit">Save Article</button>
</form>