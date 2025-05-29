<?php

namespace core;

class Template
{
    protected $templateFilePath;
    protected $paramsArray;
        protected $layoutPath = null;
    public function __set($name, $value){
        Core::get()->template->setParam($name, $value);
    }
    public function __construct($templateFilePath, $params = []){
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
        $this->setParams($params);
    }
    public function setTemplateFilePath($path){
        $this->templateFilePath = $path;
    }
    public function setLayout($layoutPath){
        $this->layoutPath = $layoutPath;
    }
    public function setParam($paramName, $paramValue){
        $this->paramsArray[$paramName] = $paramValue;
    }
    public function setParams($params){
    if (!is_array($params) && !is_object($params)) {
        return;
    }
    foreach ($params as $key => $value)
        $this->setParam($key, $value);
    }
    public function getHTML(){
        ob_start();

        extract($this->paramsArray);
        include($this->templateFilePath);
        $content = ob_get_clean();

        if ($this->layoutPath) {
            ob_start();
            extract($this->paramsArray);
            include($this->layoutPath);
            return ob_get_clean();
        }
        return $content;
    }
    public function display(){
        echo $this->getHTML();
    }
}