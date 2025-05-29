<div class="container my-5">
    <h1 class="mb-4">Мої замовлення</h1>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info">У вас ще немає замовлень.</div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
                <?php
                    $statusColors = [
                        'Обробляється' => 'secondary',
                        'Підтверджено' => 'warning',
                        'Відправлено' => 'info',
                        'Доставлено' => 'success',
                        'Отримано' => 'success',
                        'Скасовано' => 'danger'
                    ];
                    $status = strtolower($order['status']);
                    $badgeClass = $statusColors[$status] ?? 'secondary';
                ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Замовлення #<?= $order['id'] ?> — <?= $order['created_at'] ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Адреса доставки:</strong> <?= htmlspecialchars($order['address']) ?>, <?= htmlspecialchars($order['city']) ?></p>
                    <p><strong>Сума замовлення:</strong> <span class="text-success fw-bold"><?= $order['total_price'] ?> грн</span></p>
                    <p><strong>Статус:</strong><span class="badge bg-<?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span></p>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Назва товару</th>
                                    <th scope="col">Кількість</th>
                                    <th scope="col">Ціна</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['items'] as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= $item['price'] ?> грн</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php if(in_array($order['status'], ['Обробляється', 'Підтверджено'])): ?>
                    <form method="post" action="/order/cancelOrder/<?= $order['id'] ?>" onsubmit="return confirm('Ви впевнені, що хочете скасувати це замовлення?');">
                        <button type="submit" class = "btn btn-danger mt-3">Скасувати замовлення</button>
                    </form>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
