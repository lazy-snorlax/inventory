<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/items" class="btn btn-secondary"> Back</a>

  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Add a new item</h2>
        <p>Please fill out this form to add a new item for the Inventory</p>
        <form action="<?php echo URLROOT; ?>/items/add" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Item Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="dropdown mb-3">
            <select id="List" name="categories" class="btn dropdown-toggle">
            <!-- Use PHP to fetch Categories from model -->
            <?php foreach($data['categories'] as $category) : ?>
              <?php if($data['categoryName'] == $category) : ?>
                <option class="dropdown-item" selected><?php echo $category->categoryName; ?></option>
              <?php else : ?>
                <option class="dropdown-item"><?php echo $category->categoryName; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="description">Item Description: <sup>*</sup></label>
            <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description']; ?>
            </textarea>
            <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="image">Upload Image: </label>
            <input type="file" name="itemPic">
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Add to Inventory" class="btn btn-success btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>