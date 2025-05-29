<h3>Додати атрибут</h3>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Назва атрибута</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="value" class="form-label">Значення</label>
        <input type="text" class="form-control" id="value" name="value" required>
    </div>

    <button type="submit" class="btn btn-success">Зберегти</button>
    <a href="/instruments/view/<?= intval($instrument_id) ?>" class="btn btn-secondary">Назад</a>
</form>
