<div class="container mt-5 d-flex flex-column align-items-center">
    <h2>Вхід</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Увійти</button>
        <div class="alert alert-warning mt-2">
            Не маєте акаунту? <a href="/auth/signup">Зареєструватись</a>
        </div>
    </form>
</div>