<?php
namespace UHA\Services;
use \PDO;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class Database
{
    
    
    private static ?self $instance = null;         
    private ?\Doctrine\DBAL\Connection $connection = null;
    /** @var array<string, string> */ 
    private array $dotEnv = [];                    
    private ?EntityManager $entityManager = null;  

    public function __construct()
    {
        $this->dotEnv = (new DotEnv())->parseEnv();
        
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'user'     => $this->dotEnv['DB_USERNAME'],
            'password' => $this->dotEnv['DB_PASSWORD'],
            'dbname'   => $this->dotEnv['DB_NAME'],
            'port'     => '3308',
            'useSimpleAnnotationReader' => false,

        ];

        
        $paths = [dirname(dirname(__FILE__)).'\Models'];

        $isDevMode = false;
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $paths,
            $isDevMode
        );
        //ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
        //$isDevMode = false;
        // $this->setConnection(DriverManager::getConnection($dbParams, $config))  ;
        $this->setEntityManager( \Doctrine\ORM\EntityManager::create($dbParams, $config));
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO(): ?PDO
    {
        try {
        $pdo = new PDO(
            "mysql:host={$this->dotEnv['DB_HOST']};port={$this->dotEnv['DB_PORT']};dbname={$this->dotEnv['DB_NAME']};charset=utf8",
            $this->dotEnv['DB_USERNAME'],
            $this->dotEnv['DB_PASSWORD']
        );
            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo 'connection';
             return $pdo;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return null;
    }

    public function getConnection(): ?\Doctrine\DBAL\Connection
    {
        return $this->connection;
    }

    /**
     * Get the value of entityManager
     */ 
    public function getEntityManager(): ?EntityManager
    {
        return $this->entityManager;
    }

    /**
     * Set the value of connection
     *
     * @return  self
     */ 
    public function setConnection(\Doctrine\DBAL\Connection $connection): self
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */ 
    public function setEntityManager(EntityManager $entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}


