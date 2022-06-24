<?php
namespace App\Models;
use CodeIgniter\Model;

class LoginModel extends Model{

    public function verifyUsername($username) {
        $builder = $this->db->table('users');
        $builder->select("status, username, name, passkey, user_id, store_id");
        $builder->where('username', $username);
        $result = $builder->get();

        if ($result->resultID->num_rows == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function verifyStore($store_id) {
        $builder = $this->db->table('stores_settings');
        $builder->select("status");
        $builder->where('store_id', $store_id);
        $result = $builder->get();

        if ($result->resultID->num_rows == 1) {
            $_ = json_decode(json_encode($result->getRowArray()), true);
            if ($_['status'] =='active') {
                return true;
            }else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUuid($username){

        $builder = $this->db->table('users');
        $builder->select("uniid, activation_date");
        $builder->where("username", $username);
        $result = $builder->get();

        if ($result->resultID->num_rows == 1) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function setUuid($username, $clause){
        $builder = $this->db->table('users');
        $builder->where("username", $username);
        $builder->update($clause);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }
}
