<style>
    .form-container {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fafafa;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
</style>

<div class="form-container">
<h1>Додати інструмент</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label>Назва</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label>Короткий опис</label>
        <textarea name="short_text" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Повний опис</label>
        <textarea name="text" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Ціна</label>
        <input type="number" name="price" class="form-control" step="0.01">
    </div>
    <div class="mb-3">
        <label>Зображення</label>
        <input type="text" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label for="category_id">Категорія</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">-- Виберіть категорію --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"
                    <?= (isset($old['category_id']) && $old['category_id'] == $category['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Додати</button>
</form>
</div>