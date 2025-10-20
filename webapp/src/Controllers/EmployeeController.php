<?php
    namespace UHA\Controllers;
    use UHA\Controllers\Controller;
    use UHA\Models\Employee;
    use UHA\Models\User;
    use UHA\Repositories\UserRepository;
    use  Views\Template;

    class EmployeeController extends Controller {
        private Employee $employe;


        public function __construct()
        {
            parent::__construct();
            $this->employe = new Employee();
        }

       /**
         * 
         * @return Template|string
         * 
         */   
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
        /**
         * Récupère un employé par son ID et renvoie la vue correspondante.
         *
         * @param int $id
         * @return Template|string
         * 
         */
        public function getSingleEmployee($id){
            $employee = new Employee();
            $employee = $employee->find($id);
            $this->view->setTemplateFile('detailsEmployee.phtml');
            $this->view->set('employee',$employee);
            return $this->view->output();
        }
        /**
         * @return Template|string
         */
        public function testContent(){
            $user = new UserRepository();
            $user->getAll();
            $this->view->setTemplateFile('index.phtml');
            return $this->view->output();
        }

       /**
         * @return void
         */
        public function editEmploye(int $id): void
        {
            $data = [];
            $data["firstname"] = $_POST["firstname"];
            $data["lastname"]  = $_POST["lastname"];
            $data["email"]     = $_POST["email"];
            $data["phone"]     = $_POST["phone"];

            if ($this->employe->edit($id, $data)) {
                echo "cc";
                header('Location: /employees');
                exit; // toujours mettre exit après header redirection
            } 
        }
    }
?>