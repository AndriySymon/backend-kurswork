<?php
namespace core;

class Controller{
    protected $template;
    public function __construct(){
        $action = Core::get()->actionName;
        $module = Core::get()->moduleName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);
    }
    public function render($params = [], $customPath = null)
    {
    if ($customPath !== null) {
        $this->template = new Template("views/{$customPath}.php");
    }

    $this->template->setParams($params);

    return [
        'Content' => $this->template->getHTML()
    ];
    }
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}