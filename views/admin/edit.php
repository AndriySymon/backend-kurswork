<style>
    .edit-form-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 25px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>

<div class="edit-form-container">
    <h2>Редагувати інструмент</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Назва</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($instrument['name']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Опис</label>
            <textarea name="text" class="form-control"><?= htmlspecialchars($instrument['text']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Короткий опис</label>
            <textarea name="short_text" class="form-control"><?= htmlspecialchars($instrument['short_text']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Картинка</label>
            <textarea name="image" class="form-control"><?= htmlspecialchars($instrument['image']) ?></textarea>
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
        <div class="mb-3">
            <label class="form-label">Ціна</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($instrument['price']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Зберегти</button>
        <a href="/" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
</div>