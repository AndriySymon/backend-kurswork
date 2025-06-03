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
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<h2>Редагувати категорію</h2>

<form method="post" enctype="multipart/form-data">
    <?php if (!empty($_SESSION['flash'])): ?>
    <div style="color: red; padding: 10px; font-weight: bold;">
        <?= $_SESSION['flash'] ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <div class="mb-3">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($category['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="short_text" class="form-label">Опис</label>
        <textarea class="form-control" name="short_text" required><?= htmlspecialchars($category['short_text']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Поточне зображення</label><br>
        <img src="/images/<?= htmlspecialchars($category['image']) ?>" width="120">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Назва зображення (файл повинен бути у папці images/)</label>
        <input type="text" class="form-control" name="image" id="image" value="<?= htmlspecialchars($category['image'] ?? '') ?>">
    </div>
    <button type="submit" class="btn btn-primary">Зберегти</button>
    <a href="/admincategory/index" class="btn btn-secondary">Назад</a>
</form>
</div>