<?php
    namespace UHA\Controllers;
    use UHA\Controllers\Controller;
    use UHA\Models\Employee;
    use UHA\Models\User;
    use UHA\Repositories\UserRepository;

    class EmployeeController extends Controller {
        public function list(){
            $holla = ['fin','ger','l'];
            $employee = new Employee();
            $employees = $employee->getAll();

            // print_r($employees[0]->FirstName);
            $this->view->setTemplateFile('listEmployee.phtml');
            $this->view->set('hello','he');
            $this->view->set('hi',$holla);
            $this->view->set('employees',$employees);
            return $this->view->output();
        }

        public function testContent(){
            $user = new UserRepository();
            $user->getAll();
            $this->view->setTemplateFile('index.phtml');
            return $this->view->output();
        }
    }
?>