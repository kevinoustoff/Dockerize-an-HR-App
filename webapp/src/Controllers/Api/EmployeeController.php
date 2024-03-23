<?php
    namespace UHA\Controllers\Api;
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
        
        public function getSingleEmployee($id){
            $employee = new Employee();
            $employee = $employee->find($id);
            $response = json_encode($employee);

            return $response;
        }
    }
?>