<?php

    namespace App\Models;
    use CodeIgniter\Model;

    /**
     * Class DashboardModel
     * @package App\Models
     */
    class DashboardModel extends Model {

        /**
         *
         * @param string $user_id is the unique identifier to get
         * the data of a specific user
         * @return false|mixed returns the data of the user of returns false if
         * the user doesn't not exist
         *
         * @link https://instagram.com/brakhobbykurtiz Author Profile
         */
        public function getLoggedUserData(string $user_id) {
            
            $builder = $this->db->table("users");
            $builder->where('user_id',$user_id);
            $result = $builder->get();

            if ($result->resultID->num_rows == 1) {

                return $result->getRow();

            }else {

                return false;

            }
        }

        /**
         *
         * @param string | mixed $store_id is the unique identifier for the current store
         * @return false|mixed returns an array of the data of the current store
         * and return false otherwise
         */
        public function getLoggedStoreData(string $store_id) {
            
            $builder = $this->db->table("stores_settings");
            $builder->where('store_id',$store_id);
            $result = $builder->get();

            if ($result->resultID->num_rows == 1) {

                return $result->getRow();

            }else {

                return false;

            }
        }
    }

?>