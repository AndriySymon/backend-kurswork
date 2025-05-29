<form method="post">
    <div class="mb-3">
        <label for="first_name">Ім’я</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="last_name">Прізвище</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email">Номер телефону</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password">Пароль</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
    <label for="password_confirm" class="form-label">Підтвердіть пароль</label>
    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
    </div>
    <button type="submit" class="btn btn-success">Підтвердити</button>
</form>