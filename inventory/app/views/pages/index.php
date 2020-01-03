<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
  </div>

  <div class="container">
    <?php if (isset($_SESSION['user_id'])) : ;?>
      <h1>Hello <?php echo $_SESSION['user_name']; ?>, how are you today?</h1>
      <br>
      <h3 class="h3">Inventory Current Status</h3>
      <p> Total Users Registered: </p>
      <p> Total Items Registered: </p>
    <?php endif;?>
    <br>
    <br>
  </div>

  <div class="container">
    <h3>Inventory Categories</h3>
    <p>The following is a list of current Inventory Categories. All items in the Inventory have a category. To add a new category, edit a category or delete a category, please contact your system admin.</p>

    <!-- List of categories -->
    <div class="row row-cols-1 row-cols-md-4">
      <?php if (!empty($data['categories'])) : ?>
      <?php foreach($data['categories'] as $category) : ?>
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <h4 class="lead text-center text-uppercase">
                <?php echo $category->categoryName; ?>
              </h4>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php else : ?>
        <h4 class="text-center lead">There are no categories in Inventory</h4>
      <?php endif; ?>
    </div>
  </div>
  
<?php require APPROOT . '/views/inc/footer.php'; ?>