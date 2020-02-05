<?php
    session_start();
        if($_SESSION['adminSession']=="admin")
    {
        //header("location:choice.php");
    }else{
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>POS | INVENTORY</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">

    <script src="js/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
    <script src="js/form.js" type="text/javascript"></script>

    <style type="text/css" media="screen">
        body{
            background-color: #e8f2ff;
        }
        .outer {
            display: table;
            position: absolute;
            height: 100%;
            width: 100%;
        }

        .middle {
            display: table-cell;
            vertical-align: middle;
        }

        .inner {
            margin-left: auto;
            margin-right: auto; 
            width: /*whatever width you want*/;
        }    
        #header{
            height: auto;
        }
        #logo{
            margin: 0px;
            margin-top: 19px;
        }
        #logoutBtn{
         margin: 0px;
            margin-top: 15px;   
        }

        .textInput{
            background-color: transparent;
            border: none;
        }

        .form-control{
            margin-bottom: 15px;
        }
    </style>

</head>


<body style="overflow-x: hidden">

<section id="header" style="background-color: #B7D3F7">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
            <div class="col-md-6" >
                <a href="pos.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px">Open Point Of Sale</a>
                <a href="reports.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px;margin-left:5px;">View Reports</a>
            </div>
            <div class="col-md-6" >
                <input type="button" id="logoutBtn" value="Logout" class="btn btn-danger btn-sm pull-right" style="margin-bottom: 15px;">

            </div>
        </div>
    </div>
</section>

<br>

<section id="radiobtns">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                    <div class="row center-block text-center">
                        <h3>    
                            <strong>MANAGE INVENTORY</strong>
                        </h3>       
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="addNew" type="radio" name="ops" checked>Add New Items</label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="editOld" type="radio" name="ops">Edit Old Items
                        </label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="deleteOld" type="radio" name="ops">Delete Items
                        </label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="viewProcessed" type="radio" name="ops">View Processed
                        </label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="viewAll" type="radio" name="ops">View All Items
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br><br>
<section id="addSection">
    <form action="add_item.php" id="add_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="row">
                            <p class="text-center text-uppercase" style="text-decoration: underline;"><strong>Fill this form to add an item</strong></p>
                            <br>
                            <div class="col-md-6">
                                <!-- weight type -->
                                <label>Weighing Type</label>
                                <select name="subtype" class="form-control" required>
                                    <option value=""  disabled>Select Weighing Type</option>
                                    <option value="weight" selected>Weight</option>
                                    <option value="count" style="display:none;">Count</option>
                                </select>

                                <!-- item type -->
                                <label>Item Category</label>
                                <select name="type" id="maintypeselect" class="form-control" required>
                                    <option value="" selected disabled>Select Item Category</option>
                                    <option value="Mutton">Mutton</option>
                                    <option value="Chicken">Chicken</option>
                                    <option value="Veal">Veal</option>
                                </select>
                                <label>Item Name</label>
                                <select class="form-control" name="itemName" id="subcategory_select" required>
                                </select>
                                <label>Vendor</label>
                                <select class="form-control" name="vendor" id="vendor_select" required>
                                </select>

                               <!--  <input type="text" name="vendor" placeholder="Enter Vendor Name Here" class="form-control"> -->

                            </div>
                            <div class="col-md-6">
                                <label>Weight (KG)</label>
                                <input type="number" step="0.01" min="0" id="weightAdd"  name="weight" placeholder="Enter Item Weight Here" class="form-control">
                                <label style="display:none">Revised Weight (KG)</label>
                                <input type="number" step="0.01" min="0" value="0" name="revisedWeight" placeholder="Enter Item Weight Here (Revised)" class="form-control" style="display:none" readonly>
                                <label style="display:none">Count</label>
                                <input type="number" min="0" name="count" value="0" placeholder="Enter Item Count Here" class="form-control" style="display:none">
                                <label>Unit Cost Price (Rs)</label>
                                <input type="number" step="0.01" id="ucp" min="0" name="unitcostprice" placeholder="Enter Unit Cost Price Here" class="form-control">
                                
                                <label>Cost Price (Rs)</label>
                                <input type="number" step="0.01" id="cp" min="0" name="price" placeholder="Enter Item Cost Price Here" class="form-control">

                                
                                <label>Margin (%)</label>
                                <input type="number" step="0.01" id="margin" min="0" max="100" name="margin" placeholder="Enter Profit Margin Here" class="form-control">



                                <label>Unit Sales Price (Rs)</label>
                                <input type="number" id="txtSalePrice" step="0.01"  min="0" name="unitsalesprice" placeholder="Enter Unit Sale Price Here" class="form-control">

                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" name="submit" value="Add This Item In The Database" class="btn btn-primary text-center center-block">
                        </div>
                        <br>
                        <div class="row text-center" style="display:none">
                            <p style="text-decoration: underline;">Your Item has been added to the database and is currently printing; Please recieve the printed sticker and put it on the item</p>
                            <label id="itemIdLabel">ITEMID</label>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<section id="editSection" style="display: none">
    <form action="update_item.php" id="update_form" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="row">
                        <p style="margin-left:20px;" class=" text-uppercase" style="text-decoration: underline;"><strong>Search for the required item</strong></p>
                            <div class="col-md-6">
                                <input type="text" id="editText" placeholder="Enter Item ID Here" class="form-control" autofocus>    
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <p class="text-center text-uppercase" style="text-decoration: underline;"><strong>Edit the item by updating this form</strong></p>
                            <br>
                            <div class="col-md-6">

                            <input type="text" id="itemId" name="itemId" placeholder="Enter Item ID Here" class="form-control" style="display:none">

                                <!-- weight type -->
                                <label>Weighing Type</label>
                                <select name="subtype" id="subtype" class="form-control" required>
                                    <option value="" disabled>Select Weighing Type</option>
                                    <option value="weight" selected>Weight</option>
                                    <option value="count" style="display:none">Count</option>
                                </select>

                                <!-- item type -->
                                <label>Item Category</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled>Select Item Category</option>
                                    <option value="Mutton">Mutton</option>
                                    <option value="Chicken">Chicken</option>
                                    <option value="Veal">Veel</option>
                                </select>

                                <label>Item Name</label>
                                <!-- <input type="text" id="itemName" name="itemName" placeholder="Enter Item Name Here" class="form-control"> -->
                                <select name="itemName" id="itemName" required class="form-control">
                                </select>

                                <label>Vendor</label>
                                <!-- <input type="text" id="vendor" name="vendor" placeholder="Enter Vendor Name Here" class="form-control"> -->
                                <select name="vendor" id="vendor" required class="form-control">
                                </select>

                            </div>
                            <div class="col-md-6">
                                <label>Weight (KG)</label>
                                <input type="number" id="weight" step="0.01" min="0" name="weight" placeholder="Enter Item Weight Here" class="form-control">

                                <label>Revised Weight (KG)</label>&nbsp;<span id="revisedWeightSubLabelMin"></span>&nbsp;<span id="revisedWeightSubLabelMax"></span>

                                <input type="text" id="revisedWeight" name="revisedWeight" value="empty" placeholder="Enter Item Weight Here (Revised)" class="form-control">
                                <label style="display:none">Count</label>
                                <input type="number" min="0" name="count" placeholder="Enter Item Count Here" id="count" value="0" class="form-control" style="display:none">
                                <label>Unit Price Sales (Rs)</label>
                                <input type="number" step="0.01" min="0" name="unitsalesprice" placeholder="Enter Unit Sales Price Here" id="uspe" class="form-control">
                                <label style="display: none">Sales Price (Rs)</label>
                                <input style="display: none" type="number" id="spe" step="0.01" min="0" name="price" placeholder="Enter Item Price Here" id="price" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" name="submit" value="Update This Item In The Database" class="btn btn-primary text-center center-block">
                        </div>
                        <br>
                        <div class="row text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<section id="deleteSection" style="display: none">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="row">
                        <p style="margin-left:20px;" class=" text-uppercase" style="text-decoration: underline;"><strong>Search for the required item</strong></p>
                        <div class="col-md-4">
                            <input type="text" id="editTextDel" placeholder="Enter Item ID Here" class="form-control" autofocus>    
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table-hover" style="table-layout: fixed;" id="deleteTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Vendor</th>
                                    <th>Wgt.</th>
                                    <th>Rev. Wgt. </th>
                                    <th>Count</th>
                                    <th>Price</th>
                                    <th>AddedOn</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="viewSection" style="display: none">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="row">
                        <p style="margin-left:20px;" class=" text-uppercase" style="text-decoration: underline;"><strong>Search for the required item</strong></p>
                        <div class="col-md-4">
                            <input type="text" onkeyup="myFunction()" id="editTextView" placeholder="Enter Item Name Here" class="form-control" autofocus>    
                        </div>
                        <div class="col-md-8">
                            <input type="button" id="refresh" value="Refresh" class="btn btn-primary pull-right">
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-bordered " style="table-layout: fixed;" id="viewTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Vendor</th>
                                    <th>Wgt.</th>
                                    <th>Count</th>
                                    <th>Unit Price</th>
                                    <th>Price</th>
                                    <th>Left (Kg)</th>
                                    <th>Sold</th>
                                    <th>AddedOn</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="processedSection" style="display: none">
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                    <div class="row">
                        <p style="margin-left:20px;" class=" text-uppercase" style="text-decoration: underline;"><strong>Search for the required item</strong></p>
                        <div class="col-md-4">
                            <input type="text" id="editTextViewProcessed" placeholder="Enter Item ID Here" class="form-control" autofocus>    
                        </div>
                    </div>

                    <br>
                    <p class=" text-uppercase" style="text-decoration: underline;"><strong>parent item</strong></p>
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-bordered " style="table-layout: fixed;" id="viewParentTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Vendor</th>
                                    <th>Wgt.</th>
                                    <th>Count</th>
                                    <th>Unit Price</th>
                                    <th>Left (Kg)</th>
                                    <th>Sold</th>
                                    <th>Wastage</th>
                                    <th>AddedOn</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>


                    <br>
                    <p class=" text-uppercase" style="text-decoration: underline;"><strong>child items</strong></p>
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-bordered " style="table-layout: fixed;" id="viewChildTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Weight (Kg)</th>
                                    <th>Content (Kg)</th>
                                    <th>Fats (Kg)</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Price</th>
                                    <th>Sold</th>
                                    <th>AddedOn</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>






                </div>
            </div>
        </div>
    </div>
</section>




    <script type="text/javascript">
    	$().ready(function(){
           
            $('#editTextViewProcessed').on("keypress", function(e) {
                if (e.keyCode == 13) {
                            //populating the campaign select in dashboard
                    $.getJSON("getItem.php?itemId="+$('#editTextViewProcessed').val(),function(data){
                            var _len = data.length, post, i;
             
                            if (_len>0) {
                            $("#viewParentTable tr:has(td)").remove();
                            var trHTML = '';
                            $.each(data, function (i, item) {
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.wasted+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            });
                            $("#viewParentTable tbody").append(trHTML);
                            }else{
                                //show not found bar
                                alert("No Parent Found For This Item!");
                            }
                    });
                    //$('#editTextViewProcessed').val("");



                    //getchilds
                    $.getJSON("getchilditems.php?itemId="+$('#editTextViewProcessed').val(),function(data){
                            var _len = data.length, post, i;
             
                            if (_len>0) {
                            $("#viewChildTable tr:has(td)").remove();
                            var trHTML = '';
                            $.each(data, function (i, item) {
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.weight+'</td><td>'+item.content+'</td><td>'+item.fats+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td><td><a href="javascript:deleteChildItem('+item.itemId+');" class="btn btn-danger btn-xs">Delete</a></td></tr>';
                            });
                            $("#viewChildTable tbody").append(trHTML);
                            }else{
                                //show not found bar
                                alert("No Childs Found For This Item!");
                            }
                    });
                    $('#editTextViewProcessed').val("");



                    return false; // prevent the button click from happening
                }
            });





            $('#processModal').on('show.bs.modal', function (e) { //Modal Event
                var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
                var type = $(e.relatedTarget).data('type'); //Fetch id from modal trigger button
                
                $.getJSON("getItem.php?itemId="+id, function(data){
                    var _len = data.length, post, i;
     
                    if (_len>0) {
                        $.each(data, function (i, item) {
                            $('#showWeight').text(item.remaining);
                            $('#showPrice').text(item.unitPrice);
                            $('#processItemId').val(item.itemId);
                            $('#processtype').val(item.type); 

                        });
                    
                    }

                });
                

                // if (revweight=="empty") {
                //     $("#showWeight").text("Weight: "+weight);
                // }else{
                //     $("#showWeight").text("Revised Weight: "+revweight);
                // }
                
                $("#processed_inventory tr:has(td)").remove();

                //$("#typeProcess").val(type);

                $.getJSON("getallitemtypes.php?category="+type, function(data){
                    var _len = data.length, post, i;
     
                    if (_len>0) {
                    var trHTML = '';
                    $.each(data, function (i, item) {

                    //var price = $("#showPrice").text();

                    trHTML += '<tr><td><input type="text" class="textInput" name="itemName[]" style="width:100%" value="'+item.subcategory+'" readonly/></td><td><input type="number" name="quantity[]" min="0" value="0" style="width:100%"></td><td><input type="number" min="0" step="0.01" class="modalWeightClass" name="weight[]" value="0" style="width:100%"></td><td><input type="number" min="0" step="0.01" class="modalContentClass" name="content[]" value="0" style="width:100%"></td><td><input type="number" min="0" step="0.01" class="modalFatsClass" name="fats[]" value="0" style="width:100%"></td><td><input type="number" name="unitpricecost[]" class="costProcess" min="0" value="0" style="width:100%"></td><td><input type="number" class="marginProcess" name="margin[]" min="0" value="0" style="width:100%"></td><td><input type="number" name="unitpricesales[]" class="salesProcess" min="0" value="0" style="width:100%"></td></tr>';
                    });
                    $('#processed_inventory').append(trHTML);
                    }else{
                        //show not found bar
                        alert("No Data Found!");
                    }

                });

            });

            $('#processTable').on('change keyup keypress paste cut','.marginProcess', function(event){

                    //alert($(this).val());
                    var row = $(this).closest('tr');

                    row.find('.salesProcess').val(parseFloat(
                        row.find('.costProcess').val()) +parseFloat(
                        (row.find('.costProcess').val() *
                        (row.find('.marginProcess').val()/100)))

                        );

                    // row.find('.priceClass').val(parseFloat(row.find('.priceClass').val())-parseFloat($(this).val())); 
            });



            $('#processTable').on('change keyup keypress paste cut','.modalWeightClass', function(event){

                    //alert($(this).val());
                    var row = $(this).closest('tr');

                    var unit_price = $("#showPrice").text();

                    row.find('.costProcess').val(
                        $(this).val()*unit_price
                        );                    

                    // row.find('.priceClass').val((parseFloat(row.find('.unitPriceClass').val())*parseFloat(row.find('.weightClass').val())+parseFloat(row.find('.unitPriceClass').val())*parseFloat(row.find('.countClass').val()) - $(this).val() )) ;

                    // row.find('.priceClass').val(parseFloat(row.find('.priceClass').val())-parseFloat($(this).val())); 

                    var sum = 0;
                    $(".modalWeightClass").each(function(){
                        sum += +$(this).val();
                    });


                    $('#processrevisedWeight').val((parseFloat($("#showWeight").text()))-sum);

                    if (parseFloat(sum) > parseFloat($("#showWeight").text())) {
                        alert("Cant Exceed Base Weight!");
                        $(this).val(0);  

                        var sum = 0;
                        $(".modalWeightClass").each(function(){
                            sum += +$(this).val();
                        });

                        $('#processrevisedWeight').val((parseFloat($("#showWeight").text()))-sum);
                        $('#processleftover').val((parseFloat($("#showWeight").text()))-sum);                        
                        
                            row.css('background-color', '#FFCCBC');
                        
                    }
                    $('#processleftover').val((parseFloat($("#showWeight").text()))-sum);

                        row.css('background-color', '#DCEDC8');
                    

            });


            $('#revisionsModal').on('show.bs.modal', function (e) { //Modal Event
                var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
                
                 $("#revised_information tr:has(td)").remove();

                $.getJSON("getrevised.php?itemId="+id, function(data){
                    var _len = data.length, post, i;
     
                    if (_len>0) {
                    var trHTML = '';
                    $.each(data, function (i, item) {
                            trHTML += '<tr><td>' + item.name + '</td><td>' + item.originalWeight + '</td><td>' + item.revisedWeight + '</td> <td>' + item.revisedOn + '</td></tr>';
                    });
                    $('#revised_information').append(trHTML);
                    }else{
                        //show not found bar
                        alert("No Data Found!");
                    }

                });
       
            });

            $("#cp").on('keyup',function(){
                //alert($(this).val());
                $("#ucp").val((parseFloat($(this).val()))/(parseFloat($("#weightAdd").val())));
            });

            $("#ucp").on('keyup',function(){
                //alert($(this).val());
                $("#cp").val((parseFloat($(this).val()))*(parseFloat($("#weightAdd").val())));
            });

            $("#margin").on('keyup',function(){
                $("#txtSalePrice").val(parseFloat($("#ucp").val()) + (parseFloat($("#ucp").val())*($("#margin").val()/100)));
            });

            $("#refresh").click(function(){
                $.getJSON("getAllItems.php",function(data){
                        var _len = data.length, post, i;

                        if (_len>0) {
                        $("#viewTable tr:has(td)").remove();
                        var trHTML = '';
                        $.each(data, function (i, item) {

                        if (item.processable=="0" || item.remaining=="0") {

                            if (item.vendor=="self") {
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.unitsalesprice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            }else{
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            }

                            
                        }else{
                            trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td><td><a href="#processModal" data-id="'+item.itemId+'" data-type="'+item.type+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm">Process</a></td></tr>';
                        }


                        });
                        $('#viewTable tr:last').after(trHTML);
                        }else{
                            //show not found bar
                            alert("No Data Found For This Item!");
                            $("#viewTable tr:has(td)").remove();
                        }
                });
            });

            $("#logoutBtn").click(function(){
                window.location.href = "logoff.php";
            });

            $.getJSON("getAllItems.php",function(data){
                    var _len = data.length, post, i;
     
                    if (_len>0) {
                    $("#viewTable tr:has(td)").remove();
                    var trHTML = '';
                    $.each(data, function (i, item) {


                        if (item.processable=="0" || item.remaining=="0") {
                            // trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.revisedWeight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            if (item.vendor=="self") {
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.unitsalesprice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            }else{
                                trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td></tr>';
                            }
                        }else{
                            trHTML+='<tr><td><a href="#revisionsModal" data-id="'+item.itemId+'" data-toggle="modal" data-backdrop="static" data-keyboard="false">'+item.itemName+'</a></td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.count+'</td><td>'+item.unitsalesprice+'</td><td>'+item.salesPrice+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOnRefined+'</td><td><a href="#processModal" data-id="'+item.itemId+'" data-type="'+item.type+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-sm">Process</a></td></tr>';
                        }



                    });
                    $('#viewTable tr:last').after(trHTML);
                    }else{
                        //show not found bar
                        //alert("No Data Found For This Item!");
                        $("#viewTable tr:has(td)").remove();
                    }
            });

            $("#itemIdLabel").text("0");

            $("input[name=ops]").change(function(){
                if ($("#addNew").is(":checked")) {
                    $("#addSection").css('display', 'block');
                    $("#editSection").css('display', 'none');
                    $("#deleteSection").css('display', 'none');
                    $("#viewSection").css('display', 'none');
                    $("#processedSection").css('display', 'none');
                }else if($("#editOld").is(":checked")) {
                    $("#addSection").css('display', 'none');
                    $("#editSection").css('display', 'block');
                    $("#deleteSection").css('display', 'none');
                    $("#viewSection").css('display', 'none');
                    $("#processedSection").css('display', 'none');
                }else if($("#deleteOld").is(":checked")) {
                    $("#addSection").css('display', 'none');
                    $("#editSection").css('display', 'none');
                    $("#deleteSection").css('display', 'block');
                    $("#viewSection").css('display', 'none');
                    $("#processedSection").css('display', 'none');
                }else if($("#viewAll").is(":checked")) {
                    $("#addSection").css('display', 'none');
                    $("#editSection").css('display', 'none');
                    $("#deleteSection").css('display', 'none');
                    $("#viewSection").css('display', 'block');
                    $("#processedSection").css('display', 'none');
                }else if($("#viewProcessed").is(":checked")) {
                    $("#addSection").css('display', 'none');
                    $("#editSection").css('display', 'none');
                    $("#deleteSection").css('display', 'none');
                    $("#viewSection").css('display', 'none');
                    $("#processedSection").css('display', 'block');
                }
            });

            $('#add_form').ajaxForm({
                beforeSend:function(){

                },
                uploadProgress:function(event,position,total,percentComplete)
                {
                    
                },
                success:function(){
                    
                },
                complete:function(response){
                    $("#itemIdLabel").text(response.responseText);
                    alert("item successfully added!")
                    $("#add_form")[0].reset();
                    //show the barcode here
                }
            });

            $('#addchild').ajaxForm({
                beforeSend:function(){

                },
                uploadProgress:function(event,position,total,percentComplete)
                {
                    
                },
                success:function(){
                    
                },
                complete:function(response){
                    alert("items successfully added!")
                    location.reload();
                    //show the barcode here
                }
            });

            $('#update_form').ajaxForm({
                beforeSend:function(){

                },
                uploadProgress:function(event,position,total,percentComplete)
                {
                    
                },
                success:function(){
                    
                },
                complete:function(response){
                    if (response.responseText=="Err") {
                        alert("Couldnot update this item. Please try again");
                    }else{
                        alert("Successfully Updated!"); 
                        $("#update_form")[0].reset();   
                    }
                }
            });

            // handle enter press on textbox
            $('#editText').on("keypress", function(e) {
                if (e.keyCode == 13) {
                            //populating the campaign select in dashboard
                    $.getJSON("getItem.php?itemId="+$('#editText').val(),function(data){
                            var _len = data.length, post, i;
             
                            if (_len>0) {
                            var trHTML = '';
                            $.each(data, function (i, item) {
                                $('#itemId').val(item.itemId);
                                
                                $('#type').val(item.type);

                                setTimeout(function(){
                                    //$('#dashboard_campaign_select option:last').prop('selected',true);
                                    $('#subtype').val(item.subtype);
                                },1);

                                setTimeout(function(){
                                    //$('#dashboard_campaign_select option:last').prop('selected',true);
                                    $('#itemName').val(item.itemName);
                                },3);

                                
                                $('#vendor').val(item.vendor);
                                $('#weight').val(item.weight);

                                $('#revisedWeight').val(item.revisedWeight);
                                    if (item.sold==null) {
                                        //$('#revisedWeight').prop('min',0);   
                                        $('#revisedWeightSubLabelMin').text("min:0"); 
                                    }else{
                                        //$('#revisedWeight').prop('min',item.sold);
                                        $('#revisedWeightSubLabelMin').text("min:"+item.sold);
                                    }
                                    
                                    //$('#revisedWeight').prop('max',item.remaining);
                                    $('#revisedWeightSubLabelMax').text("max:"+item.remaining);

                                $('#count').val(item.count);
                                $('#price').val(item.salesPrice);
                                $('#uspe').val(item.unitsalesprice);
                            });
                            }else{
                                //show not found bar
                                alert("No Data Found For This Item!");
                                $('#revisedWeightSubLabelMax').text("");
                                $('#revisedWeightSubLabelMin').text("");
                            }
                    });
                    $('#editText').val("")
                    return false; // prevent the button click from happening
                }
            });

            // handle enter press on textbox
            $('#editTextDel').on("keypress", function(e) {
                if (e.keyCode == 13) {

                    $.getJSON("getItem.php?itemId="+$('#editTextDel').val(),function(data){
                            var _len = data.length, post, i;
             
                            if (_len>0) {
                            $("#deleteTable tr:has(td)").remove();
                            var trHTML = '';
                            $.each(data, function (i, item) {
                                trHTML='<tr><td>'+item.itemName+'</td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.revisedWeight+'</td><td>'+item.count+'</td><td>'+item.price+'</td><td>'+item.addedOnRefined+'</td><td><a href="javascript:deleteItem('+item.itemId+');" class="btn btn-danger btn-xs">Delete</a></td></tr>';
                            });
                            $('#deleteTable tr:last').after(trHTML);
                            }else{
                                //show not found bar
                                alert("No Data Found For This Item!");
                                $("#deleteTable tr:has(td)").remove();
                            }
                    });

                    //$('#editTextDel').val("")
                    return false; // prevent the button click from happening
                }
            });

            $.getJSON("getallvendors.php", function(data){
                var _len = data.length, post, i;
                
                if (_len>0) {
                    var trHTML = '';
                    trHTML='<option selected disabled>Select Vendor</option>';
                    $.each(data, function (i, item) {
                        trHTML += '<option value="'+item.name+'">'+item.name+'</option>';
                    });
                    $('#vendor_select').append(trHTML);
                    $('#vendor').append(trHTML);

                }else{
                    //show not found bar
                    var trHTML = '';
                    trHTML='<option selected disabled>Select Vendor</option>';
                    $('#vendor_select').append(trHTML);
                    $('#vendor').append(trHTML);
                    //alert("No Data Found For Retailer Profile!");
                }
            });

            $("#maintypeselect").on('change',function(){

                $("#subcategory_select").empty();
                
                $.getJSON("getallitemtypes.php?category="+$(this).val(), function(data){
                    var _len = data.length, post, i;
                    
                    if (_len>0) {
                        var trHTML = '';
                        trHTML='<option selected disabled>Select Item Name</option>';
                        $.each(data, function (i, item) {
                            trHTML += '<option value="'+item.subcategory+'">'+item.subcategory+'</option>';
                        });
                        $('#subcategory_select').append(trHTML);
                        //$('#itemName').append(trHTML);

                    }else{
                        //show not found bar
                        var trHTML = '';
                        trHTML='<option selected disabled>Select Item Name</option>';
                        $('#subcategory_select').append(trHTML);
                        //$('#itemName').append(trHTML);
                        //alert("No Data Found For Retailer Profile!");
                    }
                });
            });

            $.getJSON("getallitemtypesmain.php", function(data){
                var _len = data.length, post, i;
                $('#itemName').empty();
                if (_len>0) {
                    var trHTML = '';
                    trHTML='<option selected disabled>Select Item Name</option>';
                    $.each(data, function (i, item) {
                        trHTML += '<option value="'+item.subcategory+'">'+item.subcategory+'</option>';
                    });
                    $('#itemName').append(trHTML);
                    //$('#itemName').append(trHTML);

                }else{
                    //show not found bar
                    var trHTML = '';
                    trHTML='<option selected disabled>Select Item Name</option>';
                    $('#itemName').append(trHTML);
                    //$('#itemName').append(trHTML);
                    //alert("No Data Found For Retailer Profile!");
                }
            });

        });

        function deleteItem(itemID){
                $.ajax({
                    type: "get",
                    url: "deleteItem.php?itemId="+itemID,
                    data: {
                    },
                    success: function (response){

                        if (response=="Err") {
                            alert("This item cannot be deleted. It has been partially/fully sold before.");
                             
                        }else{
                             alert("Successfully Deleted!");  
                             $("#deleteTable tr:has(td)").remove();
                        }
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Couldnot delete at the moment. Please Try again after some time.")
                    }
                });
                return false;
        }

        //viewChildTable
        function deleteChildItem(itemID){
                $.ajax({
                    type: "get",
                    url: "deleteItemChild.php?itemId="+itemID,
                    data: {
                    },
                    success: function (response){

                        if (response=="Err") {
                            alert("This item cannot be deleted. It has been already sold.");
                            //alert(response);
                             
                        }else{
                             alert("Successfully Deleted!");  
                             $("#viewChildTable tr:has(td)").remove();
                        }
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Couldnot delete at the moment. Please Try again after some time.")
                    }
                });
                return false;
        }

        function myFunction() {
          // Declare variables 
          var input, filter, table, tr, td, i;
          input = document.getElementById("editTextView");
          filter = input.value.toUpperCase();
          table = document.getElementById("viewTable");
          tr = table.getElementsByTagName("tr");

          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            } 
          }
        }


    </script>




<?php include "show_revisions_modal.php";?>

<?php include "show_process_modal.php";?>

</body>
</html>