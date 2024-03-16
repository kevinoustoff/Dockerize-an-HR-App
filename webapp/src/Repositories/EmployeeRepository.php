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
        $query = "SELECT c.Title, c.FirstName, c.LastName, EDH.ShiftID, DEP.Name,c.EmailAddress,c.Phone ,EDH.StartDate,".$this->table.".Title 
        FROM ".$this->table." 
        INNER JOIN contact c ON c.ContactID = ".$this->table.".ContactID 
        INNER JOIN employeedepartmenthistory AS EDH ON EDH.EmployeeID = ".$this->table.".EmployeeID 
        INNER JOIN department AS DEP ON DEP.DepartmentID = EDH.DepartmentID
        WHERE ".$this->table.".EmployeeID = ".$id." ORDER BY EDH.ShiftID DESC LIMIT 1";

        return $this->find($query);
    }
} 

?>