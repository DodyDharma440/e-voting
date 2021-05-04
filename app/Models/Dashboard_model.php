<?php
namespace App\Models;

use CodeIgniter\Model;

class Dashboard_model extends Model
{

    public function getLevel()
    {
        $builder = $this->db->table('user');
        $builder->select('user_id');
        $builder->where('level', 'pemilih');
        return $builder->get();
    }

    public function getStatus()
    {
        $builder = $this->db->table('user');
        $builder->select('user_id');
        $builder->where('status', 'Sudah Memilih');
        return $builder->get();
    }

    public function getKandidat()
    {
        $builder = $this->db->table('kandidat');
        $builder->select('*');
        $builder->join('data_pemilihan', 'kandidat_id_pilihan = kandidat_id', 'left');
        $builder->groupBy('kandidat_id');
        $builder->select('count(kandidat_id_pilihan) as total');
        $builder->orderBy('no_urut', 'asc');
        return $builder->get();
    }

    public function getPemilih()
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->groupBy('status');
        $builder->where('level', 'pemilih');
        $builder->select('count(*) as total');
        return $builder->get();
    }

    public function newPemilih()
    {
        $builder = $this->db->table('data_pemilihan');
        $builder->select('pemilihan_id, kandidat_id_pilihan, waktu, kandidat_id, pasangan');
        $builder->join('kandidat', 'kandidat_id = kandidat_id_pilihan', 'left');
        $builder->orderBy('waktu', 'desc');
        $builder->limit('6');
        return $builder->get();
    }
}