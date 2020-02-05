<?php

include 'db_connect.php';

if (isset($_GET['itemId'])) {
    $itemId=$_GET['itemId'];
}


  $query= mysqli_query($con,
  "Delete from bank where processable='1' and (itemId NOT IN (select parent from bank where parent='$itemId')) and (itemId = '$itemId') and (itemId NOT IN (Select itemId from sold))");

  if (mysqli_affected_rows($con)>0) {
    
    //echo mysqli_affected_rows($con);
    echo "success";

  }else{
      echo "Err";
    }




?>