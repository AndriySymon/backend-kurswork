<?php
$Title = 'Головна сторінка';

ob_start();
?>
  <link rel="stylesheet" href="/styles/style.css">
<div class="container mt-4">
  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Ласкаво просимо в MusicWay!</h1>
      <p class="col-md-8 fs-4">У нас ви знайдете найкращі музичні інструменти за доступними цінами. Перегляньте наш каталог, щоб обрати ідеальний інструмент для себе.</p>
      <a class="btn btn-primary btn-lg" href="/instruments/index">Перейти до інструментів</a>
    </div>
  </div>

  <h2 class="mb-4">Популярні категорії</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <img src="images/guitar.jpg" class="card-img-top" alt="Гітари" >
        <div class="card-body">
          <h5 class="card-title">Гітари</h5>
          <p class="card-text">Електро та акустичні гітари для новачків і професіоналів.</p>
          <a href="/index.php?route=category/view/1" class="btn btn-outline-primary">Переглянути</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <img src="images/drums.jpg" class="card-img-top" alt="Барабани">
        <div class="card-body">
          <h5 class="card-title">Ударні</h5>
          <p class="card-text">Барабанні установки, електронні та класичні моделі.</p>
          <a href="/index.php?route=category/view/2" class="btn btn-outline-primary">Переглянути</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <img src="images/keyboards.jpg" class="card-img-top" alt="Клавішні">
        <div class="card-body">
          <h5 class="card-title">Клавішні</h5>
          <p class="card-text">Синтезатори, піаніно та MIDI-контролери.</p>
          <a href="/index.php?route=category/view/3" class="btn btn-outline-primary">Переглянути</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <hr class="my-5">

  <h2 class="mb-4 text-center">Чому обирають нас?</h2>
  <div class="row text-center mb-5">
    <div class="col-md-4">
      <i class="bi bi-music-note-beamed" style="font-size: 2rem;"></i>
      <h5 class="mt-2">Широкий вибір</h5>
      <p>Понад 1000 інструментів у каталозі — від класики до новітніх моделей.</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-truck" style="font-size: 2rem;"></i>
      <h5 class="mt-2">Швидка доставка</h5>
      <p>Доставимо ваше замовлення протягом 1–3 днів по всій Україні.</p>
    </div>
    <div class="col-md-4">
      <i class="bi bi-star" style="font-size: 2rem;"></i>
      <h5 class="mt-2">Гарантія якості</h5>
      <p>Усі товари перевірені та мають офіційну гарантію.</p>
    </div>
  </div>
    <?php $reviews = $reviews ?? []; ?> 
<h2 class="mb-4 text-center">Останні відгуки</h2>
<div class="row mb-5">
  <?php foreach ($reviews as $review): ?>
    <div class="col-md-6 mb-3">
      <div class="border p-3 rounded">
        <strong><?= htmlspecialchars($review['author']) ?></strong>
        <span class="text-muted">— <?= htmlspecialchars($review['city']) ?></span>
        <p class="mb-0"><?= htmlspecialchars($review['content']) ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>