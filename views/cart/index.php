<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.cart-action').forEach(button => {
        button.addEventListener('click', async (e) => {
            const id = e.target.dataset.id;
            const action = e.target.dataset.action;

            const response = await fetch(`/cart/${action}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            const result = await response.json();

            if (result.success) {
                if (result.quantity !== undefined) {
                    const qtySpan = document.querySelector(`.cart-quantity[data-id="${id}"]`);
                    if (qtySpan) qtySpan.textContent = result.quantity;
                }

                if (result.removeItem) {
                    const row = e.target.closest('tr');
                    if (row) row.remove();
                }

                if (result.total !== undefined) {
                    document.querySelector('#cart-total').textContent = result.total + ' грн';
                }
            }
        });
    });
});
</script>

<h1 class="text-center">Ваш кошик</h1>

<?php if (empty($items)): ?>
    <p class="text-center">Кошик порожній.</p>
<?php else: ?>
    <div class="cart-container mx-auto p-4 border rounded" style="max-width: 700px;">
    <table class="table">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Кількість</th>
                <th>Сума</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($items as $item): ?>
                <?php $sum = $item['price'] * $item['quantity']; ?>
                <?php $total += $sum; ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= $item['price'] ?> грн</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 5px; flex-wrap: nowrap;">
                        <button class="btn btn-sm btn-success cart-action" data-action="add" data-id="<?= $item['id'] ?>">+</button>
                        <span class="cart-quantity" data-id="<?= $item['id'] ?>"><?= $item['quantity'] ?></span>
                        <button class="btn btn-sm btn-warning cart-action" data-action="decrease" data-id="<?= $item['id'] ?>">−</button>
                        <button class="btn btn-sm btn-danger cart-action" data-action="remove" data-id="<?= $item['id'] ?>">Видалити товар з кошику</button>
                        </div>
                    </td>
                    <td><?= $sum ?> грн</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Всього:</th>
                <th id="cart-total"><?= $total ?> грн</th>
            </tr>
        </tfoot>
    </table>
    <div class="text-center">
    <a href="/cart/checkout" class="btn btn-primary">Перейти до замовлення</a>
    </div>
<?php endif; ?>
