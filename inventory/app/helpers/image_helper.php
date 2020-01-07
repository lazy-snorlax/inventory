<?php
  // Change the image_location from app/uploads to the public/uploads folder
  function renameImageLocation($image_location){
    $imageLocation = explode('\\', $image_location);
    $imageNewName = 'public/'.$imageLocation[5].'/'.$imageLocation[6];

    return $imageNewName;
  }

  // Empty public uploads folder
  /** This comes accross as hardcoded. Test in a live environment to see what tweaks are needed */
  function emptyPublicUploads(){
    $filepath = explode('\\', APPROOT);
    $files = glob($filepath[0].'//'.$filepath[1].'//'.$filepath[2].'//'.$filepath[3].'/public/uploads/*');

    foreach ($files as $file){
      if(is_file($file)){
        unlink($file);
      }
    }

  }