<?php

    namespace App\Controllers;
    use App\Models\StoreModel;
    use CodeIgniter\Controller;
    use App\Models\DashboardModel;
    use App\Models\ProfileModel;


    class Profile extends Controller{

        public $dashModel;
        public $profileModel;
        public $storeModel;
        public $store_id;
        public $user_id;
        public $store_data;

        public function __construct() {
            $this->dashModel = new DashboardModel();
            $this->profileModel = new ProfileModel();
            $this->storeModel = new StoreModel();
            $this->user_id = session()->get("user_id");
            $this->store_id = session()->get("store_id");
            session()->setTempdata('profile','active',1);
        }

        public function index() {

            if(!session()->has("logged_user")) {

                return redirect()->to(base_url());
    
            }

            $user_id = session()->get("user_id");

            $data['userdata'] = $this->dashModel->getLoggedUserData((string)$user_id);
            $data['store_data'] = $this->storeModel->getStoreData((string)$this->store_id);
            $data['sales'] = $this->storeModel->getCurrentUserSales((string)$this->store_id, (string)$this->user_id);
            
            return view('profile',$data);

        }

        public function profileUpdate(){
            $profile = [
                "name"      => $this->request->getVar("fullname"),
                "email"     => $this->request->getVar("email"),
                "mobile"    => $this->request->getVar("mobile"),
                "description" => $this->request->getVar("description")
            ];

            $storeInfo = [
                "store_id" => session()->get("store_id"),
                "user_id" => session()->get("user_id")
            ];

            $return = $this->profileModel->updateUserInfo($storeInfo, $profile);
            if ($return == true){
                $message = [
                    "msg" => "success"
                ];
            }else {
                $message = [
                    "msg" => "error"
                ];
            }

            return json_encode($message);
        }
    }
