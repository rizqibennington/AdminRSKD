<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table                = 'obat';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $allowedFields        = ['nama_perusahaan', 'nama_obat', 'bentuk', 'tujuan', 'uraian', 'status', 'filepath'];
}
