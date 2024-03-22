<?php
    namespace UHA\Controllers;
    use UHA\Controllers\Controller;
    use UHA\Models\Employee;
    use UHA\Models\User;
    use UHA\Repositories\UserRepository;

    class EmployeeController extends Controller {
        private $employe;


        public function __construct()
        {
            parent::__construct();
            $this->employe = new Employee();
        }
        public function list(){
            $holla = ['fin','ger','l'];
            $employee = new Employee();
            $employees = $employee->getAll();
            $this->view->setTemplateFile("listEmployee.phtml");
            $this->view->set('hello','he');
            $this->view->set('hi',$holla);
            $this->view->set('employees',$employees);
            return $this->view->output();
        }

        public function getSingleEmployee($id){
            $employee = new Employee();
            $employee = $employee->find($id);
            $this->view->setTemplateFile('detailsEmployee.phtml');
            $this->view->set('employee',$employee);
            return $this->view->output();
        }

        public function testContent(){
            $user = new UserRepository();
            $user->getAll();
            $this->view->setTemplateFile('index.phtml');
            return $this->view->output();
        }

        public function editEmploye($id){
            $data["firstname"] = $_POST["firstname"];
            $data["lastname"] = $_POST["lastname"] ;
            $data["email"] = $_POST["email"];
            $data["phone"] = $_POST["phone"];

        
            if($this->employe->edit($id,$data)){
                echo "cc";
                header('Location: /employees');
                
            } 
        }
    }
?>