<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($instrument['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.add-to-cart');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const instrumentId = this.dataset.id;

            fetch('/order/addToCart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${instrumentId}`
            })
            .then(response => response.text())
            .then(data => {
                alert("Товар додано в кошик!");
            })
            .catch(error => {
                alert("Помилка додавання в кошик");
                console.error(error);
            });
        });
    });
});
</script>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="/images/<?= htmlspecialchars($instrument['image']) ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($instrument['name']) ?>">
        </div>
        <div class="col-md-6">
            <h2><?= htmlspecialchars($instrument['name']) ?></h2>
            <p><?= nl2br(htmlspecialchars($instrument['text'])) ?></p>

            <h4 class="mt-4">Характеристики</h4>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="/adminattribute/add/<?= $instrument['id'] ?>" class="btn btn-success mb-2">Додати атрибут</a>
            <?php endif; ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Назва</th>
                        <th>Значення</th>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <th>Дії</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attributes as $attr): ?>
                        <tr>
                            <td><?= htmlspecialchars($attr['attribute_name']) ?></td>
                            <td><?= htmlspecialchars($attr['attribute_value']) ?></td>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <td>
                                    <a href="/adminattribute/edit/<?= $attr['id'] ?>" class="btn btn-primary btn-sm">Редагувати</a>
                                    <a href="/adminattribute/delete/<?= $attr['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей атрибут?')">Видалити</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="mt-4">Ціна</h4>
            <p class="fs-4 fw-bold text-success"><?= number_format($instrument['price'], 2, '.', ' ') ?> грн</p>
            <?php if(isset($_SESSION['user'])): ?>
            <button class="btn btn-success add-to-cart" data-id="<?= $instrument['id'] ?>">Додати в кошик</button>
            <?php else: ?>
                <div class="alert alert-warning mt-2">
                    Для замовлення необхідно <a href="/auth/login">увійти</a> в акаунт.
                </div>
            <?php endif; ?>
            <a href="/instruments/index" class="btn btn-secondary">Назад</a>
        </div>
    </div>
<h3 class="mt-5">Відгуки</h3>
<?php if (!empty($reviews)): ?>
    <?php foreach ($reviews as $review): ?>
        <div class="border rounded p-3 mb-3">
            <strong><?= htmlspecialchars($review['author']) ?></strong>
            <span class="text-muted"> - <?= htmlspecialchars($review['city']) ?></span><br> 
            <small class="text-muted"><?= $review['created_at'] ?></small>
            <p><?= nl2br(htmlspecialchars($review['content'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Наразі немає коментарів.</p>
<?php endif; ?>
<h4 class="mt-4">Залишити відгук</h4>
<form method="post" class="mb-5">
    <div class="mb-3">
        <label for="author" class="form-label">Ваше ім’я</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Ваше місто</label>
        <textarea class="form-control" id="city" name="city" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Коментар</label>
        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
    </div>
    <?php if(isset($_SESSION['user'])): ?>
    <button type="submit" class="btn btn-primary">Надіслати</button>
    <?php else: ?>
        <div class="alert alert-warning mt-2">
            Для того, щоб залишити відгук, необхідно <a href="/auth/login">увійти</a> в акаунт.
        </div>
    <?php endif; ?>
</form>
</div>
</body>
</html>
