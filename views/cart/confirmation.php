<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">Замовлення успішно оформлено</h2>
        </div>
        <div class="card-body">
            <p class="lead">Дякуємо, <strong><?= htmlspecialchars($order['first_name']) ?> <?= htmlspecialchars($order['last_name']) ?></strong>!</p>
            <p>Ми надішлемо ваші товари за адресою:</p>
            <p><strong><?= htmlspecialchars($order['address']) ?>, <?= htmlspecialchars($order['city']) ?></strong></p>

            <hr>

            <h4>Ваше замовлення:</h4>
            <ul class="list-group mb-3">
                <?php foreach ($order['items'] as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <?= htmlspecialchars($item['name']) ?>
                            <span class="text-muted">× <?= $item['quantity'] ?> шт.</span>
                        </div>
                        <span class="badge bg-primary rounded-pill"><?= number_format($item['total'], 2) ?> грн</span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="text-end">
                <h5 class="text-success">Загальна сума: <strong><?= number_format($order['total_price'], 2) ?> грн</strong></h5>
            </div>
        </div>
    </div>
</div>
