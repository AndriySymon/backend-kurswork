<style>
    .category-card {
        max-width: 300px;
        margin: 0 auto;
        height: 100%;
    }

    .category-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .category-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .category-col {
        margin-bottom: 30px;
    }
</style>

<div class="row justify-content-center">
    <?php foreach ($categories as $category): ?>
        <div class="col-md-3 category-col mb-4">
            <div class="card category-card h-100 d-flex flex-column">
                <img src="/images/<?= htmlspecialchars($category['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($category['name']) ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($category['short_text']) ?></p>
                    <a href="/index.php?route=category/view/<?= urlencode($category['id']) ?>" class="btn btn-outline-primary mt-auto">Переглянути</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
