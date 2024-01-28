<?php
    include dirname(__FILE__).'/Controller.php';
    class EmployeeController extends Controller {
        public function list(){
            $this->view->setTemplateFile('base.phtml');
            $this->view->set('hello','he');
            return $this->view->output();
        }
    }
?>