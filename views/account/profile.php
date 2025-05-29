<div class="container mt-5">
    <h2>Редагування акаунту</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="first_name" class="form-label">Ім’я</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Номер телефону</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        <a href="/" class="btn btn-secondary">Назад</a>
    </form>
    <form method="post" action="/account/delete" onsubmit="return confirm('Ви впевнені, що хочете видалити акаунт? Цю дію не можна скасувати.');">
    <button type="submit" class="btn btn-danger mt-3">Видалити акаунт</button>
    </form>
    <?php if (!empty($_SESSION['user'])): ?>
    <a href="/order/myOrders" class="btn btn-outline-primary mt-3" style="margin-left: -17px;">Мої замовлення</a>
    <?php endif; ?>

</div>
