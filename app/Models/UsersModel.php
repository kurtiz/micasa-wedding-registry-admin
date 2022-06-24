<?php


namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{

    /**
     * gets the data of all the users
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getUsers(array $clauses){
        $builder = $this->db->table("users");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * @param array $fields is the array of data needed to create a user
     *
     * @return int|false returns the last entered ID if the operation was successful
     * and returns false otherwise
     */
    public function createUser(array $fields) {
        $builder = $this->db->table('users');
        $builder->insert($fields);
        if ($this->db->affectedRows() == 1) {
            return $this->db->insertID();
        }else {
            return false;
        }
    }

    /**
     * @param array|mixed $clauses are the conditions needed to update the image
     *
     * @param array $fields is the data needed to update image info
     *
     * @return bool returns true if the operation was successful and returns false otherwise
     */
    public function updateUserImg(array $clauses, array $fields) {
        $builder = $this->db->table('users');
        $builder->where($clauses);
        $builder->update($fields);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * get's the data of a particular user
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getUser(array $clauses){
        $builder = $this->db->table("users");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * checks database to validate new usernames to prevent duplication
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function validateUser(array $clauses){
        $builder = $this->db->table("users");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return false;
        }else {
            return true;
        }
    }

}