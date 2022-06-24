<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class ProfileModel extends Model {
        
         public function getUserInfo ($user_id) {
//             $builder = $this->db->table("users");
//             $builder->where("user_id", $user_id AND "user");
        //     $result = $builder->get();
            
        //     if ($result->resultID->num_rows == 1) {
        //         return $result->getRowArray();
        //     } else {
        //         return false;
        //     }

         }

        public function updateUserInfo($storeInfo, $profile){
            $builder = $this->db->table("users");
            $builder->where($storeInfo);
            $builder->update($profile);
            if ($this->db->affectedRows() == 1) {
                return true;
            }else {
                return $this->db->error();
            }
        }
    }

