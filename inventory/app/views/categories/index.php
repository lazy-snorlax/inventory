<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="container">
    <h1><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['body'] ?></p>

    <!-- Add new item to the inventory -->
    <div class="mb-3">
      <a href="<?php echo URLROOT;?>/categories/add" class="btn btn-block btn-success ">Add a new Category to the Inventory</a>
    </div>
    <hr class="my-4">     
  </div>  

  <!-- List of categories -->
  <div class="container">
    <div class="row row-cols-1 row-cols-md-4">
      <?php if (!empty($data['categories'])) : ?>
      <?php foreach($data['categories'] as $category) : ?>
        <div class="col card card-body mg-3">
          <h4 class="card-title">
            <?php echo $category->categoryName; ?>
          </h4>
          <p>Created by <?php echo $category->userName; ?></p>
          <!-- category Controls -->
          <div class="container">
            <a href="<?php echo URLROOT;?>/categories/edit/<?php echo $category->categoryId; ?>" class="btn btn-secondary">Edit</a>  

            <form class="float-right" action="<?php echo URLROOT;?>/categories/delete/<?php echo $category->categoryId; ?>" method="post">
              <input type="submit" value="Delete" class="btn btn-danger">
            </form>
          </div>
        </div>
      <?php endforeach; ?>
      <?php else : ?>
        <h4 class="text-center lead">There are no categories in Inventory</h4>
      <?php endif; ?>
    </div>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>