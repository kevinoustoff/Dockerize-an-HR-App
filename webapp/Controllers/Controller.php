<?php
    require dirname(dirname(__FILE__)).'/Views/Template.php';
    class Controller{
        protected $view;
        public function __construct()
        {
            $this->view = new Template();
        }
    }
?>