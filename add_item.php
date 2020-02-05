<?php

include 'db_connect.php';

if (isset($_POST['submit'])) {

  $type = $_POST['type'];
  $subtype = $_POST['subtype'];
  $itemName = $_POST['itemName'];
  $vendor = $_POST['vendor'];
  $weight = $_POST['weight'];
  $revisedWeight = $_POST['revisedWeight'];
  $count = $_POST['count'];
  $price = $_POST['price'];
    $margin = $_POST['margin'];
  
  $unitsalesprice = $_POST['unitsalesprice'];
  $salesprice = $unitsalesprice * $weight;

  $unit_price ='';

  if ($subtype=="weight") {
      $unit_price = $price / $weight;
  }else{
      $unit_price = $price / $count;
  }


  $query= mysqli_query($con,
  "INSERT into bank (itemName,vendor,weight,count,price,type,subtype,unitPrice, unitsalesprice, salesPrice,margin) values ('$itemName','$vendor','$weight','$count','$price','$type','$subtype','$unit_price','$unitsalesprice','$salesprice','$margin')"
  );

  if ($query) {
    
    $query2= mysqli_query($con,"select max(itemId) as itemId from bank");    
    
    if (mysqli_num_rows($query2)>0) {
        while ($row = mysqli_fetch_assoc($query2)) {
            echo $row['itemId'];
        }
    }else{
      echo 'Err';
    }

  }else {
    echo "Err";
    
  }

}else{
  echo "form error";
}


?>