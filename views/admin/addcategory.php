<style>
    .form-container {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fafafa;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
</style>
<div class="form-container">
    <h1>Додати категорію</h1>
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="short_text" class="form-label">Опис</label>
        <textarea class="form-control" name="short_text" required></textarea>
    </div>
    <div class="mb-3">
    <label for="image" class="form-label">Назва зображення (файл має бути в папці images)</label>
    <input type="text" class="form-control" name="image" id="image" placeholder="example.jpg" required>
</div>
    <button type="submit" class="btn btn-primary">Додати</button>
    <a href="/admincategory/index" class="btn btn-secondary">Назад</a>
</form>
</div>
