<?php


namespace App\Controllers;
use App\Models\StoreModel;
use CodeIgniter\Controller;
use App\Models\DashboardModel;
use App\Models\CustomersModel;

class Customers extends Controller{
    /**
     * an instance of the DashboardModel Class
     * @var object $dashModel
     */
    public $dashModel;

    /**
     * an instance of the StoreModel Class
     * @var object $storeModel
     */
    public $storeModel;

    /**
     * an instance of the CustomersModel Class
     * @var object $storeModel
     */
    public $customersModel;

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
        $this->storeModel = new StoreModel();
        $this->customersModel = new CustomersModel();
        $this->user_id = session()->get("user_id");
        $this->store_id = session()->get("store_id");
        helper(['form', 'overview']);
        session()->setTempdata('customers','active',1);
    }

    public function index(){

        if(!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);

        $clause = [
            "store_id" => $this->store_id,
        ];
        $data["customers"] = $this->customersModel->getCustomers($clause);

        $data['userdata'] = $this->userdata;
        $data['store_data'] = $this->store_data;
        return view("customers_view",$data);
    }

    public function add(){
        if(!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);

        if ($this->request->getMethod() == "post") {


            $fields = [
                "customer_name" => $this->request->getVar("cusname", FILTER_SANITIZE_STRING),
                "gender" => $this->request->getVar("cusgender", FILTER_SANITIZE_STRING),
                "dob" => $this->request->getVar("dob"),
                "mobile" => $this->request->getVar("mobile"),
                "email" => $this->request->getVar("email"),
                "date_created" => date("Y-m-d"),
                "time_created" => date('h:i A', strtotime(date("h:i"))),
                "user_id" => $this->user_id,
                "user_name" => $this->userdata->name,
                "store_id" => $this->store_id,
            ];


            $saveCustomer = $this->customersModel->createCustomer($fields);

            if ($saveCustomer) {
                if (null !== $this->request->getFile("img")) {

                    $file = $this->request->getFile('img');


                    if ($file->isValid() && !$file->hasMoved()) {

                        $fileName = $file->getRandomName();

                        if ($file->move(FCPATH . 'public/uploads/customers', $fileName)) {

                            $path = base_url() . '/public/uploads/customers/' . $fileName;

                            if ($this->customersModel->updateCustomerImg(['customer_id' => (int)$saveCustomer,
                                'store_id' => (string)$this->store_id], ['image' => $path])) {

                                session()->setTempdata('success', $fields['customer_name'] . ' has been added successfully', 5);
                                return redirect()->to(base_url() . "/customers/add");

                            } else {

                                session()->setTempdata('error', 'An error occurred while saving image.', 5);
                                return redirect()->to(base_url() . "/customers/add");
                            }

                        } else {

                            session()->setTempdata('error', 'An error occurred while uploading file. <br>' . $file->getErrorString(), 3);
                            return redirect()->to(base_url() . "/customers/add");

                        }
                    } else {
                        session()->setTempdata('success', $fields['customer_name'] . ' has been added successfully', 5);
                        return redirect()->to(base_url() . "/customers/add");
                    }

                }
            } else {
                session()->setTempdata("error", "Sorry! Unable to add customer.. Please try again", 5);
                return redirect()->to(base_url() . "/customers/add");
            }
        }

        $data['userdata'] = $this->userdata;
        return view("add_customer",$data);
    }
}