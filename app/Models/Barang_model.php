<?php 

namespace App\Models;

use CodeIgniter\Model;

class Barang_model extends Model{

    protected $table = "barang";

    public function getBarang($id = null){
        if($id == null){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id])->getRowArray();
        }
    }

    public function insertBarang($data){
        $query = $this->db->table($this->table)->insert($data);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function updateBarang($data, $id){
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function deleteBarang($id){
        return $this->db->table($this->table)->delete(['id' => $id]);
    }


}

?>