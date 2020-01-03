<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron">
    <h1 class="display-4"><?php echo $data['title']; ?></h1>
    <p class="h3"><?php echo $data['subtitle']; ?></p>
    <hr class="my-4">
    <p class="lead"><?php echo $data['description'] ?></p>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>