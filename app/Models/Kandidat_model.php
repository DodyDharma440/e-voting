<?php
namespace App\Models;

use CodeIgniter\Model;

class Kandidat_model extends Model
{
    public function getKandidat($id = false)
    {
        $builder = $this->db->table('kandidat');
        $builder->select('*');
        $id ? $builder->where('kandidat_id', $id) : null;
        $builder->orderBy('jabatan', 'asc');
        return $builder->get();
    }

    public function saveKandidat($data)
    {
        $query = $this->db->table('kandidat')->insert($data);
        return $query;
    }

    public function updateKandidat($data, $id)
    {
        $query = $this->db->table('kandidat')->update($data, ['kandidat_id' => $id]);
        return $query;
    }

    public function deleteKandidat($id)
    {
        $query = $this->db->table('kandidat')->delete(['kandidat_id' => $id]);
        return $query;
    }
}
?>