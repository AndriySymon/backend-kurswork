<style>
.card {
  height: 100%;
  display: flex;
  flex-direction: column;
}
.card-img-top {
  object-fit: cover;
  height: 300px;
}
.card-body {
  flex: 1;
  display: flex;
  flex-direction: column;
}
.card-text {
  flex-grow: 1;
  overflow: hidden;
  text-overflow: ellipsis;
}
.card .btn-primary,
.card .d-flex {
  margin-top: auto;
}
</style>
<?php
$this->Title = 'Весь каталог';
?>
<div class="container mb-3">
  <label for="sortOrder" class="form-label">Сортувати за ціною:</label>
  <select id="sortOrder" class="form-select w-auto d-inline-block">
    <option value="all">Не сортувати</option>
    <option value="asc">Від дешевих до дорогих</option>
    <option value="desc">Від дорогих до дешевих</option>
  </select>
</div>
<div class="container">
  <div class="row" id ="products-container">
    <?php foreach ($instruments as $instrument): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="../../images/<?= htmlspecialchars($instrument['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($instrument['name']) ?>">
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
<script>
document.getElementById('sortOrder').addEventListener('change', function () {
  const order = this.value;
  const USER_ROLE = <?= json_encode($_SESSION['user']['role'] ?? 'user') ?>

  fetch(`/instruments/sort?order=${order}`)
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById('products-container');
      container.innerHTML = '';
      if (order === 'asc'){
        data.sort((a,b) => parseFloat(a.price) - parseFloat(b.price));
      } else if (order === 'desc'){
        data.sort((a,b) => parseFloat(b.price) - parseFloat(a.price));
      }
      data.forEach(instr => {
        let html = `
          <div class="col-md-4 mb-4">
            <div class="card" style="width: 18rem;">
              <img src="/images/${instr.image}" class="card-img-top" alt="${instr.name}">
              <div class="card-body">
                <h5 class="card-title">${instr.name}</h5>
                <p class="card-text">${instr.short_text}</p>
                <h5 class="mt-4">Ціна</h5>
                <p class="fs-4 fw-bold text-success">${parseFloat(instr.price).toFixed(2)} грн</p>
                <a href="/instruments/view/${instr.id}" class="btn btn-primary">Детальніше</a>`;
        
          if (USER_ROLE === 'admin') {
          html += `
                <div class="d-flex gap-2 mt-2">
                  <a href="/admininstrument/edit/${instr.id}" class="btn btn-warning btn-sm">Редагувати</a>
                  <a href="/admininstrument/delete/${instr.id}" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей інструмент?')">Видалити</a>
                </div>`;
        } 
        html += `
              </div>
            </div>
          </div>`;
          container.innerHTML += html;
      });
    });
});
</script>