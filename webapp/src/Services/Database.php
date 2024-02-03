<?php
namespace UHA\Services;
use \PDO;

class Database
{
    private static $instance;
    private $connection;
    private $dotEnv;

    private function __construct()
    {
        $this->dotEnv = (new DotEnv())->parseEnv();
        $this->connection = new PDO("mysql:host=localhost;dbname={$this->dotEnv['DB_NAME']}", $this->dotEnv['DB_USERNAME'],$this->dotEnv['DB_PASSWORD']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}


?>

