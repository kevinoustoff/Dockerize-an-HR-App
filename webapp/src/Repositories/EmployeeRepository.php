<?php
namespace UHA\Repositories;
use UHA\Services\Database;
use \PDO;
class EmployeeRepository extends Repository{
    
    public function __construct($name){
        parent::__construct($name);
    }

    public function addEmployee(){
    }
    public function getAll(){
        try {
            $pdo = $this->database->getPDO();
            $this->table;
            
            $query = "SELECT * FROM ".$this->table." INNER JOIN contact ON contact.ContactID=".$this->table.".ContactID";
            
            // Prepare and execute the query
            $statement = $pdo->prepare($query);
            $statement->execute();
            
            // Fetch all rows as object class 
            $result = $statement->fetchAll(PDO::FETCH_CLASS, 'UHA\Models\Employee');
            return $result;
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function findOneById($id){
        $query = "SELECT emp.EmployeeID as empID ,c.ContactID, c.Title, c.FirstName, c.LastName, EDH.ShiftID, DEP.Name,c.EmailAddress,c.Phone ,EDH.StartDate,emp.Title 
        FROM ".$this->table." 
         as emp INNER JOIN contact c ON c.ContactID = emp.ContactID 
        INNER JOIN employeedepartmenthistory AS EDH ON EDH.EmployeeID = emp.EmployeeID 
        INNER JOIN department AS DEP ON DEP.DepartmentID = EDH.DepartmentID
        WHERE emp.EmployeeID = ".$id." ORDER BY EDH.ShiftID DESC LIMIT 1";

        return $this->find($query);
    }

    public function editEmployee($id,$data){
        $query = "UPDATE " . $this->table . " 
        INNER JOIN contact c ON c.ContactID = " . $this->table . ".ContactID 
        SET 
        c.FirstName = '" . $data["firstname"] . "', 
        c.LastName = '" . $data["lastname"] . "', 
        c.EmailAddress = '" . $data["email"] . "', 
        c.Phone = '" . $data["phone"] . "' 
        WHERE ".$this->table.".EmployeeID = " . $id;
        return $this->edit($query);

    }
    


} 

?>