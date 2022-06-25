<?php


namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model {
     /**
     * get the data of all the sales of a particular store
     * @param $store_id string is the id of the current store
     * @return array|false returns an array of all the sales of the current store else returns false
     */
    public function getSales(string $store_id){
        $builder = $this->db->table("orders");
        $builder->where('store_id',$store_id);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * gets the data of a particular sales
     * @param $store_id string is the id of the current store
     * @param $sales_id int|string|mixed is the id of the sale
     * @return array|false returns an array of details of the sale
     */
    public function getSalesDetails(string $store_id, $sales_id) {
        $builder = $this->db->table("order_details");
        $builder->where([
            'store_id' => $store_id,
            'sales_id' => $sales_id
        ]);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * gets the data of a particular sales
     * @param $store_id string is the id of the current store
     * @param $sales_id int|string|mixed is the id of the sale
     * @return array|false returns an array of details of the sale
     */
    public function getSale(string $store_id, $sales_id) {
        $builder = $this->db->table("orders");
        $builder->where([
            'store_id' => $store_id,
            'sales_id' => $sales_id
        ]);
        $result = $builder->get();
        if ($result->resultID->num_rows == 1) {
            return $result->getRow();
        }else {
            return false;
        }
    }

    /**
     * @param $clauses array | mixed conditions for delete the product
     * @return bool returns true if successful or returns false otherwise
     */
    public function deleteSale(array $clauses){
        $builder = $this->db->table("sales");
        $builder->where($clauses);
        $builder->delete();
        if ($this->db->affectedRows() == 1){
            return true;
        }else {
            return false;
        }
    }

    /**
     * deletes sale details
     * @param $clauses array | mixed conditions for delete the product
     * @return bool returns true if successful or returns false otherwise
     */
    public function deleteSaleDetails(array $clauses): bool {
        $builder = $this->db->table("sales_details");
        $builder->where($clauses);
        $builder->delete();
        if ($this->db->affectedRows() > 0){
            return true;
        }else {
            return false;
        }
    }

    //********* Credit Sales Methods ************//

    /**
     * get the data of all the sales of a particular store
     * @param $store_id string is the id of the current store
     * @return array|false returns an array of all the sales of the current store else returns false
     */
    public function getCreditSales(string $store_id){
        $builder = $this->db->table("credit");
        $builder->where('store_id',$store_id);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * @param $clauses array | mixed conditions for delete the product
     * @return bool returns true if successful or returns false otherwise
     */
//    public function deleteCredit(array $clauses){
//        $builder = $this->db->table("credit");
//        $builder->where($clauses);
//        $builder->delete();
//        if ($this->db->affectedRows() == 1){
//            return true;
//        }else {
//            return false;
//        }
//    }

    /**
     * gets the data of a particular sales
     * @param $store_id string is the id of the current store
     * @param $sales_id int|string|mixed is the id of the sale
     * @return array|false returns an array of details of the sale
     */
    public function getCreditSale(string $store_id, $sales_id) {
        $builder = $this->db->table("credit");
        $builder->where([
            'store_id' => $store_id,
            'sales_id' => $sales_id
        ]);
        $result = $builder->get();
        if ($result->resultID->num_rows == 1) {
            return $result->getRow();
        }else {
            return false;
        }
    }

    /**
     * @param $clauses array | mixed conditions for delete the product
     * @return bool returns true if successful or returns false otherwise
     */
    public function deleteCreditSale(array $clauses){
        $builder = $this->db->table("credit");
        $builder->where($clauses);
        $builder->delete();
        if ($this->db->affectedRows() == 1){
            return true;
        }else {
            return false;
        }
    }


    /**
     * deletes credit sale details
     * @param $clauses array | mixed conditions for delete the product
     * @return bool returns true if successful or returns false otherwise
     */
    public function deleteCreditSaleDetails(array $clauses){
        $builder = $this->db->table("credit_sales_details");
        $builder->where($clauses);
        $builder->delete();
        if ($this->db->affectedRows() > 0){
            return true;
        }else {
            return false;
        }
    }


    /**
     * get the data of all the sales of a particular store
     * @param $store_id string is the id of the current store
     * @param string $user_id is the id of the current user
     * @return array|false returns an array of all the sales of the current store else returns false
     */
    public function getCurrentUserCreditSales(string $store_id, string $user_id){
        $builder = $this->db->table("credit");
        $builder->where([
            'store_id'=>$store_id,
            'user_id'=>$user_id
        ]);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }


    /**
     * gets the data of a particular sales
     * @param $store_id string is the id of the current store
     * @param $sales_id int|string|mixed is the id of the sale
     * @return array|false returns an array of details of the sale
     */
    public function getCreditSalesDetails(string $store_id, $sales_id) {
        $builder = $this->db->table("credit_sales_details");
        $builder->where([
            'store_id' => $store_id,
            'sales_id' => $sales_id
        ]);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

}