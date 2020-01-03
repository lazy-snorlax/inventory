<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="container">
    <!-- <h1><?php echo $data['title']; ?></h1> -->
    <!-- <p class="lead"><?php echo $data['description'] ?></p> -->

    <!-- Add new item to the inventory -->
    <hr class="my-4">     
  </div>

  <img src="C:\xampp\htdocs\inventory\app\uploads\17_headphones_5e0ed0b1546aa4.87027158.jpg" alt="">

  <br>
  <br>

  Item Name:
  <br>
  <input class="form-control form-control-lg" type="text" name="itemname" value="<?php echo $data['items']->itemName;?>">
  <br>
  <br>
  <form action="<?php echo URLROOT;?>/items/show" method="post">
  Item Location:
  <br>
  <input class="form-control form-control-lg" type="text" name="imageLocation" value="<?php echo $data['items']->image_location;?>">
  <br>
  <br>
  New Item Location:
  <br>
  <input class="form-control form-control-lg" type="text" name="imageNewLocation" value="<?php 
    $imageLocation = explode('\\', $data['items']->image_location);

    $imageNewName = $imageLocation[0].'/'.$imageLocation[1].'/'.$imageLocation[2].'/'.$imageLocation[3].'/'.'public/'.$imageLocation[5].'/'.$imageLocation[6]; 
    
    echo $imageNewName;
  ?>">
  <br>
  <br>

    <input type="submit" value="Update Image Location" class="btn btn-danger">
  </form>

  <br>
  <br>

  <img src="public/uploads/17_headphones_5e0ed0b1546aa4.87027158.jpg" alt="">
  



<?php require APPROOT . '/views/inc/footer.php'; ?>