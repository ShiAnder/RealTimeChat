<?php
  $conn = mysqli_connect("localhost", "root", "", "chatapp");

  if($conn){
      //echo "Connected";
  }
  else {
      echo "Not Connected";
  }
?>