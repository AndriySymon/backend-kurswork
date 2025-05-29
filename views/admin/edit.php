<?php $this->Title = 'Редагування інструменту'; ?>

<div class="container mt-4">
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
            <label class="form-label">ID категорії</label>
            <textarea name="category_id" class="form-control"><?= htmlspecialchars($instrument['category_id']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ціна</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($instrument['price']) ?>">
        </div>
        <button type="submit" class="btn btn-success">Зберегти</button>
        <a href="/" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
