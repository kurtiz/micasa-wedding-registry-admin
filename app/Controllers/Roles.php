<?php


namespace App\Controllers;

use App\Models\StoreModel;
use App\Models\DashboardModel;
use App\Models\RolesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class Roles extends Controller
{

    /**
     *  an instance of the DashboardModel class
     */
    public $dashModel;

    /**
     * an instance of the StoreModel Class
     * @var object $storeModel
     */
    public $storeModel;

    /**
     * an instance of the RolesModel
     */
    public $rolesModel;

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
     * Roles Class constructor.
     */
    public function __construct() {
        $this->storeModel = new StoreModel();
        $this->user_id = session()->get("user_id");
        $this->store_id = session()->get("store_id");
        $this->dashModel = new DashboardModel();
        $this->rolesModel = new RolesModel();
        helper(['form']);
        session()->setTempdata('roles', 'active', 1);
    }

    public function index()
    {
        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */
        if (!session()->has("logged_user")) {
            return redirect()->to(base_url());
        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;
        $data['roles'] = $this->rolesModel->getRoles(["store_id" => $this->store_id]);
        return view("user_roles", $data);
    }

    /**
     * adds new role
     * @return RedirectResponse|string returns the add role page
     */
    public function add()
    {
        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */
        if (!session()->has("logged_user")) {
            return redirect()->to(base_url());
        }

        $data['role_permissions'] = $this->rolesModel->getPermissions();
        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;

        if ($this->request->getMethod() == "post") {
            $role = [
                "role_name" => $this->request->getVar("role_name"),
                "description" => $this->request->getVar("description"),
                "store_id" => $this->store_id
            ];

            $userRole = $this->rolesModel->createUserRole($role);



            if ($userRole) {
                for ($i = 0; $i < count($data['role_permissions']); $i++) {
                    $roles_permissions = [
                        "role_id" => $userRole,
                        "perm_id" => $i+1,
                        "state" => $this->request->getVar("permission[$i]"),
                        "style" => $this->request->getVar("permission[$i]") == "true" ? "" : 'style="display:none"'
                    ];

                    $queryResponse = $this->rolesModel->createRolePermission($roles_permissions);

                    if ($queryResponse) {
                        $success = "Row Successfully Added";
                    } else {
                        $error = "An Error Occurred";
                    }
                }

                if (isset($error)){
                    session()->setTempdata("error", "An error occurred", 5);
                }else{
                    session()->setTempdata("success", "Role created successfully", 5);
                    return redirect()->to(base_url()."/roles");
                }
            }else {
                session()->setTempdata("error", "An error occurred",5);
            }
        }

        return view("add_roles", $data);
    }

    /**
     * updates roles info
     * @param string | mixed $id id of the role
     * @return RedirectResponse | string returns the edit role page
     */
    public function edit(string $id) {

        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */

        if(!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $data['role_permissions'] = $this->rolesModel->getPermissions();
        $data['role'] = $this->rolesModel->getRole(["role_id" =>$id , "store_id" => $this->store_id]);
        $data['user_role_permissions'] = $this->rolesModel->getUserRolePermissions(["role_id" => $id]);

        if ($this->request->getMethod() == "post") {

            $role = [
                "role_name" => $this->request->getVar("role_name"),
                "description" => $this->request->getVar("description")
            ];

            $clauses = [
                "store_id" => $this->store_id,
                "role_id" => $id
            ];

            $userRole = $this->rolesModel->updateUserRole($role, $clauses);

            if ($userRole) {
                for ($i = 0; $i < count($data['role_permissions']); $i++) {
                    $roles_permissions = [
                        "state" => $this->request->getVar("permission[$i]"),
                        "style" => $this->request->getVar("permission[$i]") == "true" ? "" : 'style="display:none"'
                    ];

                    $clauses = [
                        "role_id" => $id,
                        "perm_id" => $i + 1
                    ];

                    $queryResponse = $this->rolesModel->updateUserRolePermission($roles_permissions, $clauses);

                    if ($queryResponse) {
                        $success = "Row Successfully Added";
                    } else {
                        $error = "an error occurred";
                    }
                }

                if (isset($error)) {
                    session()->setTempdata("error", $error, 5);
                } else {
                    session()->setTempdata("success", "Role updated successfully", 5);
                    return redirect()->to(base_url() . "/roles");
                }
            } else {
                session()->setTempdata("error", "An error occurred", 5);
            }
        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;

        return view("role_edit", $data);
    }

    /**
     * view roles info
     * @param string | mixed $id id of the role
     * @return RedirectResponse | string returns the view role page
     */
    public function view(string $id) {

        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */

        if(!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $data['role_permissions'] = $this->rolesModel->getPermissions();
        $data['role'] = $this->rolesModel->getRole(["role_id" =>$id , "store_id" => $this->store_id]);
        $data['user_role_permissions'] = $this->rolesModel->getUserRolePermissions(["role_id" => $id]);



        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;

        return view("role_view", $data);
    }

    /**
     * deletes the role
     * @param $id - id of the role to be deleted
     * @return RedirectResponse|string
     */
    public function delete($id)
    {
        /**
         * checks the session for active user otherwise it will
         * redirect to the login page
         */

        if (!session()->has("logged_user")) {
            return redirect()->to(base_url());
        }

        $this->userdata = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $this->store_data = $this->storeModel->getStoreData($this->store_id);
        $data['storedata'] = $this->store_data;
        $data['userdata'] = $this->userdata;

        if ($this->request->getMethod() == "post") {
            $clauses = [
                "role_id" => $id,
                "store_id" => $this->store_id
            ];

            $deleteRole = $this->rolesModel->deleteRole($clauses);

            if ($deleteRole) {
                $data['msg'] = "success";
            } else {
                $data['msg'] = "error";
            }
            return json_encode($data);

        }else{
            return json_encode([
                "error code" => "503",
                "description" => "wrong gateway"
            ]);
        }
    }

}