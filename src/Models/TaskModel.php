<?php

namespace Michalsn\CodeIgniterHtmxDemo\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'type'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all tasks.
     */
    public function getAll(?string $type = null): array
    {
        if ($type !== null) {
            $this->where('type', $type);
        }

        return $this->findAll();
    }

    /**
     * Count number of tasks
     */
    public function countByType(string $type): int
    {
        return $this->where('type', $type)->countAllResults();
    }

    /**
     * Delete completed tasks
     */
    public function deleteCompleted(): int
    {
        return $this->where('type', 'completed')->delete();
    }

}
