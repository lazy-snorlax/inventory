<?php
  class Pages extends Controller{
    public function __construct(){
      $this->categoryModel = $this->model('Category');
      $this->userModel = $this->model('User');
      $this->itemModel = $this->model('Item');
    }

    public function index(){
      $categories = $this->categoryModel->getCategories();
      $users = $this->userModel->getTotalUsers();
      $data = [
        'title' => 'The Inventory',
        'description' => 'This is an online inventory list built on the PHP MVC framework. The inventory can hold a variety of items, from those that you would find in a grocery store to those that would appear in a garden shop to things that a technology shop would have. Only registered users will be able to modify inventory listings.',
        'categories' => $categories,
        'users' => $users
      ];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About the Site',
        'subtitle' => 'Welcome to the Inventory!',
        'description' => 'This is an online inventory cataloging database built on a PHP MVC framework. Users can add to, edit and delete entries from the database, while guests only have access to the landing page.'
      ];
      $this->view('pages/about', $data);
    }
  }