<?php
namespace App\Models;

use CodeIgniter\Model;

class Pelaksanaan_model extends Model
{
    public function getEvents()
    {
        $builder = $this->db->table('pelaksanaan');
        $builder->select('*');
        return $builder->get();
    }

    public function saveWaktu($data)
    {
        $query = $this->db->table('pelaksanaan')->insert($data);
        return $query;
    }

    public function updateWaktu($data, $id)
    {
        $query = $this->db->table('pelaksanaan')->update($data, ['pelaksanaan_id' => $id]);
        return $query;
    }
}
?>