<?php
namespace UHA\Models;

use UHA\Repositories\Repository;

abstract class Model
{
    protected string $table = '';
    protected Repository $repository;

     public function __construct()
    {
        // Optionnel : initialisation par défaut
    }

    /**
     * @return array<object>  // ou un type plus précis si possible
     */
    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }
}
