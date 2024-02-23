<?php
namespace UHA\Repositories;
use UHA\Services\Database;
use \PDO;
class EmployeeRepository extends Repository{
    
    public function __construct($name){
        parent::__construct($name);
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
} 

?>