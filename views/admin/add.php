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
        <label>ID Категорії</label>
        <input type="number" name="category_id" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Додати</button>
</form>
