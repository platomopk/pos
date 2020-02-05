<?php 
include 'db_connect.php';
    

    if (isset($_GET['submit'])) {

        $itemName = ''; $quantity =''; $weight =''; 
        $unitpricecost=''; $unitpricesales=''; $itemId=''; $leftover=''; $wastage=''; $type='';
        $revisedWeight=''; $margin=''; $contents=''; $fats='';

        if (isset($_GET['content'])) {
            $contents = $_GET['content'];
        }
        if (isset($_GET['fats'])) {
            $fats = $_GET['fats'];
        }

        if (isset($_GET['itemName'])) {
            $itemName = $_GET['itemName'];
        }
        if (isset($_GET['quantity'])) {
            $quantity = $_GET['quantity'];
        }
        if (isset($_GET['weight'])) {
            $weight = $_GET['weight'];
        }
        if (isset($_GET['unitpricecost'])) {
            $unitpricecost = $_GET['unitpricecost'];
        }
        if (isset($_GET['unitpricesales'])) {
            $unitpricesales = $_GET['unitpricesales'];
        }
        if (isset($_GET['itemId'])) {
            $itemId = $_GET['itemId'];
        }
        
        if (isset($_GET['leftover'])) {
            $leftover = $_GET['leftover'];
        }
        
        if (isset($_GET['wastage'])) {
            $wastage = $_GET['wastage'];
        }
        
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }

        if (isset($_GET['margin'])) {
            $margin = $_GET['margin'];
        }

        //update the original item with this revised weight
        if (isset($_GET['revisedWeight'])) {
            $revisedWeight = $_GET['revisedWeight'];
        }

        //print_r($name);
        $valArr = array();
        
            
for($i=0;$i<count($unitpricesales);$i++)
{
    if (($quantity[$i]=="" || $quantity[$i]=="0") && ($weight[$i]=="" || $weight[$i]=="0") && ($unitpricecost[$i]=="" || $unitpricecost[$i]=="0") && ($unitpricesales[$i]=="" || $unitpricesales[$i]=="0")) {
        
    }else{
        $costprice = $quantity[$i] * $unitpricecost[$i];
        $saleprice = $quantity[$i] * $unitpricesales[$i];
        
     $valArr[]="('$itemName[$i]','self','$weight[$i]','$quantity[$i]','$costprice','$saleprice','$unitpricecost[$i]','$unitpricesales[$i]','$type','count','$itemId','0','$margin[$i]', '$contents[$i]','$fats[$i]')";
    }
 
} 
        


        // //attempt insertion 

        $query = "insert into bank (itemName,vendor,weight,count,price,salesPrice,unitPrice,unitsalesprice,type,subtype,parent,processable,margin,content,fats) values ";
        $query .= implode(',', $valArr);

        $querySearch2= mysqli_query($con,$query);

        if ($wastage == 0 || $wastage == '') {
            $queryUpdate = mysqli_query($con,"update bank set revisedWeight='$revisedWeight', leftover = '$leftover' where itemId='$itemId'");
        }else{

            $revisedWeight = $revisedWeight - $wastage;
            $leftover = $leftover - $wastage;

            $queryUpdate = mysqli_query($con,"update bank set revisedWeight='$revisedWeight', leftover = '$leftover', wastage = '$wastage' where itemId='$itemId'");
        }

        





        $getweight = mysqli_query($con,"select weight from bank where itemId='$itemId'");

        while ($row=mysqli_fetch_assoc($getweight)) {
            $vweight = $row ['weight'];
            $updateIT = mysqli_query($con,"insert into revisions (itemId,originalWeight,revisedWeight) values ('$itemId','$vweight','$revisedWeight')");
            $insertIntoWastage = mysqli_query($con,"insert into wastage (itemId,wasted) values ('$itemId','$wastage')");
        }

        

        if ($querySearch2) {
            echo 'success';
        }else{
            echo 'failure';
        }

    }

?>


