<?php
if (!isset($Content)) {
    header("HTTP/1.0 404 Not Found");
    exit("404 - Сторінка не знайдена");
}
/**@var string $Title */
/**@var string $Content */
if (empty($Title))
    $Title = '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$Title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </head>
  <body>
    <header class="p-3 text-bg-dark"> 
        <div class="container"> 
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start"> 
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"> 
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use></svg> </a> 
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"> 
                            <li><a href="/" class="nav-link px-2 text-secondary">Головна</a></li> 
                            <li><a href="/index.php?route=category/allcategories" class="nav-link px-2 text-white">Категорії</a></li> 
                            <li><a href="/instruments/index" class="nav-link px-2 text-white">Інструменти</a></li> 
                            <li><a href="/site/about" class="nav-link px-2 text-white">Про нас</a></li> 
                        </ul> 
                        <div class="text-end"> 
                        <?php if (!isset($_SESSION['user'])): ?>
                            <a href="/auth/login" class="btn btn-outline-light me-2">Увійти</a>
                            <a href="/auth/signup" class="btn btn-warning">Зареєструватись</a>
                        <?php else: ?>
                        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/admininstrument/add" class="btn btn-success me-2">Додати інструмент</a>
                        <?php endif; ?>
                        <a href="/account/profile" class="btn btn-info">Акаунт</a>
                        <a href="/cart/index" class="btn btn-primary">Кошик</a>
                        <a href="/auth/logout" class="btn btn-danger">Вийти</a>  
                        <?php endif; ?>
                        </div>
                </div> 
            </div> 
        </header>
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-success"><?= $_SESSION['flash'] ?></div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <div>
            <h1><?=$Title ?></h1>
            <?=$Content ?>
        </div>
    <footer class="py-3 my-4"> 
        <ul class="nav justify-content-center border-bottom pb-3 mb-3"> 
            <li class="nav-item"><a href="/" class="nav-link px-2 text-body-secondary">Головна</a></li> 
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Категорії</a></li> 
            <li class="nav-item"><a href="/instruments/index" class="nav-link px-2 text-body-secondary">Інструменти</a></li> 
            <li class="nav-item"><a href="/site/about" class="nav-link px-2 text-body-secondary">Про нас</a></li> 
        </ul> 
        <p class="text-center text-body-secondary">© 2025 MusicWay</p> 
    </footer>
  </body>
</html>