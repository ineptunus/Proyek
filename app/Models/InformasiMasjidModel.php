<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiMasjidModel extends Model
{
    protected $table            = 'informasi_masjid';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['pengurus_id', 'judul', 'deskripsi', 'tanggal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}