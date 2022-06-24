<?php


namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DashboardModel;
use App\Models\StoreModel;
use CodeIgniter\HTTP\RedirectResponse;

class Settings extends Controller {

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
     * object class of the data of the current logged store
     * @var false|mixed
     */
    public $settingsModel;

    /**
     * Store Class constructor.
     */
    public function __construct() {
        $this->dashModel = new DashboardModel();
        $this->storeModel = new StoreModel();
        $this->user_id = session()->get("user_id");
        $this->store_id = session()->get("store_id");
        helper(['form']);
        session()->setTempdata('store','active',1);
    }

    /**
     * Main function of this Controller
     * @return RedirectResponse|string
     */
    public function index(){
        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */
        if (!session()->has("logged_user")) {
            return redirect()->to(base_url());
        }

        if($this->request->getMethod() == "post"){
            $store_settings = [
                "store_name" => $this->request->getVar("storeName", FILTER_SANITIZE_STRING),
                "address" => $this->request->getVar("storeAddress", FILTER_SANITIZE_STRING),
                "mobile" => $this->request->getVar("storeMobile", FILTER_SANITIZE_STRING),
                "fax" => $this->request->getVar("storeFax", FILTER_SANITIZE_STRING),
                "email" => $this->request->getVar("storeEmail", FILTER_SANITIZE_EMAIL),
                "receipt_prefix" => $this->request->getVar("storePrefix", FILTER_SANITIZE_STRING),
                "vat" => $this->request->getVar("storeVatPercentage", FILTER_SANITIZE_STRING),
                "discount" => $this->request->getVar("storeDiscount", FILTER_SANITIZE_STRING),
                "barcode" => $this->request->getVar("storeBarcode", FILTER_SANITIZE_STRING),
                "vat_status" => $this->request->getVar("storeVat", FILTER_SANITIZE_STRING),
                "salesCount" => $this->request->getVar("storeSalesCount", FILTER_SANITIZE_STRING),
                "logoDisplay" => $this->request->getVar("storeLogoDisplay", FILTER_SANITIZE_STRING)
            ];

            if($this->storeModel->updateStoreData($this->store_id, $store_settings)){
                session()->setTempdata("success", "Updated successfully!", 3);
            } else {
                session()->setTempdata("error", "An error occurred!", 3);
            }

            return redirect()->to(base_url()."/settings");
        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;
        return view("settings_view", $data);
    }

}