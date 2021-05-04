<?php
namespace App\Models;

use CodeIgniter\Model;

class Pilih_model extends Model
{
    public function saveSuara($data)
    {
        $query = $this->db->table('data_pemilihan')->insert($data);
        return $query;
    }

    public function updateStatus($data, $user_id)
    {
        $query = $this->db->table('user')->update($data, ['user_id' => $user_id]);
        return $query;
    }

    public function updateKelas($data, $kelas_id)
    {
        $query = $this->db->table('kelas')->update($data, ['kelas_id' => $kelas_id]);
        return $query;
    }
}
?>