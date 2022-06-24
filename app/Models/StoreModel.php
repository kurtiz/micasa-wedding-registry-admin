<?php


namespace App\Models;
use CodeIgniter\Model;

class StoreModel extends Model {
    /**
     * get the data of the current store
     * @param $store_id string is the id of the current store
     * @return false|mixed
     */
    public function getStoreData(string $store_id) {
        $builder = $this->db->table("stores_settings");
        $builder->where('store_id',$store_id);
        $result = $builder->get();
        if ($result->resultID->num_rows == 1) {
            return $result->getRow();
        }else {
            return false;
        }
    }

    /**
     * @param $store_id string id the of the current store
     * @param $store_data array|mixed is the set of data to be updated
     * @return bool returns true if the changes were applied else returns false
     */
    public function updateStoreData(string $store_id, array $store_data): bool
    {
        $builder = $this->db->table("stores_settings");
        $builder->where('store_id',$store_id);
        $builder->update($store_data);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * get the data of all the sales of a particular store
     * @param $store_id string is the id of the current store
     * @return array|false returns an array of all the sales of the current store else returns false
     */
    public function getSales(string $store_id){
        $builder = $this->db->table("sales");
        $builder->where('store_id',$store_id);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
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
    public function getCurrentUserSales(string $store_id, string $user_id){
        $builder = $this->db->table("sales");
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
     * gets the top 5 most sold product in terms of quantity
     * @param $store_id string is the id of the current store
     * @return array|false returns an array of all the sales of the current store else returns false
     */
    public function getProductPerformances(string $store_id){
       $builder = $this->db->query(
           "SELECT `product_id`, `product`, `amount`, SUM(`quantity`) as quantity 
            FROM sales_details WHERE `store_id` = '$store_id' GROUP BY `product` ORDER BY 
            `quantity` DESC LIMIT 5"
       );
       $results = $builder->getResult();

       if(count($results)>0){
           return $results;
       }else{
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
        $builder = $this->db->table("sales_details");
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
        $builder = $this->db->table("sales");
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

    /**
     * gets the quantity and amount sales made daily
     * @param string $store_id
     * @return array|false
     */
    public function getSoldQuantityDaily(string $store_id) {
        $builder = $this->db->table("sales_details");
        $builder->where([
            'store_id' => $store_id,
            'date_sold' => date("Y-m-d")
        ]);

        $builder->select(["quantity","amount"]);
        $result = $builder->get();

        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        }else {
            return false;
        }
    }

    /**
     * gets the quantity and the amount sold monthly
     * @param string $store_id
     * @return array|false
     */
    public function getSoldQuantityMonthly(string $store_id) {
        $builder = $this->db->table("sales_details");
        $builder->where([
            'store_id' => $store_id
        ]);
        $builder->like(
            ['date_sold' => date("Y-m")
        ]);

        $builder->select(["quantity","amount"]);
        $result = $builder->get();

        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
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