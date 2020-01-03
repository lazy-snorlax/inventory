<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/categories" class="btn btn-secondary"> Back</a>

  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Update Category</h2>
        <p>Please fill out this form to add a new category for the Inventory</p>
        <form action="<?php echo URLROOT; ?>/categories/edit/<?php echo $data['id']; ?>" method="post">
          <div class="form-group">
            <label for="name">Category Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Update Inventory" class="btn btn-success btn-block">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>