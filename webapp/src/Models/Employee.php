<?php
namespace UHA\Models;

use UHA\Repositories\EmployeeRepository;

class Employee extends Model{
   
    public function __construct()
    {
        $this->table = 'employee';
        $this->repository = new EmployeeRepository($this->table);
    }

    public function getAll(){
        return $this->repository->getAll();
    }

    
    
}
?>