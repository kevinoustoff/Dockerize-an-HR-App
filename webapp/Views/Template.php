<?php
class Template {
    private $templateFile;
    private $data = [];

    public function __construct() { 
        
    }

    public function setTemplateFile($templateFile){
        $this->templateFile = $templateFile;
    }

    public function set($key, $value) {
        $this->data[$key] = $value;
    }

    public function get($key) {
        if (!isset($this->data[$key])) {
            throw new \Exception("Variable '$key' is not set");
        }

        return $this->data[$key];
    }
    public function output() {
        $templateContent = file_get_contents(dirname(__FILE__).'/'.$this->templateFile);

        foreach ($this->data as $key => $value) {
            $templateContent = str_replace("::$key", $value, $templateContent);
        }

        return $templateContent;
    }

    
}
?>