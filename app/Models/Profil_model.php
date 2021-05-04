<?php
namespace App\Models;

use CodeIgniter\Model;

class Profil_model extends Model
{
    public function getAdmin()
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('level', 'admin');
        return $builder->get();
    }

    public function updateNama($data, $id)
    {
        $query = $this->db->table('user')->update($data, ['user_id' => $id]);
        return $query;
    }

    public function deleteAkun($id)
    {
        $query = $this->db->table('user')->delete(['user_id' => $id]);
        return $query;
    }

    public function getPassword($id)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('user_id', $id);
        return $builder->get();
    }

    public function updatePassword($data, $id)
    {
        $query = $this->db->table('user')->update($data, ['user_id' => $id]);
    }
}
?>