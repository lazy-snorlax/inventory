<?php
  class Category {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get All Categories
    public function getCategories(){
      $this->db->query('SELECT *,
                        categories.id as categoryId,
                        users.id as userId,
                        categories.name as categoryName,
                        users.name as userName,
                        categories.created_at as categoryCreated,
                        users.created_at as userCreated
                        FROM categories
                        INNER JOIN users 
                        ON categories.user_id = users.id
                        ');
      $results = $this->db->resultSet();
      return $results;
    }
    
    // Get All Categories Names
    public function getCategoryNames(){
      $this->db->query('SELECT categories.name,
                        categories.id as categoryId,
                        categories.name as categoryName,
                        categories.created_at as categoryCreated
                        FROM categories
                        ');
      $results = $this->db->resultSet();
      return $results;
    }

    // Get Category by id
    public function getCategoryByID($id){
      $this->db->query('SELECT * FROM Categories WHERE id = :id');
      $this->db->bind(':id', $id);
      $row = $this->db->single();
      return $row;
    }
    
    // Get Category by name
    public function getCategoryByName($name){
      $this->db->query('SELECT * FROM Categories WHERE name = :name');
      $this->db->bind(':name', $name);
      $row = $this->db->single();
      return $row;
    }

    // Get Categories uploaded by single user
    public function getCategoriesByUserID($user_id){
      $this->db->query('SELECT * FROM categories WHERE user_id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $results = $this->db->resultSet();
      return $results;
    }

    // Add Category
    public function addCategory($data){
      $this->db->query('INSERT INTO 
                        categories (name, user_id) 
                        VALUES (:name, :user_id)');
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':user_id', $data['user_id']);
      
      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Edit Category
    public function updateCategory($data){
      $this->db->query('UPDATE categories SET
                      name = :name,
                      user_id = :user_id
                      WHERE id = :id                      
                      ');
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':user_id', $_SESSION['user_id']);

      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Category
    public function deleteCategory($id){
      $this->db->query('DELETE FROM categories WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }