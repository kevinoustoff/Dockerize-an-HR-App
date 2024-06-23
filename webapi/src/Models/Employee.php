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

    public function find($id){
        return $this->repository->findOneById($id);
    }

    public function edit($id,$data){
        return $this->repository->editEmployee($id,$data);
    }

    
    
}
?>