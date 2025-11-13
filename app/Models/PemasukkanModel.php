<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasukkanModel extends Model
{
    protected $table            = 'pemasukkan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['pengurus_id', 'tanggal', 'sumber', 'jumlah', 'deskripsi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}