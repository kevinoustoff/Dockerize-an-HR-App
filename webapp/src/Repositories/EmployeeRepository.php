<?php
namespace UHA\Repositories;

use UHA\Services\Database;
use UHA\Models\Employee;
use PDO;
use PDOStatement;

class EmployeeRepository extends Repository {

    public function __construct(string $name){
        parent::__construct($name);
    }

    /**
     * @return Employee[]
     */
    public function getAll(): array {
        try {
            $query = "SELECT * FROM ".$this->table." 
                      INNER JOIN contact ON contact.ContactID=".$this->table.".ContactID";
            $statement = $this->execute($query);
            return $statement->fetchAll(PDO::FETCH_CLASS, Employee::class);
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return [];
        }
    }

    public function findOneById(int $id): ?Employee {
        $query = "SELECT emp.EmployeeID as empID, c.ContactID, c.Title, c.FirstName, c.LastName, 
                         EDH.ShiftID, DEP.Name, c.EmailAddress, c.Phone, EDH.StartDate, emp.Title 
                  FROM ".$this->table." as emp
                  INNER JOIN contact c ON c.ContactID = emp.ContactID 
                  INNER JOIN employeedepartmenthistory AS EDH ON EDH.EmployeeID = emp.EmployeeID 
                  INNER JOIN department AS DEP ON DEP.DepartmentID = EDH.DepartmentID
                  WHERE emp.EmployeeID = ".$id." 
                  ORDER BY EDH.ShiftID DESC LIMIT 1";

        $result = $this->find($query);
        return $result instanceof Employee ? $result : null;
    }

    /**
     * @param int $id
     * @param array<string, string> $data
     * @return bool
     */
    public function editEmployee(int $id, array $data): bool {
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