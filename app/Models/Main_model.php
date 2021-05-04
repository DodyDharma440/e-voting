<?php
namespace App\Models;

use CodeIgniter\Model;

class Main_model extends Model
{
    public function getReview()
    {
        $builder = $this->db->table('review');
        $builder->select('*');
        $builder->join('user', 'user_id = user_id_review', 'left');
        $builder->whereIn('tanggapan', ['Bagus', 'Biasa']);
        $builder->orderBy('', 'random');
        $builder->limit('6');
        return $builder->get();
    }
}