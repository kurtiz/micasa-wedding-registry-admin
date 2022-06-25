<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductsModel;
use App\Models\DashboardModel;
use CodeIgniter\HTTP\RedirectResponse;


class Products extends Controller
{

    public $productsModel;
    public $dashModel;
    public $user_id;
    public $store_id;

    public function __construct()
    {
        helper('form');
        $this->productsModel = new ProductsModel();
        $this->dashModel = new DashboardModel();
        session()->setTempdata('inventory', 'active open', 1);
        $this->user_id = session()->get("user_id");
        $this->store_id = session()->get("store_id");
    }

//****************** PRODUCT SECTION ********************//

    /**
     * list of all products page
     * @return RedirectResponse|string returns the list of products page
     */
    public function index()
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }


        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $data['storedata'] = $this->dashModel->getLoggedStoreData($this->store_id);
        $data['products'] = $this->productsModel->getProducts($this->store_id);

        return view('products', $data);

    }

    /**
     * add product page
     * @return RedirectResponse|string returns the add product page
     */
    public function add()
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }


        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $data['categories'] = $this->productsModel->getCategories($this->store_id);

        return view('add_product', $data);
    }

    /**
     * saves the product to the database
     * @return RedirectResponse returns add product page
     */
    public function save()
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        if ($this->request->getMethod() == "post") {


            $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

            $fields = [
                "product_name" => $this->request->getVar("productname", FILTER_SANITIZE_STRING),
                "description" => $this->request->getVar("description", FILTER_SANITIZE_STRING),
                "cost_price" => $this->request->getVar("costprice"),
                "status" => $this->request->getVar("product_status"),
                "date_added" => date("Y-m-d"),
                "time_added" => date('h:i A', strtotime(date("h:i"))),
                "user_id" => $this->user_id,
                "users_name" => $data['userdata']->name,
                "store_id" => $this->store_id,
            ];


            $fields['barcode'] = rand(1000000000000, 9999999999999);

            $checkBarcode = $this->productsModel->barcodeExists([
                "barcode" => $fields['barcode'],
                "store_id" => $fields['store_id']
            ]);

            // with this each store can have 6,227,020,800 products. that's approximately 6.2 million barcodes
            // generated for each store
            if ($checkBarcode) {
                $fields['barcode'] = rand(1000000000000, 9999999999999);
            }

        } else {
            $fields['barcode'] = $this->request->getVar("barcode_no", FILTER_SANITIZE_STRING);
        }

        $saveProduct = $this->productsModel->createProduct($fields);

        if ($saveProduct) {
            $filePaths = "";

            if ($this->request->getFileMultiple('img')) {

                foreach ($this->request->getFileMultiple('img') as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $fileName = $file->getRandomName();
                        $file->move(FCPATH . 'public/uploads/products', $fileName);
                        $filePaths .= '/public/uploads/products/' . $fileName . ",";
                    }
                }

                $imageData = [
                    'image' => $filePaths,
                    'date_updated' => date("Y-m-d"),
                    'time_updated' => date('h:i A', strtotime(date("h:i")))
                ];

                if ($this->productsModel->updateProductImg($fields['barcode'], (string)$this->store_id, $imageData)) {

                    session()->setTempdata('success', $fields['product_name'] . ' has been added successfully', 5);

                } else {

                    session()->setTempdata('error', 'An error occurred while saving image.', 5);
                }
                return redirect()->to(base_url() . "/products/add");
            } else {
                session()->setTempdata('success', $fields['product_name'] . ' has been added successfully', 5);
            }
        } else {
            session()->setTempdata("error", "Sorry! Unable to add product.. Please try again", 5);
            return redirect()->to(base_url() . "/products/add");
        }

        return redirect()->to(base_url() . "/products/add");
    }

    /**
     * view product info
     * @param integer | mixed $id
     * @return RedirectResponse | string returns the view product page
     */
    public function view(int $id)
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $productData = $this->productsModel->getProduct($this->store_id, $id);
        if ($productData) {
            $data['product'] = $productData;
        } else {
            redirect()->to(base_url() . "/products");
        }

        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
        return view("product_view", $data);
    }

    /**
     * updates products info
     * @param string | mixed $id id of the product
     * @return RedirectResponse | string returns the view product page
     */
    public function edit(string $id)
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }
        $data['product'] = $this->productsModel->getProduct($this->store_id, $id);
        $data['categories'] = $this->productsModel->getCategories($this->store_id);

        if ($this->request->getMethod() == "post") {

            $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
            $fields = [
                "product_name" => $this->request->getVar("productname", FILTER_SANITIZE_STRING),
                "description" => $this->request->getVar("description", FILTER_SANITIZE_STRING),
                "cost_price" => $this->request->getVar("costprice"),
                "status" => $this->request->getVar("product_status"),
                "date_updated" => date("Y-m-d"),
                "time_updated" => date('h:i A', strtotime(date("h:i"))),
                "store_id" => $this->store_id
            ];

            $clauses = [
                "store_id" => $this->store_id,
                "product_id" => $id,
            ];

            $updateProduct = $this->productsModel->updateProduct($clauses, $fields);

            if ($updateProduct) {
                $filePaths = "";

                if ($this->request->getFileMultiple('img')) {

                    foreach ($this->request->getFileMultiple('img') as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $fileName = $file->getRandomName();
                            $file->move(FCPATH . 'public/uploads/products', $fileName);
                            $filePaths .= '/public/uploads/products/' . $fileName . ",";
                        }
                    }

                    $imageData = [
                        'image' => $filePaths,
                        'date_updated' => date("Y-m-d"),
                        'time_updated' => date('h:i A', strtotime(date("h:i"))),
                        'last_edit_user_id' => $this->user_id,
                        'last_edit_user_name' => $data['userdata']->name,
                    ];

                    $imgUpdate = $this->productsModel->updateProductImg($data["product"][0]["barcode"], (string)$this->store_id, $imageData);

                    if ($imgUpdate) {

                        session()->setTempdata('success', $fields['product_name'] . ' has been updated successfully', 5);

                    } else {

                        session()->setTempdata('error', 'An error occurred while saving image.', 5);
                    }
                    return redirect()->to(base_url() . "/products/view/$id");
                }
                else {
                    session()->setTempdata('success', $fields['product_name'] . ' has been added successfully', 5);
                }
            } else {
                session()->setTempdata("error", "Sorry! Unable to update product. Please try again", 5);
                return redirect()->to(base_url() . "/products/view/$id");
            }
        }
        return view("product_edit", $data);
    }

    /**
     * @param string $id id of the product to be deleted
     * @return RedirectResponse|false|string
     */
    public function delete(string $id)
    {

        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        if ($this->request->getMethod() == "post") {

            $clauses = [
                'store_id' => $this->store_id,
                'product_id' => $id
            ];

            $deleteProduct = $this->productsModel->deleteProduct($clauses);

            if ($deleteProduct) {
                $data['msg'] = "success";
            } else {
                $data['msg'] = "error";
            }
            return json_encode($data);
        } else {
            return json_encode([
                "error code" => "503",
                "description" => "wrong gateway"
            ]);
        }
    }


//****************** CATEGORY SECTION ********************//

    /**
     * list of all the categories page
     * @return RedirectResponse|string returns the list of all the categories page
     */
    public function categories()
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $data['storedata'] = $this->dashModel->getLoggedStoreData($this->store_id);
        $data['categories'] = $this->productsModel->getCategories($this->store_id);

        return view('categories', $data);
    }

    /**
     * add category page
     * @return RedirectResponse|string returns the add category page
     */
    public function add_category()
    {
        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

        return view('add_category', $data);
    }

    /**
     * saves the category
     * @return RedirectResponse
     */
    public function savecategory()
    {

        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        if ($this->request->getMethod() == "post") {


            $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);

            $fields = [
                "cat_name" => $this->request->getVar("catname", FILTER_SANITIZE_STRING),
                "description" => $this->request->getVar("description", FILTER_SANITIZE_STRING),
                "cat_color" => $this->request->getVar("color"),
                "date_created" => date("Y-m-d"),
                "time_created" => date('h:i A', strtotime(date("h:i"))),
                "user_id" => $this->user_id,
                "users_name" => $data['userdata']->name,
                "store_id" => $this->store_id,
            ];


            $saveCategory = $this->productsModel->createCategory($fields);

            if ($saveCategory) {
                if (null !== $this->request->getFile("img")) {

                    $file = $this->request->getFile('img');


                    if ($file->isValid() && !$file->hasMoved()) {

                        $fileName = $file->getRandomName();

                        if ($file->move(FCPATH . 'public/uploads/categories', $fileName)) {

                            $path = base_url() . '/public/uploads/categories/' . $fileName;

                            if ($this->productsModel->updateCategoryImg($saveCategory, ['cat_image' => $path])) {

                                session()->setTempdata('success', $fields['cat_name'] . ' has been added successfully', 5);
                                return redirect()->to(base_url() . "/products/add_category");

                            } else {

                                session()->setTempdata('error', 'An error occurred while saving image.', 5);
                                return redirect()->to(base_url() . "/products/add_category");
                            }

                        } else {

                            session()->setTempdata('error', 'An error occurred while uploading file. <br>' . $file->getErrorString(), 3);
                            return redirect()->to(base_url() . "/products/add_category");

                        }
                    } else {
                        session()->setTempdata('success', $fields['cat_name'] . ' has been added successfully', 5);
                        return redirect()->to(base_url() . "/products/add_category");
                    }

                }
            } else {
                session()->setTempdata("error", "Sorry! Unable to add product.. Please try again", 5);
                return redirect()->to(base_url() . "/products/add_category");
            }

        }


        return redirect()->to(base_url() . "/products/add_category");
    }

    public function view_category(int $id)
    {

        if (!session()->has("logged_user")) {

            return redirect()->to(base_url());

        }

        $data['userdata'] = $this->dashModel->getLoggedUserData((string)$this->user_id);
        $data['storedata'] = $this->dashModel->getLoggedStoreData($this->store_id);
        return view('category_view', $data);
    }


}
