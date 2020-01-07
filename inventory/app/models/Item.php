<?php
  class Item {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get All Items
    public function getAllItems(){
      $this->db->query('SELECT *,
                        items.id as itemId,
                        items.name as itemName,
                        items.created_at as itemCreated,
                        users.id as userId,
                        users.name as userName,
                        users.created_at as userCreated,
                        categories.id as categoryId,
                        categories.name as categoryName,
                        categories.created_at as categoryCreated
                        FROM items
                        INNER JOIN users 
                        INNER JOIN categories
                        ON items.user_id = users.id
                        AND items.category_id = categories.id
                        ');
      $results = $this->db->resultSet();
      return $results;
    }

    // Get Items for one user
    public function getItems($user_id){
      $this->db->query('SELECT *, FROM items WHERE user_id = :user_id');
      $this->db->bind(':user_id', $user_id);

      $results = $this->db->resultSet();
      return $results;
    }

    // Get Item By ID
    public function getItemByID($id){
      $this->db->query('SELECT *,
                        items.id as itemID,
                        categories.id as categoryID,
                        items.name as itemName,
                        categories.name as categoryName,
                        items.user_id as itemUserID,
                        categories.user_id as categoryUserID,
                        items.created_at as itemCreated,
                        categories.created_at as categoryCreated
                        FROM items
                        INNER JOIN categories
                        WHERE items.id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Add item
    public function addItem($data){
      $this->db->query('INSERT INTO 
                        items (
                          name, 
                          category_id, 
                          description, 
                          image_location, 
                          user_id
                          ) 
                        VALUES (
                          :name, 
                          :category_id, 
                          :description, 
                          :image_location, 
                          :user_id
                          )');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':category_id', $data['categories']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':image_location', $data['image_location']);
      $this->db->bind(':user_id', $data['user_id']);

      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update item
    public function updateItem($data){
      $this->db->query('UPDATE items SET
                      name = :name,
                      category_id = :category_id,
                      description = :description,
                      image_location = :image_location
                      WHERE id = :id                      
                      ');

      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':category_id', $data['categories']);
      $this->db->bind(':image_location', $data['image_location']);
      $this->db->bind(':description', $data['description']);

      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete item
    public function deleteItem($id){
      $this->db->query('DELETE FROM items WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update item image_location
    public function updateItemImageLocation($data){
      $this->db->query('UPDATE items SET
                      image_location = :image_location
                      WHERE items.id = :id                      
                      ');
      // print_r($data);
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':image_location', $data['image_location']);

      // Execute
      if ($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }