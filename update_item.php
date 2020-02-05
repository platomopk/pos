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
  $unitsalesprice = $_POST['unitsalesprice'];

  $itemId = $_POST['itemId'];

  $price ="";

  $checkifupdated = mysqli_query($con,"select bank.revisedWeight from bank where itemId='$itemId'");

  while ($row=mysqli_fetch_assoc($checkifupdated)) {
        
      if ($row["revisedWeight"]=="empty" && $revisedWeight!="empty") {
          //update table
        $updateIT = mysqli_query($con,"insert into revisions (itemId,originalWeight,revisedWeight) values ('$itemId','$weight','$revisedWeight')");

        $price = $revisedWeight * $unitsalesprice;

      }else  if ($row["revisedWeight"]!=$revisedWeight) {
          //update in 
        $updateIT = mysqli_query($con,"insert into revisions (itemId,originalWeight,revisedWeight) values ('$itemId','$weight','$revisedWeight')");

        $price = $revisedWeight * $unitsalesprice;
      }else{
        $price = $weight * $unitsalesprice;
      }
  }

  // if ($revisedWeight=="0") {
  //     // $updatePrice = mysqli_query($con,"SELECT bank.price-(SELECT ifnull(sum(sold.price),'0') From sold WHERE sold.itemId=bank.itemId) as price FROM bank WHERE bank.itemId='$itemId'");
  //     // while ($row = mysqli_fetch_assoc($updatePrice)) {
  //     //     $unit_price =$row['price']/$revisedWeight;
  //     // }
    
  // }else{
  //     // $unit_price =$price/$weight;
    
  // }






  $query= mysqli_query($con,
  "UPDATE bank set itemName='$itemName',vendor='$vendor',weight='$weight',revisedWeight='$revisedWeight',count='$count',salesPrice='$price',type='$type',subtype='$subtype',unitsalesprice='$unitsalesprice' where itemId='$itemId'" );

  if ($query) {
    
    echo 'success';

  }else {
    echo "Err";
    
  }

}else{
  echo "form error";
}


?>