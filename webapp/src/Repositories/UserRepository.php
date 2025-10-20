<?php
namespace UHA\Repositories;

use UHA\Services\Database;

class UserRepository {
    protected \PDO $pdo;
    public string $table = 'employee'; 

    public function __construct(){
        $database = new Database();
        $this->pdo =  $database->getPDO();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAll(): array {
        $selectDataSQL = "SELECT * FROM ".$this->table;
        $statement = $this->pdo->query($selectDataSQL);    
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTable(): string {
        return $this->table;
    }

    public function setTable(string $table): self {
        $this->table = $table;
        return $this;
    }
}
?>
