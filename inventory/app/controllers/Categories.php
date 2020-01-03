<?php
  class Categories extends Controller {
    public function __construct(){
      if (!isLoggedIn()){
        redirect('users/login');
      }
      $this->categoryModel = $this->model('Category');
    }

    public function index(){
      $categories = $this->categoryModel->getCategories();

      $data =[
        'title' => 'Categories',
        'body' => 'A list of all the current categories in the Inventory',
        'categories' => $categories
      ];
      $this->view('categories/index', $data);
    }

    public function add(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'user_id' => $_SESSION['user_id'],
          'name_err' => ''  
        ];

        // Validate data
        if (empty($data['name'])){
          $data['name_err'] = 'Please enter a name for the item';
        }

        // Make sure errors are empty
        if (empty($data['name_err'])){
          // Validated
          if ($this->categoryModel->addCategory($data)){
            flash('category_add_success', 'New Category Added');
            redirect('categories');
          } else {
            die('Something went wrong.');
          }          
        } else {
          // Load view with errors
          $this->view('categories/add', $data);
        }
      } else {
        // Init data
        $data = [
          'name' => '',
          'name_err' => ''
        ];
  
        $this->view('categories/add', $data);
      }
    }

    public function edit($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // die('post');
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'name_err' => ''  
        ];

        // Validate data
        if (empty($data['name'])){
          $data['name_err'] = 'Please enter a name for the item';
        }

        // Make sure errors are empty
        if (empty($data['name_err'])){
          // Validated
          // print_r($data);
          if ($this->categoryModel->updateCategory($data)){
            flash('category_update_success', 'Category Updated');
            redirect('categories');
          } else {
            die('Something went wrong.');
          }          
        } else {
          // Load view with errors
          $this->view('categories/edit', $data);
        }
      } else {
        // Get existing category from model
        $category = $this->categoryModel->getCategoryByID($id);

        $data = [
          'id' => $id,
          'name' => $category->name,
          'name_err' => ''
        ];
  
        $this->view('categories/edit', $data);
      }
    }

    // Delete category
    public function delete($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing category from model
        $category = $this->categoryModel->getCategoryByID($id);
        // die('success');

        if ($this->categoryModel->deleteCategory($id)){
          flash('category_delete_message', 'Category Removed');
          redirect('categories');
        }
      } else {
        redirect('categories');
      }
    }
  }