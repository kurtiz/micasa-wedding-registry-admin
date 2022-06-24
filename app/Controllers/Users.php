<?php


namespace App\Controllers;

use App\Models\DashboardModel;
use App\Models\StoreModel;
use App\Models\UsersModel;
use App\Models\RolesModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Users extends Controller
{

    /**
     * an instance of the session class in-built in CodeIgniter 4
     * @var Session|mixed|null
     */
    public $session;

    /**
     * an instance of the DashboardModel Class
     * @var object $dashModel
     */
    public $dashModel;

    /**
     * an instance of the RolesModel Class
     * @var object $rolesModel
     */
    public $rolesModel;

    /**
     * an instance of the StoreModel Class
     * @var object $storeModel
     */
    public $storeModel;

    /**
     * an instance of the UsersModel Class
     * @var object $usersModel
     */
    public $usersModel;

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

    public function __construct()
    {
        $this->dashModel = new DashboardModel();
        $this->storeModel = new StoreModel();
        $this->usersModel = new UsersModel();
        $this->rolesModel = new RolesModel();
        $this->user_id = session()->get("user_id");
        $this->store_id = session()->get("store_id");
        helper("form");
        $this->session = session();
        session()->setTempdata('users', 'active', 1);
    }

    public function index($method = null, $id = null)
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['userdata'] = $this->userdata;
        $data['users'] = $this->usersModel->getUsers(['store_id' => $this->store_id]);
        $data['storedata'] = $this->store_data;


        return view("users", $data);
    }

    /**
     * adds new user to the store
     * @return string
     */
    public function add()
    {

        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        if ($this->request->getMethod() == 'post') {

            $fields = [
                "name"
            ];

        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['roles'] = $this->rolesModel->getRoles(["store_id" => $this->store_id]);
        $data['userdata'] = $this->userdata;
        $data['storedata'] = $this->store_data;
        return view("add_user", $data);
    }


    public function validateUsername(string $id){
        if (!session()->has("logged_user")) {
            return json_encode(["msg" => "login to access this service"]);
        }

        if ($this->request->getMethod() == "post"){
            $clauses = [
                "username" => $id
            ];

            $validate =  $this->usersModel->validateUser($clauses);

            if ($validate){
                $data['msg'] = "success";
            } else {
                $data['msg'] = "error";
            }
            return json_encode($data);

        }else {
            return json_encode([
                "error code" => "503",
                "description" => "wrong gateway"
            ]);
        }
    }
}