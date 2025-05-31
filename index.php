<?php
session_start();
include('core/Router.php');
require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(static function ($className){
    $path = str_replace('\\', '/', $className.'.php');
    if (file_exists($path))
        include_once($path);
});

if (isset($_GET['route']))
    $route = $_GET['route'];
else
    $route = '';

try{
$core = \core\Core::get();
$core->run($route);
$core->done();
}catch (Throwable $e){
    \core\Core::get()->router->error(500);
}
