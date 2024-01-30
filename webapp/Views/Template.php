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
    function getExtendedFileName($extendsDirective)
    {
        // Extract the file name enclosed in single quotes
        preg_match("/'([^']+)'/", $extendsDirective, $matches);
        
        // Return the matched file name
        return isset($matches[1]) ? $matches[1] : null;
    }
    public function output() {
        $templateContent = file_get_contents(dirname(__FILE__).'/'.$this->templateFile);
        $childTemplateContent = file_get_contents(dirname(__FILE__).'/'.$this->templateFile);
        // Find and extract the @extends directive
        preg_match('/@extends\((.*?)\)/', $childTemplateContent, $matches);
        $extendedFileName = $this->getExtendedFileName($matches[1]);
        echo $matches[0];
        die(); 

        

        foreach ($this->data as $key => $value) {

            if (is_array($value)) {
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