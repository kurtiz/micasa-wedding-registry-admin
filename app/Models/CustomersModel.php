<?php


namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model{

    /**
     * get's the data of all the customers
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getCustomers(array $clauses){
        $builder = $this->db->table("customers");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * @param array $fields is the array of data needed to create a customer
     *
     * @return int|false returns the last entered ID if the operation was successful
     * and returns false otherwise
     */
    public function createCustomer(array $fields) {
        $builder = $this->db->table('customers');
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
    public function updateCustomerImg(array $clauses, array $fields) {
        $builder = $this->db->table('customers');
        $builder->where($clauses);
        $builder->update($fields);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * get's the data of a particular customer
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getCustomer(array $clauses){
        $builder = $this->db->table("customers");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }
}