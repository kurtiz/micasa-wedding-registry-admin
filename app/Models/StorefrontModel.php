<?php


namespace App\Models;
use CodeIgniter\Model;


class StorefrontModel extends Model{

    /**
     * @param array $sale
     * @return bool | int
     */
    public function sendSale(Array $sale) {
        $builder = $this->db->table("sales");
        $builder->insert($sale);
        if ($this->db->affectedRows() == 1) {
            return $this->db->insertID();
        }else {
            return false;
        }
    }

    /**
     * @param array $saleDetails
     * @return bool
     */
    public function sendSaleDetails(Array $saleDetails): bool {
        $builder = $this->db->table("sales_details");
        $builder->insert($saleDetails);
        if($this->db->affectedRows() == 1){

            $this->db->transStart();
            $this->db->query(
                'UPDATE `products` SET `quantity` = `quantity` - '.(float)$saleDetails['quantity'].' WHERE `product_id` = "'.$saleDetails['product_id'].'";'
            );
            $this->db->transComplete();
            return $this->db->transStatus();
        }else {
            return false;
        }
    }

    /**
     * @param array $clause
     * @param array $sale
     * @return bool
     */
    public function updateSale(Array $clause, Array $sale): bool {
        $builder = $this->db->table("sales");
        $builder->where($clause);
        $builder->update($sale);
        if ($this->db->affectedRows() == 1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param array $clause
     * @param array $saleDetails
     * @param String $former_quantity
     * @return bool
     */
    public function updateSaleDetails(Array $clause, Array $saleDetails, String $former_quantity): bool {
        $builder = $this->db->table("sales_details");
        $builder->where($clause);
        $builder->update($saleDetails);
        if($this->db->affectedRows() == 1){
            $this->db->transStart();
            $this->db->query(
                'UPDATE `products` SET `quantity` = `quantity` + ' .(float)$former_quantity.' - '.(float)$saleDetails['quantity'].' WHERE `product_id` = "'.$saleDetails['product_id'].'";'
            );
            $this->db->transComplete();
            return $this->db->transStatus();
        }else {
            return false;
        }
    }

    /**
     * @param array $sale
     * @return bool | int
     */
    public function sendCreditSale(Array $sale) {
        $builder = $this->db->table("credit");
        $builder->insert($sale);
        if ($this->db->affectedRows() == 1) {
            return $this->db->insertID();
        }else {
            return false;
        }
    }


    /**
     * @param array $saleDetails
     * @return bool
     */
    public function sendCreditSaleDetails(Array $saleDetails): bool {
        $builder = $this->db->table("credit_sales_details");
        $builder->insert($saleDetails);
        if($this->db->affectedRows() == 1){

            $this->db->transStart();
            $this->db->query(
                'UPDATE `products` SET `quantity` = `quantity` - '.(float)$saleDetails['quantity'].' WHERE `product_id` = "'.$saleDetails['product_id'].'";'
            );
            $this->db->transComplete();
            return $this->db->transStatus();
        }else {
            return false;
        }
    }

    /**
     * @param $clauses
     * @return bool | int
     */
    public function getSalesCount($clauses) {
        $builder = $this->db->table("sales");
        $builder->where($clauses);
        $builder->select("salesCount");
        $builder->orderBy("salesCount", "DESC");
        $builder->limit(1);
        $result = $builder->get();
        if ($result->getRowObject()){
            return $result->getRowObject()->salesCount;
        } else {
            return false;
        }
    }

}