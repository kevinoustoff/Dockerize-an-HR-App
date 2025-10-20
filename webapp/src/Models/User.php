<?php
namespace UHA\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends Model
{
    

    /**
     * @ORM\Column(type="string")
     */
    private string $username = '';

    public function __construct()
    {
        parent::__construct();
        $this->setTable("employee");
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        // Exemple avec fetchAll si la méthode execute() est dans Model
        // $statement = $this->execute("SELECT * FROM ".$this->getTable());
        // return $statement->fetchAll(\PDO::FETCH_CLASS, self::class);

        return []; // placeholder si tu n’as pas encore la DB
    }
}
