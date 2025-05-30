<style>
    .table-container {
        max-width: 900px;
        margin: 30px auto;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .table-actions {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 15px;
    }
</style>
<div class="table-container">
    <div class="table-actions">
        <a href="/admincategory/add" class="btn btn-success">Додати категорію</a>
    </div>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Зображення</th>
            <th>Опис</th>
            <th>Дії</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= htmlspecialchars($category['id']) ?></td>
                <td><?= htmlspecialchars($category['name']) ?></td>
                <td><img src="/images/<?= htmlspecialchars($category['image']) ?>" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px; display: block;"></td>
                <td><?= htmlspecialchars($category['short_text']) ?></td>
                <td>
                    <a href="/admincategory/edit/<?= $category['id'] ?>" class="btn btn-warning btn-sm">Редагувати</a>
                    <a href="/admincategory/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цю категорію?')">Видалити</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>