<h2 class="mb-4">Усі замовлення</h2>

<?php foreach ($orders as $order): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Замовлення #<?= htmlspecialchars($order['id']) ?> 
                <small class="text-light">(<?= htmlspecialchars($order['created_at']) ?>)</small>
            </h5>
        </div>
        <div class="card-body">
            <p><strong>Користувач ID:</strong> <?= htmlspecialchars($order['user_id'] ?? '—') ?></p>
            <p><strong>Адреса:</strong> <?= htmlspecialchars($order['address']) ?>, <?= htmlspecialchars($order['city']) ?></p>
                <?php
                    $statusColors = [
                        'Обробляється' => 'secondary',
                        'Підтверджено' => 'warning',
                        'Відправлено' => 'info',
                        'Доставлено' => 'success',
                        'Отримано' => 'success',
                        'Скасовано' => 'danger'
                    ];

                $status = $order['status'] ?? '';
                $badgeClass = isset($statusColors[$status]) ? 'badge bg-' . $statusColors[$status] : 'badge bg-secondary';
                ?>
                <p><strong>Статус:</strong> <span class="<?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span></p>
            </p>
            <p><strong>Загальна сума:</strong> <?= number_format($order['total_price'], 2, ',', ' ') ?> грн</p>

            <h6>Товари:</h6>
            <?php if (!empty($order['items'])): ?>
            <ul class="list-group">
                <?php foreach ($order['items'] as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['product_name']) ?>
                        <span>
                            <span class="badge bg-primary rounded-pill"><?= (int)$item['quantity'] ?> шт.</span>
                            <span class="ms-3"><?= number_format($item['price'], 2, ',', ' ') ?> грн</span>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p><em>Товари не знайдені</em></p>
            <?php endif; ?>
            <div class="mt-3">
                <a href="/adminorder/edit/<?= $order['id'] ?>" class="btn btn-primary btn-sm me-2">Редагувати</a>
                <a href="/adminorder/delete/<?= $order['id'] ?>" 
                class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити це замовлення?');">Видалити</a>
            </div>

        </div>
    </div>
<?php endforeach; ?>
