<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemilih_model extends Model
{
    //Kelas model
    public function getKelas($kelas_id = false)
    {
        $builder = $this->db->table('kelas');
        $builder->select('*');
        if ($kelas_id) {
            $builder->where('kelas_id', $kelas_id);
        } /*else {
            $builder->join('user', 'kelas_id = kelas_id_user', 'left');
            $builder->groupBy('status');
            $builder->select('count(status) as total');
        }*/
        $builder->orderBy('tingkat, nama_kelas', 'asc');
        return $builder->get();
    }

    public function checkData($tingkat, $nama_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('*');
        $builder->where('tingkat', $tingkat);
        $builder->where('nama_kelas', $nama_kelas);
        return $builder->get();
    }

    public function addKelas($data)
    {
        $query = $this->db->table('kelas')->insert($data);
        return $query;
    }

    public function deleteKelas($id)
    {
        $query = [
            $this->db->table('kelas')->delete(['kelas_id' => $id]),
            $this->db->table('user')->delete(['kelas_id_user' => $id])
        ];
        return $query;
    }

    public function updateKelas($data, $id)
    {
        $query = $this->db->table('kelas')->update($data, ['kelas_id' => $id]);
        return $query;
    }
    //End Kelas model

    //Anggota model
    public function getUser($id = false)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('user_id', $id);
        return $builder->get();
    }

    public function getAnggota($id)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('kelas_id_user', $id);
        $builder->orderBy('no_a', 'asc');
        return $builder->get();
    }

    public function checkNomor($nomor)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('no_induk', $nomor);
        return $builder->get();
    }

    public function namaKelas($id)
    {
        $builder = $this->db->table('kelas')->select('*')->where('kelas_id', $id);
        return $builder->get();
    }

    public function addAnggota($data)
    {
        $query = $this->db->table('user')->insert($data);
        return $query;
    }

    public function updateAnggota($data, $id)
    {
        $query = $this->db->table('user')->update($data, ['user_id' => $id]);
        return $query;
    }

    public function deleteAnggota($id)
    {
        $query = $this->db->table('user')->delete(['user_id' => $id]);
        return $query;
    }
    //End Anggota model
}
