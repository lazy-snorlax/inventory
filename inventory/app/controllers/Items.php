<?php
  class Items extends Controller {
    public function __construct(){
      if (!isLoggedIn()){
        redirect('users/login');
      }
      $this->categoryModel = $this->model('Category');
      $this->itemModel = $this->model('Item');
      $this->userModel = $this->model('User');
    }

    public function index(){
      // Get Items
      $items = $this->itemModel->getAllItems();

      // Change item image locations to the public/uploads folder
      foreach ($items as $item){
        if (strpos($item->image_location, '\app\\') != false){
          // $imageLocation = explode('/', $item->image_location);
          
          $imageLocation = explode('\\', $item->image_location); 
          $imageNewName = $imageLocation[0].'/'.$imageLocation[1].'/'.$imageLocation[2].'/'.$imageLocation[3].'/'.'public/'.$imageLocation[5].'/'.$imageLocation[6];  
          copy($item->image_location, $imageNewName);

          $item->image_location = $imageNewName;
          $item->id = $item->itemId;
          // print_r($item);

          // Update the item model with new image locations
          // $this->itemModel->updateItemImageLocation($item);         
        } else {
        break;
        }
      }

      $data = [
        'title' => 'Item List',
        'description' => 'This is the item list where users can view the items they\'ve uploaded',
        'items' => $items
      ];

      $this->view('items/index', $data);
    }
    
    public function show(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
          'id' => '32',
          'imageLocation' => trim($_POST['imageLocation']),
          'imageNewLocation' => trim($_POST['imageNewLocation'])
        ];
        
        rename($data['imageLocation'], $data['imageNewLocation']);
        $items = $this->itemModel->updateItemImageLocation($data);
        $this->view('items/show', $data);

      } else {
        // Get Items
        $items = $this->itemModel->getItemByID('32');        
        $data = [
          'title' => 'Item List',
          'description' => 'This is the item list where users can view the items they\'ve uploaded',
          'items' => $items
        ];        
        $this->view('items/show', $data);
      }
    }

    public function add(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Get Uploaded Image
        $image = $_FILES['itemPic'];

        // Init data
        $data = [
          'name' => trim($_POST['name']),
          'categories' => trim($_POST['categories']),
          'description' => trim($_POST['description']),
          'image_location' => '',
          'name_err' => '',
          // 'category_err' => '',
          'description_err' => '',
          'image_err' => '',  
          'user_id' => $_SESSION['user_id']
        ];

        // Init image data
        $imageName = '';
        $imageTmpName = '';
        $imageSize = '';
        $imageError = '';
        $imageExt = '';
        $imageActualExt = '';
        $allowed = '';
        
        // Validate data
        if (empty($data['name'])){
          $data['name_err'] = 'Please enter a name for the item';
        }
        
        if (empty($data['description'])){
          $data['description_err'] = 'Please enter an item description';
        }

        if (empty($image)){
          $data['image_err'] = 'No image uploaded!';
        } else {
          $imageName = $image['name'];
          $imageTmpName = $image['tmp_name'];
          $imageSize = $image['size'];
          $imageError = $image['error'];

          $imageExt = explode('.', $imageName);
          $imageActualExt = strtolower(end($imageExt));
          $allowed = array('jpg', 'jpeg', 'png');

          if (in_array($imageActualExt, $allowed)){
            if ($imageError === 0){
              if ($imageSize < 1000000){
                // Validated
                // Upload image 
                $imageNameNew = $data['user_id']."_".$imageExt[0]."_".uniqid('', true).".".$imageActualExt;
                $imageDestination = APPROOT."\uploads\\".$imageNameNew;
                $data['image_location'] = $imageDestination;
                move_uploaded_file($imageTmpName, $imageDestination);
              } else {
                $data['image_err'] = 'The image is too big!';
              }
            } else {
              $data['image_err'] = 'There was an error uploading your file!';
            }
          } else {
            $data['image_err'] = 'You cannot upload images of this type!';
          }
        }
        
        // Make sure errors are empty
        if (empty($data['name_err']) && empty($data['description_err']) && empty($data['image_err'])){
          // Validated
          // Get category id
          $category = $this->categoryModel->getCategoryByName($data['categories']);
          $data['categories'] = $category->id;
          
          if ($this->itemModel->addItem($data)){
            // Update itemModel to 
            flash('item_add_success', 'New Item Added');
            redirect('items');
          } else {
            die('Something went wrong.');
          }          
        } else {
          // Load view with errors
          $this->view('items/add', $data);
        }
      } else {
        $categories = $this->categoryModel->getCategories();

        // Init data
        $data = [
          'name' => '',
          'categories' => $categories,
          'description' => '',
          // 'image' => trim($_POST['image']),
          'name_err' => '',
          // 'category_err' => '',
          'description_err' => '',
          'image_err' => ''
        ];
  
        $this->view('items/add', $data);
      }
    }

    public function edit($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'categories' => trim($_POST['categories']),
          'description' => trim($_POST['description']),
          'user_id' => $_SESSION['user_id'],
          'name_err' => '',
          'image_err' => '',
          'description_err' => ''
        ];

        // Init image data
        $imageName = '';
        $imageTmpName = '';
        $imageSize = '';
        $imageError = '';
        $imageExt = '';
        $imageActualExt = '';
        $allowed = '';

        // Validate data
        if (empty($data['name'])){
          $data['name_err'] = 'Please enter a name for the item';
        }

        if (empty($data['description'])){
          $data['description_err'] = 'Please enter an item description';
        }

        // if (empty($image)){
        //   $data['image_err'] = 'No image uploaded!';
        // } else {
        //   $imageName = $image['name'];
        //   $imageTmpName = $image['tmp_name'];
        //   $imageSize = $image['size'];
        //   $imageError = $image['error'];

        //   $imageExt = explode('.', $imageName);
        //   $imageActualExt = strtolower(end($imageExt));
        //   $allowed = array('jpg', 'jpeg', 'png');

        //   if (in_array($imageActualExt, $allowed)){
        //     if ($imageError === 0){
        //       if ($imageSize < 1000000){
        //         // Validated
        //         // Upload image 
        //         $imageNameNew = $data['id']."_".$data['user_id']."_".$imageExt[0].".".$imageActualExt;
        //         $imageDestination = APPROOT."\uploads\\".$imageNameNew;
        //         $data['image_location'] = $imageDestination;
        //         move_uploaded_file($imageTmpName, $imageDestination);
        //       } else {
        //         $data['image_err'] = 'The image is too big!';
        //       }
        //     } else {
        //       $data['image_err'] = 'There was an error uploading your file!';
        //     }
        //   } else {
        //     $data['image_err'] = 'You cannot upload images of this type!';
        //   }
        // }

        // Make sure no errors
        if (empty($data['name_err']) && empty($data['description_err']) && empty($data['image_err'])){
          // Validated
          // Get category id
          $category = $this->categoryModel->getCategoryByName($data['categories']);
          $data['categories'] = $category->id;
          // die(print_r($data));

          if ($this->itemModel->updateItem($data)){
            flash('item_edit_success', 'Item Updated');
            redirect('items');
          } else {
            die('Something went wrong.');
          }          
        } else {
          // Load view with errors
          $this->view('items/edit', $data);
        }
      } else {
        // Get existing item from model
        $item = $this->itemModel->getItemByID($id);
        $categories = $this->categoryModel->getCategories();

        // Check for owner
        if ($item->user_id != $_SESSION['user_id']){
          redirect('items');
        }

        $data = [
          'id' => $id,
          'name' => $item->itemName,
          'category' => $item->categoryName,
          'description' => $item->description,
          // 'image' => trim($_POST['image']),
          'name_err' => '',
          'category_err' => '',
          'description_err' => '',
          // 'image_err' => ''
          // 'user_id' => $_SESSION['user_id'] 
          'categories' => $categories
        ];

        // print_r($data);

        $this->view('items/edit', $data);        
      }
    }

    // Delete Item
    public function delete($id){
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get existing item from model
        $item = $this->itemModel->getItemByID($id);

        // Check for owner
        if ($item->user_id != $_SESSION['user_id']){
          redirect('items');
        }

        if ($this->itemModel->deleteItem($id)){
          flash('item_message', 'Item Removed');
          redirect('items');
        }
      } else {
        redirect('items');
      }
    }
  }