<?php
    namespace UHA\Controllers\Api;
    use UHA\Controllers\Controller;
    use UHA\Models\Employee;
    use UHA\Models\User;
    use UHA\Repositories\UserRepository;

    class EmployeeController extends Controller {
        

        /**
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }
        
        /**
         * Récupère un employé par son ID et retourne la réponse en JSON.
         *
         * @param int $id
         * @return string JSON représentant l'employé, ou '{}' si non trouvé
         */
        public function getSingleEmployee($id){
            $employee = new Employee();
            $employee = $employee->find($id);
            $response = json_encode($employee);

            return $response;
        }
    }
?>