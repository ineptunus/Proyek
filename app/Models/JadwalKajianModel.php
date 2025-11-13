<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKajianModel extends Model
{
    protected $table            = 'jadwal_kajian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['pengurus_id', 'tema', 'penceramah', 'lokasi', 'tanggal_waktu', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}