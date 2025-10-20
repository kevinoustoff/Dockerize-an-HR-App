<?php
namespace UHA\Models;

use UHA\Repositories\EmployeeRepository;


#[\AllowDynamicProperties]
class Employee extends Model{
    
   
    public function __construct()
    {
        $this->table = 'employee';
        $this->repository = new EmployeeRepository($this->table);
    }

   /**
     * @return Employee[]
     */
    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    /**
     * Récupère un employé avec ses détails par son ID
     * @param int $id
     * @return Employee|null
     */
    public function find($id){
        /** @var EmployeeRepository $repo */
        $repo = $this->repository;
        $repo->findOneById($id);

        return  $repo->findOneById($id);
    }

    /**
     * Met à jour les informations d'un employé
     *
     * @param int $id
     * @param array<string, string> $data ['firstname' => string, 'lastname' => string, 'email' => string, 'phone' => string]
     * @return bool
 */
    public function edit($id,$data){
        /** @var EmployeeRepository $repo */
        $repo = $this->repository;
        return $repo->editEmployee($id,$data);
    }

    
    
}
?>