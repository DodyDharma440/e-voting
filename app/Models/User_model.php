<?php
namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table;

    public function getUser($no_induk)
    {
        $builder = $this->db->table('user');
        $builder->select('*');
        $builder->where('no_induk', $no_induk);
        return $builder->get();
    }
}

?>