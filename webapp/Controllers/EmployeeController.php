<?php
    include dirname(__FILE__).'/Controller.php';
    class EmployeeController extends Controller {
        public function list(){
            $holla = ['fin','ger','l'];
            $this->view->setTemplateFile('base.phtml');
            $this->view->set('hello','he');
            $this->view->set('hi',$holla);
            return $this->view->output();
        }

        public function testContent(){
            $this->view->setTemplateFile('index.phtml');
            return $this->view->output();
        }
    }
?>