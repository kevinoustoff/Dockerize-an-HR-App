<?php
namespace UHA\Repositories;

use UHA\Services\Database;
use \PDOStatement;
use UHA\Models\Employee;

abstract class Repository {
    protected string $table; 
    protected Database $database;
    /**
     * @return Employee[]   // tableau d’objets Employee
     */
    abstract public function getAll(): array;

    public function __construct(string $table) {
        $this->database = new Database();
        $this->table = $table;
    }

    public function find(string $query): ?object {
        try {
            $statement = $this->execute($query);
            $result = $statement->fetch(\PDO::FETCH_OBJ);
            return $result ?: null;
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return null;
        }
    }

    public function execute(string $query): PDOStatement {
        $pdo = $this->database->getPDO();
        if ($pdo === null) {
            throw new \RuntimeException("PDO connection is null");
        }

        $statement = $pdo->prepare($query);
        $statement->execute();

        return $statement;
    }

    public function edit(string $query): bool {
        try {
            $statement = $this->execute($query);
            $rowCount = $statement->rowCount();
            return $rowCount > 0;
        } catch (\PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }
}
