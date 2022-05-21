<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    protected $table = 'orang';
    protected $useTimestamps = true;

    // memberikan field yang akan diizinkan diinputkan
    protected $allowedFields = ['nama', 'alamat'];

    // membuat search keyword 
    public function search($keyword)
    {
        // dengan cara terpisah
        // $builder = $this->table('orang');
        // $builder->like('nama', $keyword);
        // return $builder;

        // dengan cara di chaining
        return $this->table('orang')->like('nama', $keyword);
        // d($this->table('orang')->like('nama', $keyword));
    }

    public function getOrang($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
