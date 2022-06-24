<?php
    namespace App\Controllers;
    use CodeIgniter\Controller;

    class Welcome extends Controller {
        
        public function index() {
            echo "Welcome to CodeIgniter 4";
        }

        public function test($name) {
            echo "Welcome to ". $name;
        }

        public function address($city, $country) {
            echo "I am from ". $city . " in " . $country ;
        }

        public function _remap($method, ...$params) {
            
            if (method_exists($this, $method)){
                
                return $this->$method(...$params);
            
            }else {

                $this->index();
            }
        }
    }

?>