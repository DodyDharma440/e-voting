<?php

namespace App\Models;

use CodeIgniter\Model;

class Hitung_model extends Model
{
    public function getHasil($jabatan = false)
    {
        $builder = $this->db->table('kandidat');
        $builder->select('*');
        $builder->join('data_pemilihan', 'kandidat_id = kandidat_id_pilihan', 'left');
        $jabatan ? $builder->where('jabatan', $jabatan) : false;
        $builder->groupBy('kandidat_id');
        $builder->select('count(kandidat_id_pilihan) as suara');
        $builder->orderBy('jabatan, no_urut', 'asc');
        return $builder->get();
    }
}
