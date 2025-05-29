<?php ob_start(); ?>
<div class="container mt-4">
    <h2>Інструменти категорії: <?= htmlspecialchars($categoryName) ?></h2>
    <div class="row mt-3">
        <?php foreach ($instruments as $instrument): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="/images/<?= $instrument['image'] ?>" class="card-img-top" alt="<?= $instrument['name'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($instrument['name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($instrument['short_text']) ?></p>
                        <h5 class="mt-4">Ціна</h4>
                        <p class="fs-4 fw-bold text-success"><?= number_format($instrument['price'], 2, '.', ' ') ?> грн</p>
                        <a href="/instruments/view/<?= $instrument['id'] ?>" class="btn btn-primary">Детальніше</a>

                        <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <div class="d-flex gap-2">
                            <a href="/admininstrument/edit/<?= $instrument['id'] ?>" class="btn btn-warning btn-sm">Редагувати</a>
                            <a href="/admininstrument/delete/<?= $instrument['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей інструмент?')">Видалити</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
