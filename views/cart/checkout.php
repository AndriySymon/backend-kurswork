<style>
    .order-form-container {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
<div class="order-form-container">
<h1>Оформлення замовлення</h1>
<?php if (!empty($message)): ?>
    <div class="alert alert-warning text-center">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>
<form method="post" action="/cart/submitorder">
    <div class="mb-3">
        <label>Ім’я:</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Прізвище:</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Номер телефону отримувача:</label>
        <input type="text" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Місто:</label>
        <input type="text" name="city" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Відділення Нової Пошти:</label>
        <input type="text" name="post_office" class="form-control" required>
    </div>

    <h4>Товари у замовленні:</h4>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?= htmlspecialchars($item['name']) ?> — <?= $item['quantity'] ?> шт. (<?= $item['price'] * $item['quantity'] ?> грн)</li>
        <?php endforeach; ?>
    </ul>

    <button type="submit" class="btn btn-success">Підтвердити замовлення</button>
</form>
</div>