<?php
    namespace UHA\Controllers\Api;
    use UHA\Controllers\Controller;
    use UHA\Models\Employee;
    use UHA\Models\User;
    use UHA\Repositories\UserRepository;

    class EmployeeController  {
        private $employe;


        public function __construct()
        { 
            $this->employe = new Employee();
        }

        public function getListeEmployee(){
            $employee = new Employee();
            $liste = $employee->getAll();
            $response = json_encode($liste);
            header("Content-Type: application/json");
            return $response;
        }
        
        public function getSingleEmployee($id){
            $employee = new Employee();
            $employee = $employee->find($id);
            $response = json_encode($employee);

            header("Content-Type: application/json");
            return $response;
        }
    }
?>