<?php


    namespace App\Controllers;
    use App\Models\OrdersModel;
    use App\Models\RolesModel;
    use CodeIgniter\Config\Config;
    use CodeIgniter\Controller;
    use App\Models\DashboardModel;
    use App\Models\ProductsModel;
    use App\Models\StorefrontModel;
    use App\Models\StoreModel;
    use App\Models\CustomersModel;
    use CodeIgniter\HTTP\RedirectResponse;

    /**
     * Class Store
     * @package App\Controllers
     */
    class Orders extends Controller{

        /**
         * an instance of the DashboardModel Class
         * @var object $dashModel
         */
        public $dashModel;

        /**
         * an instance of the ProductsModel Class
         * @var object $productsModel
         */
        public $productsModel;

        /**
         * an instance of the StorefrontModel Class
         * @var object $storefrontModel
         */
        public $storefrontModel;

        /**
         * an instance of the StoreModel Class
         * @var object $storeModel
         */
        public $storeModel;

        /**
         * an instance of the CustomersModel Class
         * @var object $customersModel
         */
        public $customersModel;

        /**
         * an instance of the RolesModel Class
         * @var object $rolesModel
         */
        public $rolesModel;

        /**
         * an instance of the RolesModel Class
         * @var object $rolesModel
         */
        public $ordersModel;

        /**
         * user id of the logged user
         * @var array|string|null
         */
        public $user_id;

        /**
         * store id of the current store
         * @var array|string|null
         */
        public $store_id;

        /**
         * array of the data of the current logged user
         * @var false|mixed
         */
        public $userdata;

        /**
         * object class of the data of the current logged store
         * @var false|mixed
         */
        public $store_data;

        /**
         * Store Class constructor.
         */
        public function __construct() {
            $this->dashModel = new DashboardModel();
            $this->productsModel = new ProductsModel();
            $this->storefrontModel = new StorefrontModel();
            $this->storeModel = new StoreModel();
            $this->customersModel = new CustomersModel();
            $this->rolesModel = new RolesModel();
            $this->ordersModel = new OrdersModel();
            $this->user_id = session()->get("user_id");
            $this->store_id = session()->get("store_id");
            $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
            /**
             * checks the session for active user otherwise it will
             * redirect to the login page
             */
            if(!session()->has("logged_user")) {
                return redirect()->to(base_url());
            }
            $this->store_data = $this->storeModel->getStoreData($this->store_id);
            helper(['form', 'overview']);
            session()->setTempdata('store','active',1);
        }

        /**
         * Main function of this Controller
         * @return RedirectResponse|string
         */
        public function index() {

            /**
             * checks the session for active user otherwise it will
             * redirect to the login page
             */
            if(!session()->has("logged_user")) {

                return redirect()->to(base_url());

            }

            $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
            $this->store_data = $this->storeModel->getStoreData($this->store_id);


            /**
             * @array $data['userdata'] sends user data to the view controller
             *
             */
            $data['userdata'] = $this->userdata;

            /**
             * @array $data['products'] sends the data of all the products from this store
             */
            $data['products'] = $this->productsModel->getProducts((string)$this->store_id);

            $clause = [
                "store_id" => $this->store_id,
            ];
            /**
             * @array $data['customers'] sends the data of all the customers registered to this store
             */
            $data['customers'] = $this->customersModel->getCustomers($clause);

            $data['store_data'] =$this->store_data;

            /**
             * checks for the request type and redirects
             * @return RedirectResponse|string
             */
            if ($this->request->getMethod() == "post"){
                $data['post'] = $_POST;
                session()->setTempdata( "uri_referer",base_url()."/store", "10");

                $salesCount = $this->storefrontModel->getSalesCount([
                    "date_sold" => date("Y-m-d"),
                    "store_id" => $this->store_id
                ]);

                $receipt_prefix = (empty($this->store_data->receipt_prefix)) ? $this->store_data->receipt_prefix : "OPS";
                switch($_POST['sale_type']) {
                    case "direct":
                        $sale = [
                            "customer_id"       => $_POST['cus_id'],
                            "customer_name"     => $_POST['cus_name'],
                            "receipt_num"       => $receipt_prefix . date("Hmydis"),
                            "user_name"         => $this->userdata->name,
                            "user_id"           => $this->user_id,
                            "total_amount"      => (float)str_replace(",", "", $_POST['total_amount']),
                            "amount_change"     => $_POST['change'],
                            "amount_paid"       => $_POST['paid'],
                            "vat"               => $_POST['vat_percentage'],
                            "vat_amount"        => $_POST['vat_amount'],
                            "discount_type"     => $_POST['discount_type'],
                            "discount"          => $_POST['discount_amount'],
                            "subtotal"          => (float)array_sum($_POST['amount']),
                            "date_sold"         => date("Y-m-d"),
                            "time_sold"         => date("H:i:s"),
                            "store_id"          => $this->store_id,
                            "fulldate"          => date("D jS F, Y  h:i a"),
                            "salesCount"        => $salesCount  ? $salesCount + 1 : 1
                        ];

                        $data['post']["salesCount"] = $sale['salesCount'];

                        $sentSale = $this->storefrontModel->sendSale($sale);
                        $sale['pending_status'] = 0;

                        $data['sale'] = $sale;
                        $data['saleID'] = $sentSale;

                        if ($sentSale) {
                            $postedSale = [
                                "product_id" => $this->request->getVar("item_id"),
                                "product" => $this->request->getVar("item"),
                                "quantity" => $this->request->getVar("quantity"),
                                "price" => $this->request->getVar("price"),
                                "amount" => $this->request->getVar("amount"),
                            ];

                            for ($i = 0; $i < count($postedSale['product']); $i++) {
                                $saleDetails = [
                                    "sales_id" => $sentSale,
                                    "store_id" => $this->store_id,
                                    "product" => $postedSale["product"][$i],
                                    "product_id" => $postedSale["product_id"][$i],
                                    "quantity" => $postedSale["quantity"][$i],
                                    "price" => $postedSale["price"][$i],
                                    "amount" => $postedSale["amount"][$i],
                                    "date_sold" => $sale['date_sold'],
                                    "time_sold" => $sale['time_sold']
                                ];

                                $queryResponse = $this->storefrontModel->sendSaleDetails($saleDetails);

                                if ($queryResponse) {
                                    $data["message"] = "Row Successfully Added";
                                } else {
                                    $data["message"] = "An Error Occurred";
                                }

                            }

                        } else {
                            $data["message"] = "An Error Occurred";
                        }

                        if (!empty($sale['customer_id'])) {
                            $customerDetails = $this->customersModel->getCustomer([
                                'store_id' => $this->store_id,
                                'customer_id' => $sale['customer_id']
                            ]);

                            $data['customerDetails'] = $customerDetails;
                        }

                        session()->setTempdata('sales_id', $sentSale, '6');
                        $data['inputs'] = $_POST;

                        return view("sales_receipt", $data);


                    case "credit":
                        $sale = [
                            "customer_id"       => $_POST['cus_id'],
                            "customer_name"     => $_POST['cus_name'],
                            "invoice_num"       => $receipt_prefix . date("Hmydis"),
                            "user_name"         => $this->userdata->name,
                            "user_id"           => $this->user_id,
                            "total_amount"      => (float)str_replace(",", "", $_POST['total_amount']),
                            "vat"               => $_POST['vat_percentage'],
                            "vat_amount"        => $_POST['vat_amount'],
                            "discount_type"     => $_POST['discount_type'],
                            "discount"          => $_POST['discount_amount'],
                            "subtotal"          => (float)array_sum($_POST['amount']),
                            "date_sold"         => date("Y-m-d"),
                            "time_sold"         => date("H:i:s"),
                            "store_id"          => $this->store_id,
                            "fulldate"          => date("D jS F, Y  h:i a"),
                            "salesCount"        => $salesCount  ? $salesCount + 1 : 1
                        ];

                        $sentSale = $this->storefrontModel->sendCreditSale($sale);
                        $sale['pending_status'] = 0;

                        $data['sale'] = $sale;
                        $data['saleID'] = $sentSale;

                        if ($sentSale) {
                            $postedSale = [
                                "product_id" => $this->request->getVar("item_id"),
                                "product" => $this->request->getVar("item"),
                                "quantity" => $this->request->getVar("quantity"),
                                "price" => $this->request->getVar("price"),
                                "amount" => $this->request->getVar("amount"),
                            ];

                            for ($i = 0; $i < count($postedSale['product']); $i++) {
                                $saleDetails = [
                                    "sales_id" => $sentSale,
                                    "store_id" => $this->store_id,
                                    "product" => $postedSale["product"][$i],
                                    "product_id" => $postedSale["product_id"][$i],
                                    "quantity" => $postedSale["quantity"][$i],
                                    "price" => $postedSale["price"][$i],
                                    "amount" => $postedSale["amount"][$i],
                                    "date_sold" => $sale['date_sold'],
                                    "time_sold" => $sale['time_sold']
                                ];

                                $queryResponse = $this->storefrontModel->sendCreditSaleDetails($saleDetails);

                                if ($queryResponse) {
                                    $data["message"] = "Row Successfully Added";
                                } else {
                                    $data["message"] = "An Error Occurred";
                                }

                            }

                        } else {
                            $data["message"] = "An Error Occurred";
                        }

                        if (!empty($sale['customer_id'])) {
                            $customerDetails = $this->customersModel->getCustomer([
                                'store_id' => $this->store_id,
                                'customer_id' => $sale['customer_id']
                            ]);

                            $data['customerDetails'] = $customerDetails;
                        }

                        session()->setTempdata('sales_id', $sentSale, '6');
                        $data['inputs'] = $_POST;

                        return view("credit_receipt", $data);

                    case "pending":
                        $sale = [
                            "customer_id"       => $_POST['cus_id'],
                            "customer_name"     => $_POST['cus_name'],
                            "receipt_num"       => $receipt_prefix . date("Hmydis"),
                            "user_name"         => $this->userdata->name,
                            "user_id"           => $this->user_id,
                            "total_amount"      => (float)str_replace(",", "", $_POST['total_amount']),
                            "amount_change"     => $_POST['change'],
                            "amount_paid"       => $_POST['paid'],
                            "vat"               => $_POST['vat_percentage'],
                            "vat_amount"        => $_POST['vat_amount'],
                            "discount_type"     => $_POST['discount_type'],
                            "discount"          => $_POST['discount_amount'],
                            "subtotal"          => (float)array_sum($_POST['amount']),
                            "date_sold"         => date("Y-m-d"),
                            "time_sold"         => date("H:i:s"),
                            "store_id"          => $this->store_id,
                            "fulldate"          => date("D jS F, Y  h:i a"),
                            "pending_status"    => 1,
                        ];


                        $sentSale = $this->storefrontModel->sendSale($sale);

                        $data['sale'] = $sale;
                        $data['saleID'] = $sentSale;

                        if ($sentSale) {
                            $postedSale = [
                                "product_id" => $this->request->getVar("item_id"),
                                "product" => $this->request->getVar("item"),
                                "quantity" => $this->request->getVar("quantity"),
                                "price" => $this->request->getVar("price"),
                                "amount" => $this->request->getVar("amount"),
                            ];

                            for ($i = 0; $i < count($postedSale['product']); $i++) {
                                $saleDetails = [
                                    "sales_id" => $sentSale,
                                    "store_id" => $this->store_id,
                                    "product" => $postedSale["product"][$i],
                                    "product_id" => $postedSale["product_id"][$i],
                                    "quantity" => $postedSale["quantity"][$i],
                                    "price" => $postedSale["price"][$i],
                                    "amount" => $postedSale["amount"][$i],
                                    "date_sold" => $sale['date_sold'],
                                    "time_sold" => $sale['time_sold']
                                ];

                                $queryResponse = $this->storefrontModel->sendSaleDetails($saleDetails);

                                if ($queryResponse) {
                                    $data["message"] = "Row Successfully Added";
                                } else {
                                    $data["message"] = "An Error Occurred";
                                }

                            }

                        } else {
                            $data["message"] = "An Error Occurred";
                        }

                        if (!empty($sale['customer_id'])) {
                            $customerDetails = $this->customersModel->getCustomer([
                                'store_id' => $this->store_id,
                                'customer_id' => $sale['customer_id']
                            ]);

                            $data['customerDetails'] = $customerDetails;
                        }

                        session()->setTempdata('sales_id', $sentSale, '6');

                        $data['inputs'] = $_POST;

                        return view("sales_receipt", $data);
                }



            }


            return view('storefront',$data);
        }

        /**
         * Store direct sales shows here
         * @param $method
         * @param $id
         * @return RedirectResponse|string
         */
        public function sales($method=null, $id=null){

            /**
             * checks the session for active user otherwise it will
             * redirect to the login page
             */
            if (!session()->has("logged_user")) {
                return redirect()->to(base_url());
            }

            $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
            $this->store_data = $this->storeModel->getStoreData($this->store_id);

            /**
             * @array $data['userdata'] sends user data to the view controller
             *
             */
            $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

            /**
             * @array $data['store_data'] sends the data of the current store
             */
            $data['store_data'] = $this->storeModel->getStoreData($this->store_id);


            switch($method){
                case null:
                    session()->setTempdata( "uri_referer",$this->request->uri, "10");
                    $data['user_role_permissions'] = $this->rolesModel->getUserRolePermissions(["role_id" => $this->userdata->role_id]);
                    $data['sales'] = $this->storeModel->getSales($this->store_id);

//                    var_dump(json_encode($data['user_role_permissions']));
//                    var_dump($this->userdata);
//                    exit;
                 /**
                 * @array $data['userdata'] sends user data to the view controller
                 *
                 */
                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                 * @array $data['store_data'] sends the data of the current store
                 */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    return view("sales_view", $data);

                case "view":
                    session()->setTempdata( "uri_referer",$this->request->uri, "10");
                    $sales["saleDetails"] = $this->storeModel->getSalesDetails($this->store_id, $id);
                    $sales["sale"] = $this->storeModel->getSale($this->store_id, $id);

                    if (!empty($sales['sale']->customer_id)) {
                        $customerDetails = $this->customersModel->getCustomer([
                            'store_id' => $this->store_id,
                            'customer_id' => $sales['sale']->customer_id
                        ]);

                        $data['customerDetails'] = $customerDetails;
                    }

                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                     * @array $data['store_data'] sends the data of the current store
                     */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    $data['sale'] = $sales["sale"];
                    $data["saleDetails"] = $sales["saleDetails"];

                    return view("sales_details", $data);

                case "delete":
                    $clauses = [
                        'store_id' => $this->store_id,
                        'sales_id' => $id
                    ];

                 $deleteSaleDetails = $this->storeModel->deleteSaleDetails($clauses);

//                    $deleteSaleDetails = true;
                    if ($deleteSaleDetails){
                        $deleteSale = $this->storeModel->deleteSale($clauses);
                        if ($deleteSale) {
                            $data['msg'] = "success";
                        }else {
                            $data['msg'] = "error";
                        }
                    }else {
                        $data['msg'] = "error";
                    }
                    return json_encode($data);

                case "edit":
                    if($this->storeModel->getSale($this->store_id, $id)->pending_status == 1) {
                        if ($this->request->getMethod() == 'post') {
                            switch ($_POST['sale_type']) {
                                case "pending":

                                    $sale = [
                                        "customer_id" => $_POST['cus_id'],
                                        "customer_name" => $_POST['cus_name'],
                                        "user_name" => $this->userdata->name,
                                        "user_id" => $this->user_id,
                                        "total_amount" => (float)str_replace(",", "", $_POST['total_amount']),
                                        "amount_change" => $_POST['change'],
                                        "amount_paid" => $_POST['paid'],
                                        "vat" => $_POST['vat_percentage'],
                                        "vat_amount" => $_POST['vat_amount'],
                                        "discount_type" => $_POST['discount_type'],
                                        "discount" => $_POST['discount_amount'],
                                        "subtotal" => (float)array_sum($_POST['amount']),
                                        "date_sold" => date("Y-m-d"),
                                        "time_sold" => date("H:i:s"),
                                        "store_id" => $this->store_id,
                                        "fulldate" => date("D jS F, Y  H:ia"),
                                        "pending_status" => 1,
                                    ];

                                    $clause = [
                                        "store_id" => $this->store_id,
                                        "sales_id" => $id
                                    ];

                                    $sentSale = $this->storefrontModel->updateSale($clause, $sale);

                                    $data['sale'] = $sale;
                                    $data['sale']['receipt_num'] = $this->storeModel->getSale($this->store_id, $id)->receipt_num;
                                    $data['saleID'] = $id;

                                    if ($sentSale) {
                                        $postedSale = [
                                            "product_id" => $this->request->getVar("item_id"),
                                            "product" => $this->request->getVar("item"),
                                            "quantity" => $this->request->getVar("quantity"),
                                            "price" => $this->request->getVar("price"),
                                            "amount" => $this->request->getVar("amount"),
                                            "former_quantity" => $this->request->getVar("former_quantity"),
                                        ];

                                        for ($i = 0; $i < count($postedSale['product']); $i++) {
                                            $saleDetails = [
                                                "product" => $postedSale["product"][$i],
                                                "product_id" => $postedSale["product_id"][$i],
                                                "quantity" => $postedSale["quantity"][$i],
                                                "price" => $postedSale["price"][$i],
                                                "amount" => $postedSale["amount"][$i],
                                                "date_sold" => $sale['date_sold'],
                                                "time_sold" => $sale['time_sold']
                                            ];

                                            $clause = [
                                                "store_id" => $this->store_id,
                                                "sales_id" => $id,
                                                "product_id" => $saleDetails['product_id']
                                            ];

                                            $former_quantity = (array_key_exists(
                                                $i,
                                                $postedSale['former_quantity']
                                            )) ? $postedSale['former_quantity'][$i] : 0;

                                            $queryResponse = $this->storefrontModel->updateSaleDetails($clause, $saleDetails, $former_quantity);

                                            if ($queryResponse) {
                                                $data["message"] = "Row updated successfully";
                                            } else {
                                                $data["message"] = "An Error Occurred";
                                            }

                                        }

                                    } else {
                                        $data["message"] = "An Error Occurred";
                                    }
                                    if (!empty($sale['customer_id'])) {
                                        $customerDetails = $this->customersModel->getCustomer([
                                            'store_id' => $this->store_id,
                                            'customer_id' => $sale['customer_id']
                                        ]);

                                        $data['customerDetails'] = $customerDetails;
                                    }

                                    session()->setTempdata('sales_id', $id, '6');

                                    $data['inputs'] = $_POST;
                                    $data['store_data'] = $this->store_data;

                                    return view("sales_receipt", $data);

                                case "direct":
                                    $sale = [
                                        "customer_id" => $_POST['cus_id'],
                                        "customer_name" => $_POST['cus_name'],
                                        "user_name" => $this->userdata->name,
                                        "user_id" => $this->user_id,
                                        "total_amount" => (float)str_replace(",", "", $_POST['total_amount']),
                                        "amount_change" => $_POST['change'],
                                        "amount_paid" => $_POST['paid'],
                                        "vat" => $_POST['vat_percentage'],
                                        "vat_amount" => $_POST['vat_amount'],
                                        "discount_type" => $_POST['discount_type'],
                                        "discount" => $_POST['discount_amount'],
                                        "subtotal" => (float)array_sum($_POST['amount']),
                                        "date_sold" => date("Y-m-d"),
                                        "time_sold" => date("H:i:s"),
                                        "store_id" => $this->store_id,
                                        "fulldate" => date("D jS F, Y  H:ia"),
                                        "sale_close_date" => date("Y-m-d").",".date("H:ia"),
                                        "pending_status" => 0,
                                    ];

                                    $clause = [
                                        "store_id" => $this->store_id,
                                        "sales_id" => $id
                                    ];

                                    $sentSale = $this->storefrontModel->updateSale($clause, $sale);

                                    $data['sale'] = $sale;
                                    $data['sale']['receipt_num'] = $this->storeModel->getSale($this->store_id, $id)->receipt_num;
                                    $data['saleID'] = $id;

                                    if ($sentSale) {
                                        $postedSale = [
                                            "product_id" => $this->request->getVar("item_id"),
                                            "product" => $this->request->getVar("item"),
                                            "quantity" => $this->request->getVar("quantity"),
                                            "price" => $this->request->getVar("price"),
                                            "amount" => $this->request->getVar("amount"),
                                            "former_quantity" => $this->request->getVar("former_quantity"),
                                        ];

                                        for ($i = 0; $i < count($postedSale['product']); $i++) {
                                            $saleDetails = [
                                                "product" => $postedSale["product"][$i],
                                                "product_id" => $postedSale["product_id"][$i],
                                                "quantity" => $postedSale["quantity"][$i],
                                                "price" => $postedSale["price"][$i],
                                                "amount" => $postedSale["amount"][$i],
                                                "date_sold" => $sale['date_sold'],
                                                "time_sold" => $sale['time_sold']
                                            ];

                                            $clause = [
                                                "store_id" => $this->store_id,
                                                "sales_id" => $id,
                                                "product_id" => $saleDetails['product_id']
                                            ];

                                            $former_quantity = (array_key_exists(
                                                $i,
                                                $postedSale['former_quantity']
                                            )) ? $postedSale['former_quantity'][$i] : 0;

                                            $queryResponse = $this->storefrontModel->updateSaleDetails($clause, $saleDetails, $former_quantity);

                                            if ($queryResponse) {
                                                $data["message"] = "Row updated successfully";
                                            } else {
                                                $data["message"] = "An Error Occurred";
                                            }

                                        }

                                    } else {
                                        $data["message"] = "An Error Occurred";
                                    }
                                    if (!empty($sale['customer_id'])) {
                                        $customerDetails = $this->customersModel->getCustomer([
                                            'store_id' => $this->store_id,
                                            'customer_id' => $sale['customer_id']
                                        ]);

                                        $data['customerDetails'] = $customerDetails;
                                    }

                                    session()->setTempdata('sales_id', $id, '6');

                                    $data['inputs'] = $_POST;
                                    $data['store_data'] = $this->store_data;

                                    return view("sales_receipt", $data);
                            }
                        } else {
                            $data['products'] = $this->productsModel->getProducts((string)$this->store_id);
                            $data['sale'] = $this->storeModel->getSale($this->store_id, $id);
                            $data['saleDetails'] = $this->storeModel->getSalesDetails($this->store_id, $id);
                            $data['saleDetails'] = array($data['saleDetails']);

                            $data['revised'] = [];
                            $index = 0;

                            foreach ($data['saleDetails'][0] as $element) {
                                $element['barcode'] = $this->productsModel->getBarcode($this->store_id, $element['product_id']);
                                $data['revised'][$index++] = $element;
                            }

                            $data['saleDetails'] = $data['revised'];

                            $clause = ["store_id" => $this->store_id];
                            $data['customers'] = $this->customersModel->getCustomers($clause);
                            $data['store_data'] = $this->store_data;
                            $data['userdata'] = $this->userdata;

                            return view("storefront_edit", $data);
                        }
                    }
                    else
                        {
                        return redirect()->to(base_url()."/store/sales/view/$id");
                    }
            }

            $data['sales'] = $this->storeModel->getSales($this->store_id);

            return view("sales_view", $data);
        }

        /**
         * Store credit sales shows here
         * @param $method
         * @param $id
         * @return RedirectResponse|string
         */
        public function credit_sales($method=null, $id=null){

            /**
             * checks the session for active user otherwise it will
             * redirect to the login page
             */
            if (!session()->has("logged_user")) {
                return redirect()->to(base_url());
            }

            $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
            $this->store_data = $this->storeModel->getStoreData($this->store_id);

            switch($method){
                case null:
                    $data['user_role_permissions'] = $this->rolesModel->getUserRolePermissions(["role_id" => 2]); //$this->userdata->role_id
                    $data['sales'] = $this->storeModel->getCreditSales($this->store_id);

                    /**
                     * @array $data['userdata'] sends user data to the view controller
                     *
                     */
                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                     * @array $data['store_data'] sends the data of the current store
                     */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    return view("credit_view", $data);

                case "view":
                    $sales["saleDetails"] = $this->storeModel->getCreditSalesDetails($this->store_id, $id);
                    $sales["sale"] = $this->storeModel->getCreditSale($this->store_id, $id);

                    if (!empty($sales['sale']->customer_id)) {
                        $customerDetails = $this->customersModel->getCustomer([
                            'store_id' => $this->store_id,
                            'customer_id' => $sales['sale']->customer_id
                        ]);

                        $data['customerDetails'] = $customerDetails;
                    }

                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                     * @array $data['store_data'] sends the data of the current store
                     */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    $data['sale'] = $sales["sale"];
                    $data["saleDetails"] = $sales["saleDetails"];

                    return view("credit_sales_details", $data);

                case "delete":
                    $clauses = [
                        'store_id' => $this->store_id,
                        'sales_id' => $id
                    ];

                    $deleteSaleDetails = $this->storeModel->deleteCreditSaleDetails($clauses);

//                    $deleteSaleDetails = true;
                    if ($deleteSaleDetails){
                        $deleteSale = $this->storeModel->deleteCreditSale($clauses);
                        if ($deleteSale) {
                            $data['msg'] = "success";
                        }else {
                            $data['msg'] = "error";
                        }
                    }else {
                        $data['msg'] = "error";
                    }
                    return json_encode($data);

                case "edit":
                    break;
            }
        }

        /**
         * @param string $what
         * @param $id
         * @return string
         */
        public function print(string $what , $id): string {

            switch ($what) {
                case "receipt":
                    session()->set("what","receipt");
                    $receipt["saleDetails"] = $this->storeModel->getSalesDetails($this->store_id, $id);
                    $receipt["sale"] = $this->storeModel->getSale($this->store_id, $id);

                    if (!empty($receipt['sale']->customer_id)){
                        $customerDetails = $this->customersModel->getCustomer([
                            'store_id' => $this->store_id,
                            'customer_id' => $receipt['sale']->customer_id
                        ]);

                        $data['customerDetails'] = $customerDetails;
                    }

                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                     * @array $data['store_data'] sends the data of the current store
                     */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    $data['receipt'] = $receipt["sale"];
                    $data["receiptDetails"] = $receipt["saleDetails"];

                    return view("print", $data);

                case "credit":
                    session()->set("what","receipt");
                    $receipt["saleDetails"] = $this->storeModel->getCreditSalesDetails($this->store_id, $id);
                    $receipt["sale"] = $this->storeModel->getCreditSale($this->store_id, $id);

                    if (!empty($receipt['sale']->customer_id)){
                        $customerDetails = $this->customersModel->getCustomer([
                            'store_id' => $this->store_id,
                            'customer_id' => $receipt['sale']->customer_id
                        ]);

                        $data['customerDetails'] = $customerDetails;
                    }

                    $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

                    /**
                     * @array $data['store_data'] sends the data of the current store
                     */
                    $data['store_data'] = $this->storeModel->getStoreData($this->store_id);

                    $data['receipt'] = $receipt["sale"];
                    $data["receiptDetails"] = $receipt["saleDetails"];

                    return view("print", $data);
            }

            return view("error/error_page");
        }

        public function test(): string {

            echo hash("md5",hash("md5","") . hash("md4",""));
//            echo $this->productsModel->getBarcode($this->store_id,14);

//            if (isset($_POST)){
//                print_r($_POST);
//            }
//            $salesCount = $this->storefrontModel->getSalesCount([
//                "date_sold" => date("Y-m-d"),
//                "store_id" => "benney5fd19d133eedd_202012121653335fd549ed9b014"
//            ]);
//            echo $salesCount;
            $arrayA = array('one','two','three','four','five');

            $arrayB = array('one','two','three','four','five');


            $newArray = array_diff($arrayB,$arrayA);



            echo '<pre>';

            print_r($arrayA);

            echo '</pre>';

            echo '<pre>';

            print_r($arrayB);

            echo '</pre>';

            echo '<pre>';

            print_r($newArray);

            echo '</pre>';
            exit;
            return view("test");
        }

    }




