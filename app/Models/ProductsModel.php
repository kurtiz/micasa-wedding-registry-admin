<?php

    namespace App\Models;
    use CodeIgniter\Model;

    /**
     * Class ProductsModel
     * @package App\Models
     */
    class ProductsModel extends Model {

        /**
         * @param array $fields is the array of data needed to create a product
         *
         * @return bool returns true if the operation was successful and returns false otherwise
         */
        public function createProduct(array $fields) {
            $builder = $this->db->table('products');
            $builder->insert($fields);
            if ($this->db->affectedRows() == 1) {
                return true;
            }else {
                return false;
            }

        }

        /**
         * @param string | int $barcode is used as the unique identifier for the product to be updated since
         * we are not returning the last enter data ID
         *
         * @param string $store_id is the id of the store where the product can be found
         *
         * @param array $fields is the array of data fields needed to update the product image
         *
         * @return bool returns true if the operation was successful and returns false otherwise
         */
        public function updateProductImg(string $barcode, string $store_id, array $fields) {
            $builder = $this->db->table('products');
            $builder->where('barcode', $barcode);
            $builder->where('store_id', $store_id);
            $builder->update($fields);
            
//            if ($this->db->affectedRows() == 1) {
//                return true;
//            }else {
//                return false;
                return $this->db->affectedRows();
//            }
        }

        /**
         * retrieves data of all products
         * @param string | mixed $store_id is the unique id of the store used to get
         * the products link to that particular store
         *
         * @return array|false returns the products info as an array if the operation was successful
         * and returns false otherwise
         */
        public function getProducts(string $store_id) {
            $builder = $this->db->table("products");
            $builder->where('store_id',$store_id);
            $result = $builder->get();
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            }else {
                return false;
            }
        }

        /**
         * retrieves data of a single product
         * @param string | mixed $store_id is the unique id of the store used to get
         * the products link to that particular store
         *
         * @param int | mixed $product_id is the id of the product to be retrieved
         *
         * @return array|false returns the product info as an array if the operation was successful
         * and returns false otherwise
         */
        public function getProduct(string $store_id, int $product_id) {
            $builder = $this->db->table("products");
            $builder->where('store_id',$store_id);
            $builder->where('product_id',$product_id);
            $result = $builder->get();
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            }else {
                return false;
            }
        }

        /**
         * retrieves barcode of a single product
         * @param string | mixed $store_id is the unique id of the store used to get
         * the products link to that particular store
         *
         * @param int | mixed $product_id is the id of the product to be retrieved
         *
         * @return int | string | false returns the product's barcode as an integer or string if the operation was
         * successful and returns false otherwise
         */
        public function getBarcode(string $store_id, int $product_id) {
            $builder = $this->db->table("products");
            $builder->where('store_id',$store_id);
            $builder->where('product_id',$product_id);
            $builder->select('barcode');
            $result = $builder->get();
            $barcode = $result->getRow()->barcode;
            if (isset($barcode)) {
                return $barcode;
            }else {
                return false;
            }
        }

        /**
         * @param $clauses array | mixed conditions for delete the product
         * @return bool returns true if successful or returns false otherwise
         */
        public function deleteProduct(array $clauses){
            $builder = $this->db->table("products");
            $builder->where($clauses);
            $builder->delete();
            if ($this->db->affectedRows() == 1){
                return true;
            }else {
                return false;
            }
        }

        /**
         * @param $clause array | mixed condition to validate barcode number
         * @return bool returns true if it exists or false otherwise
         */
        public function barcodeExists(array $clause){
            $builder = $this->db->table("products");
            $builder->where($clause);
            $result = $builder->get();

            if (count($result->getResultArray()) > 0) {
                return true;
            }else {
                return false;
            }
        }



//************************* Category Models ******************************************//
        /**
         * updates single product info
         * @param array $clauses where conditions in a form of an array
         * @param array $fields field data to tb passed to the database
         * @return bool returns true if successful and false otherwise
         */
        public function updateProduct(array $clauses, array $fields){
            $builder = $this->db->table('products');
            $builder->where($clauses);
            $builder->update($fields);

            if ($this->db->affectedRows() == 1) {
                return true;
            }else {
                return false;
            }
        }

        /**
         * @param array $fields is the array of data needed to create a category
         *
         * @return int|false returns the last entered ID if the operation was successful
         * and returns false otherwise
         */
        public function createCategory(array $fields) {
            $builder = $this->db->table('category');
            $builder->insert($fields);
            if ($this->db->affectedRows() == 1) {
                return $this->db->insertID();
            }else {
                return false;
            }
            
        }

        /**
         * @param string|mixed $cat_id is the id of the category whose image is being updated
         *
         * @param array $fields is the data needed to update image info
         *
         * @return bool returns true if the operation was successful and returns false otherwise
         */
        public function updateCategoryImg(string $cat_id, array $fields) {
            $builder = $this->db->table('category');
            $builder->where('cat_id', $cat_id);
            $builder->update($fields);
            if ($this->db->affectedRows() == 1) {
                return true;
            }else {
                return false;
            }
        }

        /**
         * @param string|mixed $store_id is the id of the store the category is linked to
         *
         * @return array|false returns an array of the categories if the operation was successful
         * and returns false otherwise
         */
        public function getCategories(string $store_id) {
            $builder = $this->db->table("category");
            $builder->where('store_id',$store_id);
            $result = $builder->get();
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            }else {
                return false;
            }
        }



    }