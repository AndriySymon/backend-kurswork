<?php
$this->Title = 'Список інструментів';

$pdo = new PDO('mysql:host=localhost;dbname=music_shop;charset=utf8', 'root', '');

$stmt = $pdo->query("SELECT * FROM instruments");
$instruments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
  <div class="row">
    <?php foreach ($instruments as $instrument): ?>
      <div class="col-md-4 mb-4">
        <div class="card" style="width: 18rem;">
          <img src="../../images/<?= htmlspecialchars($instrument['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($instrument['name']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($instrument['name']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($instrument['short_text']) ?></p>
            <h5 class="mt-4">Ціна</h4>
            <p class="fs-4 fw-bold text-success"><?= number_format($instrument['price'], 2, '.', ' ') ?> грн</p>
            <a href="/instruments/view/<?= $instrument['id'] ?>" class="btn btn-primary">Детальніше</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
