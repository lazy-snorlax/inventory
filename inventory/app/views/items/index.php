<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="container">
    <h1><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description'] ?></p>

    <!-- Add new item to the inventory -->
    <div class="mb-3">
      <a href="<?php echo URLROOT;?>/items/add" class="btn btn-block btn-success ">Add a new item to the Inventory</a>
    </div>
    <hr class="my-4">     
  </div>  

  <!-- List of Items -->
  <div class="container">
    <div class="row row-cols-1 row-cols-md-3">
      <?php if (!empty($data['items'])) : ?>
      <?php foreach($data['items'] as $item) : ?>
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <p class="text-right text-uppercase"><?php echo $item->categoryName; ?></p>        
              <h4 class="card-title">
                <?php echo $item->itemName; ?>
              </h4>
              <p class="font-weight-light">Uploaded by <?php echo $item->email; ?></p>

              <img src="<?php 
              $imageLocation = explode('/', $item->image_location);
              $imageNewName = $imageLocation[4].'/'.$imageLocation[5].'/'.$imageLocation[6];
              echo URLROOT.'/'.$imageNewName;
              // echo $item->image_location;
              ?>" alt="" width=100%>
              
              <div class="bg-light p-2 mb-3">
                <?php echo $item->description; ?>
              </div>
              <!-- Item Controls -->
              <?php if($item->userId == $_SESSION['user_id']):?>
              <div class="container">
                <a href="<?php echo URLROOT;?>/items/edit/<?php echo $item->itemId; ?>" class="btn btn-secondary">Edit</a>
                
                <form class="float-right" action="<?php echo URLROOT;?>/items/delete/<?php echo $item->itemId; ?>" method="post">
                  <input type="submit" value="Delete" class="btn btn-danger">
                </form>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php else : ?>
        <div class="text-center">
          <h4 class="lead">There are no items in database</h4>
        </div>
      <?php endif; ?>
    </div>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>