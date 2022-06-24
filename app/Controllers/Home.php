<?php 

namespace App\Controllers;
use App\Models\LoginModel;

class Home extends BaseController {

	public $loginModel;
	public $session;
	
	public function __construct(){
		helper("form");
		$this->loginModel = new LoginModel();
		$this->session = session();
	}
	
	public function index() {
		$data = [];
		if (session()->has('logged_user')){
            return redirect()->to(base_url().'/dashboard');
        }

		if ( $this->request->getMethod() == 'post' ) {


			$username = $this->request->getVar('username',FILTER_SANITIZE_STRING);
			$password = $this->request->getVar('password');

			$userdata = $this->loginModel->verifyUsername(strtolower($username));

                if ($userdata) {

                    if (
                        hash("md5",
                        hash("md5",$password) . hash("md4",$password)) == $userdata['passkey']
                    ) {

                        if ($userdata['status'] == 'active') {

							if($this->loginModel->verifyStore($userdata['store_id'])){

								$this->session->set("logged_user", $userdata['username']);
								$this->session->set("user_id", $userdata['user_id']);
								$this->session->set("store_id", $userdata['store_id']);
								$this->session->setTempdata("name", $userdata['name'],3);

								return redirect()->to(base_url().'/dashboard');
							}else {
								$this->session->setTempdata("error", "Sorry! Your Store is not active or doesn't exist. Please contact our Customer Support", 3);
								return redirect()->to(current_url());
							}

                        }else {
							$this->session->setTempdata("error", "Sorry! Your account is inactive. Please contact your admin", 3);
                    		return redirect()->to(current_url());
						}
                    }else {

						$this->session->setTempdata("error", "Sorry! Credentials do not match!", 3);
						return redirect()->to(current_url());
					}
                }else {

					$this->session->setTempdata("error", "Sorry! Credentials do not match!", 3);
                    return redirect()->to(current_url());
				}
			
		}

		return view('login',$data);
	}

	public function test(): string {
	    return view("test");
    }


}
