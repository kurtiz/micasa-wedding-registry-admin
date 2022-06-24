<?php

    namespace App\Controllers;
    use App\Models\ProductsModel;
    use App\Models\StorefrontModel;
    use App\Models\StoreModel;
    use CodeIgniter\Controller;
    use App\Models\DashboardModel;
    use App\Libraries\Overview;

    class Dashboard extends Controller{

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

        public $overview;


        /**
         * Store Class constructor.
         */
        public function __construct() {
            $this->dashModel = new DashboardModel();
            $this->storeModel = new StoreModel();
            $this->overview = new Overview();
            $this->user_id = session()->get("user_id");
            $this->store_id = session()->get("store_id");
            helper(['form']);
            session()->setTempdata('dashboard','active',1);
        }


        public function index() {

            if(!session()->has("logged_user")) {

                return redirect()->to(base_url());

            }

            $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
            $this->store_data = $this->storeModel->getStoreData($this->store_id);
            $sales = $this->storeModel->getProductPerformances($this->store_id);

            $data['productPerformance'] = $sales;
            $data['userdata'] = $this->userdata;

            $daily = $this->storeModel->getSoldQuantityDaily($this->store_id);
            $monthly = $this->storeModel->getSoldQuantityMonthly($this->store_id);
//            print_r($monthly);
//            exit;
            $allSales = $this->overview->overview($daily, $monthly);
            $data['allSales'] = $allSales;

            return view('dashboard',$data);
        }

        public function logout() {

            // $info = stalk();
            // $stalkData = [
            //     'activity'  =>  'User Logout',
            //     'details'   =>  session()->get('logged_user').' Tried to log out',
            //     'success_rate'  => 'success',
            //     'msg'   =>  'Killed Session and Logged out Successfully',
            //     'username' => session()->get('logged_user'),
            //     'user_ip_address'   =>  $info['ipAddress'],
            //     'request_uri'   =>  current_url(),
            //     'date_logged'   =>  $info['date'],
            //     'time_logged'   =>  $info['time'],
            //     'device_used'   =>  $info['deviceInfo']['device'],
            //     'browser_used'  =>  $info['browser'],
            //     'operating_system'  => $info['deviceInfo']['os']
            // ];

            // $this->activityModel->saveActivity($stalkData);
            session()->remove("logged_user");
            session()->destroy();
            return redirect()->to(base_url());
        }
    }
