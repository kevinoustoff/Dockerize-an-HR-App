<?php
    namespace Routes;
    use \UHA\Controllers\EmployeeController;
    use \UHA\Controllers\Api\EmployeeController as ApiEmployeeController;
    use \UHA\Routing\Web;

    class Processor{
        public function __construct()
        {
            $router = new Web();

            $router->addPrefix('/api', function() use ($router) {
                $router->addRoute('GET', '/employee/{id}', function($id) {
                    return (new ApiEmployeeController())->getSingleEmployee($id);
                });
            });
            $router->addRoute('GET', '/employees', function () {
                return (new EmployeeController())->list();
            });
            $router->addRoute('GET','/employee/{id}', function($id){
                return (new EmployeeController())->getSingleEmployee($id);
            });
            $router->addRoute('POST','/edit-employees/{id}', function($id){
                return (new EmployeeController())->editEmploye($id);
            });
            $router->addRoute('GET', '/employee/test', function () {
                return (new EmployeeController())->testContent();
            });

            $router->processRequest();
        }
    }
   
    
?>