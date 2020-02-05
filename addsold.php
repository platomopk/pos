<?php 
include 'db_connect.php';
    

    //if (isset($_POST['submitnigger'])) {

        $itemId = ""; $name =""; $count =""; 
        $weight=""; $unitPrice=""; $price=""; $code=uniqid(); $userId="0"; $discount="0";

        if (isset($_POST['itemId'])) {
            $itemId = $_POST['itemId'];
        }
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['count'])) {
            $count = $_POST['count'];
        }
        if (isset($_POST['weight'])) {
            $weight = $_POST['weight'];
        }
        if (isset($_POST['unitprice'])) {
            $unitprice = $_POST['unitprice'];
        }
        if (isset($_POST['price'])) {
            $price = $_POST['price'];
        }
        if (isset($_POST['discount'])) {
            $discount = $_POST['discount'];
        }

        //print_r($price);
        

        $valArr = array();
        


    for($i=0;$i<count($price);$i++)
    {
        // add mixed and full array
        
         $valArr[]="('$itemId[$i]','$count[$i]','$weight[$i]','$price[$i]','$unitprice[$i]','$code','$discount[$i]')";
    } 
       
    

        // //attempt insertion 

        $query = "insert into sold (itemId,count,weight,price,unitPrice,code,discount) values ";
        $query .= implode(',', $valArr);

        $querySearch2= mysqli_query($con,$query);

        if ($querySearch2) {
            echo "Success";
        }else{
            echo "Err";
        }

    

?>


