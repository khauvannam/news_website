<form method="POST" action="<?= "article_create_" ?>">
    <label>Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label>Content:</label>
    <textarea name="content" id="editor"></textarea><br>

    <label>Visible:</label>
    <input type="checkbox" name="visible" value="1"><br>
    <label>CategoryID:</label>
    <input type="text" name="category_id" id="category" required><br>

    <button type="submit">Save Article</button>
</form>