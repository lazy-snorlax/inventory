<?php
  // Move image to public/uploads folder
  function moveImage($imageName){
    print_r($imageName);
    rename($imageName, 'public/uploads/');
  }