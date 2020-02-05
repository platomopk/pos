<?php

include 'db_connect.php';

if (isset($_GET['itemId'])) {
    $itemId=$_GET['itemId'];
}

$childWeight = '';
$parentId='';


  $getchildweight = mysqli_query($con,"select weight from bank where itemId='$itemId' and itemId not in (select itemId from sold)");

  if (mysqli_num_rows($getchildweight)==0) {

 			echo "Err";

  }else{
  		 


  	while ($row = mysqli_fetch_assoc($getchildweight)) {
	      $childWeight = $row['weight'];
	  }

	  $getParentId=mysqli_query($con,"select parent from bank where itemId='$itemId'");
	  while ($row2 = mysqli_fetch_assoc($getParentId)) {
	      $parentId = $row2['parent'];
	  }

	  $updateparent=mysqli_query($con,"update bank set revisedWeight='$childWeight' where itemId='$parentId'");


	  $query= mysqli_query($con,
	  "delete from bank where itemId='$itemId'");

	  if (mysqli_affected_rows($con)>0) {
	    echo "success";
	  }else{
	      echo "Err";
	  }
  }






?>