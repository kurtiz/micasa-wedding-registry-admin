<?php


namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model{

    /**
     * gets the data of all the user roles
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getRoles(array $clauses){
        $builder = $this->db->table("roles");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * gets the data of all the user roles
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function getRole(array $clauses){
        $builder = $this->db->table("roles");
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) == 1) {
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
    public function createUserRole(array $fields) {
        $builder = $this->db->table('roles');
        $builder->insert($fields);
        if ($this->db->affectedRows() == 1) {
            return $this->db->insertID();
        }else {
            return false;
        }
    }

    /**
     * @param array $fields is the array of data needed to create a user
     *
     * @param array $clauses
     * @return bool returns the last entered ID if the operation was successful
     * and returns false otherwise
     */
    public function updateUserRole(array $fields, array $clauses) {
        $builder = $this->db->table('roles');
        $builder->where($clauses);
        $builder->update($fields);
        if ($this->db->error()) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param array $fields is the array of data needed to create a user
     *
     * @param array $clauses
     * @return int|false returns the last entered ID if the operation was successful
     * and returns false otherwise
     */
    public function updateUserRolePermission(array $fields, array $clauses) {
        $builder = $this->db->table('roles_permissions');
        $builder->where($clauses);
        $builder->update($fields);
        if ($this->db->error()) {
            return true;
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
    public function createRolePermission(array $fields) {
        $builder = $this->db->table('roles_permissions');
        $builder->insert($fields);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @return array|bool returns true if the operation was successful and returns false otherwise
     */
    public function getRolePermissions() {
        $builder = $this->db->table('roles_permissions');
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * @param $clauses
     * @return array|bool returns true if the operation was successful and returns false otherwise
     */
    public function getUserRolePermissions($clauses) {
        $builder = $this->db->table('roles_permissions');
        $builder->where($clauses);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * @return array|bool returns true if the operation was successful and returns false otherwise
     */
    public function getPermissions() {
        $builder = $this->db->table('permissions');
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * get's the data of a particular user
     * @param $clauses array|mixed are conditions for search
     * @return array|false returns an array if all conditions are met or returns false otherwise
     */
    public function deleteRole(array $clauses){
        $builder = $this->db->table("roles");
        $builder->where($clauses);
        $builder->delete();
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }
}