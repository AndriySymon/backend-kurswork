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
<h2>Редагування замовлення #<?= $order['id'] ?></h2>

<form method="post" action="">
    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select class="form-select" id="status" name="status" required>
            <?php 
                $statuses = ['Обробляється', 'Підтверджено', 'Відправлено', 'Доставлено', 'Отримано', 'Скасовано'];
                foreach ($statuses as $status):
            ?>
                <option value="<?= $status ?>" <?= ($order['status'] === $status) ? 'selected' : '' ?>><?= $status ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Адреса</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($order['address']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Місто</label>
        <input type="text" class="form-control" id="city" name="city" value="<?= htmlspecialchars($order['city']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="total_price" class="form-label">Сума</label>
        <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="<?= htmlspecialchars($order['total_price']) ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Зберегти</button>
    <a href="/adminorder/index" class="btn btn-secondary">Відміна</a>
</form>
</div>