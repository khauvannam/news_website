<!-- _edit_article.php -->
<form method="POST" action="edit_article.php">
    <input type="hidden" name="id" value="<?= $articleData['id'] ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($articleData['title']) ?>" required><br>

    <label>Image URL:</label>
    <input type="text" name="image" value="<?= htmlspecialchars($articleData['image']) ?>"><br>

    <label>Content:</label>
    <textarea name="content" required><?= htmlspecialchars($articleData['content']) ?></textarea><br>

    <label>Visible:</label>
    <input type="checkbox" name="visible" <?= $articleData['visible'] ? 'checked' : '' ?>><br>

    <button type="submit">Update Article</button>
</form>
