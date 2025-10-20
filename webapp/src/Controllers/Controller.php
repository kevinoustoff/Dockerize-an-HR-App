<?php
    namespace UHA\Controllers;
    use Views\Template;
    use Http\Web;
    
    class Controller{
        protected Template $view;
        public function __construct()
        {
            $this->view = new Template();
        }
    }
?>