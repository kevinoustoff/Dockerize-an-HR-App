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

            if (is_array($value)) {
                // Use a different placeholder for arrays, e.g., ::hi_array
                $value = json_encode($value);
                $templateContent = str_replace("::$key", $value, $templateContent);
            } else{
                $templateContent = str_replace("::$key", $value, $templateContent);
            }
           
        }
        //echo $templateContent;
         //die();
         eval('?>'.$templateContent.'<?php ');
        
    }

    
}
?>