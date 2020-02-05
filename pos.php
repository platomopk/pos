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
	<title>Awesome POS | SCREEN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">

    <script src="js/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
    <script src="js/form.js" type="text/javascript"></script>

    <!-- JS file -->
<script src="js/jquery.easy-autocomplete.min.js"></script> 

<!-- CSS file -->
<link rel="stylesheet" href="css/easy-autocomplete.min.css"> 

<!-- Additional CSS Themes file - not required-->
<link rel="stylesheet" href="css/easy-autocomplete.themes.min.css"> 

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
        .inputText{
            background-color: transparent;
            border: none;
        }
    </style>

</head>


<body style="overflow-x: hidden">

<section id="header" style="background-color: #B7D3F7">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
            <div class="col-md-6" >
                <a href="inventory.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px">Check Inventory</a>
                <a href="reports.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px;margin-left:5px;">View Reports</a>
            </div>
            <div class="col-md-6" >
                <input type="button" id="logoutBtn" value="Logout" class="btn btn-danger btn-sm pull-right" style="margin-bottom: 15px;">
            </div>
        </div>
    </div>
</section>

<br>
<section id="amountSection">
    <div class="row">
        <div class="container" >
            <div class="row" >
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="background-color: transparent">
                    <div class="row">
                        <div class="col-md-4" style="background-color: #ef9a9a; margin: 5px 0px 5px 0px;">
                            <div class="row text-center center-block">
                                <p style="margin-bottom: 0px; margin-top:15px; font-weight: 600" class="lead" id="amount">0</p>
                            </div>
                            <div class="row text-center center-block">
                                <p style="margin-bottom: 0px;margin-bottom: 15px;font-weight: 200;" class="lead">Total Bill (Rs)</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="background-color: #ffcdd2; margin: 5px 0px 5px 0px;">
                            <div class="row text-center center-block">
                                <input style="margin-bottom: 0px; margin-top:13px; font-weight: 600" type="text" value="0" placeholder="0" class="inputText lead text-center" id="recieved">
                            </div>
                            <div class="row text-center center-block">
                                <p style="margin-bottom: 0px;margin-bottom: 15px;font-weight: 200;" class="lead">Cash Received (Rs)</p>
                            </div>
                        </div>
                        <div class="col-md-4" style="background-color: #ef9a9a; margin: 5px 0px 5px 0px;">
                            <div class="row text-center center-block">
                                <input style="margin-bottom: 0px; margin-top:13px; font-weight: 600" type="text" value="N/A" placeholder="0" class="inputText lead text-center" id="balance">
                            </div>
                            <div class="row text-center center-block">
                                <p style="margin-bottom: 0px;margin-bottom: 15px;font-weight: 200;" class="lead">Balance (Rs)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br>
<section id="posSection">
    <div class="row">
        <div class="container">
            <!-- enter id -->
            <div class="row" >
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="background-color: transparent; ">
                    <div class="row">
                        <dic class="col-md-12">
                            <input type="text" id="productIdTxt" style="height:60px;" placeholder="Product Id Here" class="form-control" autofocus>
                        </dic>
                        <dic class="col-md-1" style="height: 60px; display: none">
                            <input type="button" id="productIdBtn" value="Add to cart" class="btn btn-primary" style="display: none">
                            <span id="spinner" class="center-block text-center" style="display: block"><i class="fa fa-spinner fa-spin fa-3x" style="margin-top:6px;"></i></span>
                        </dic>
                    </div>
                </div>
            </div>

            <br>
            <!-- show information -->
            <div class="row" >
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" >
                    <form action="addsold.php" id="add_sold_form" method="post">
                        <div class="table table-responsive">
                            <table id="posTable" class="table table-striped table-bordered table-hover"  >
                                <thead>
                                    <tr style="background-color:#B7D3F7">
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Weight (KG)</th>
                                        <th>Unit Price (Rs)</th>
                                        <th>Price (Rs)</th>
                                        <th>Discount (Rs)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <input style="margin-left: 10px;" type="button" value="Make Purchase" class="btn btn-success btn-sm pull-right" id="mpBtn">
                            <!-- <input type="submit" name="submitnigger" value="Save" class="btn btn-primary btn-sm pull-right" id="saveBtn"> -->
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>




    <script type="text/javascript">
    	$().ready(function(){

            $("#logoutBtn").click(function(){
                window.location.href = "logoff.php";
            });

            var idsArray = new Array();

            $('#posTable').on('change keyup keypress paste cut','.weightClass', function(event){

                     var row = $(this).closest('tr');

                    row.find('.priceClass').val(parseFloat(row.find('.unitPriceClass').val())*parseFloat(row.find('.weightClass').val())); 

                    var sum = 0;
                        $(".priceClass").each(function(){
                            sum += +$(this).val();
                        });
                        $("#amount").text(parseInt(sum));

            });

            $('#posTable').on('change keyup keypress paste cut','.countClass', function(event){

                     var row = $(this).closest('tr');

                    row.find('.priceClass').val(parseFloat(row.find('.unitPriceClass').val())*parseFloat(row.find('.countClass').val())); 

                    var sum = 0;
                        $(".priceClass").each(function(){
                            sum += +$(this).val();
                        });
                        $("#amount").text(parseInt(sum));

            });

            $('#posTable').on('change keyup keypress paste cut','.discountClass', function(event){

                    var row = $(this).closest('tr');

                    // alert(row.find('.weightClass').val());
                    // alert(row.find('.countClass').val());
                    // alert(row.find('.unitPriceClass').val());
                    // alert(row.find('.priceClass').val());
                    // alert($(this).val());
                    //alert(row.find('.weightClass').val());

                    if (row.find('.weightClass').val()!=0 && row.find('.countClass').val()!=0) {
                        //alert("both");

                        row.find('.priceClass').val((parseFloat(row.find('.unitPriceClass').val()))-$(this).val());
                        //refurbished item what is unit price is the total price
                        // row.find('.priceClass').val("007");
                        // row.find('.priceClass').val(parseFloat(row.find('unitPriceClass').val())-parseFloat($(this).val()));

                    }else if(row.find('.weightClass').val()!=0){
                        //alert("weight");
                        //weight*unit price
                        // row.find('.priceClass').val((row.find('unitPriceClass').val()*row.find('weightClass').val())-$(this).val());

                        row.find('.priceClass').val((parseFloat(row.find('.unitPriceClass').val())*parseFloat(row.find('.weightClass').val()))-$(this).val()); 

                    }else if(row.find('.countClass').val()!="0"){
                        alert("count");
                        //count*unitpirce
                        row.find('.priceClass').val((row.find('unitPriceClass').val()*row.find('countClass').val())-$(this).val());
                    }else{
                        alert("kutta");
                    }

                    //row.find('.priceClass').val( row.find('.priceClass').val() -  $(this).val() ) ;

                    // row.find('.priceClass').val(parseFloat(row.find('.priceClass').val())-parseFloat($(this).val())); 

                    var sum = 0;
                    $(".priceClass").each(function(){
                        sum += +$(this).val();
                    });
                    $("#amount").text(parseInt(sum));

            });


            $('#posTable').on('click','.deleteBtn', function(event){
                event.preventDefault();
                $(this).closest('tr').remove();
                        var sum = 0;
                        $(".priceClass").each(function(){
                            sum += +$(this).val();
                        });
                        $("#amount").text(parseInt(sum));
                return false;
            });

// handle enter press on textbox


            $('#recieved').on("keypress", function(e) {
                if (e.keyCode == 13) {

                    if (parseInt($("#balance").val())==0 || parseInt($("#balance").val())>=0) {
                        $("#add_sold_form").submit();
                        //alert("fully paid");
                    }else{
                        alert("Full cash was not paid");
                    }
                    
                    //$("#add_sold_form")[0].submit();
                }
            });

            $('#recieved').on("keyup change", function(e) {
                // alert($(this).val());
                // alert($("#amount").text());
                $("#balance").val(parseInt($(this).val())- parseInt($("#amount").text()) );
            });




            $('#recieved').on('focus', function (e) {
                $(this)
                    .one('mouseup', function () {
                        $(this).select();
                        return false;
                    })
                    .select();
            });

            $("#mpBtn").click(function(){
                if ($("#posTable > tbody > tr").length == 0) {
                    alert("no rows");
                }else{
                    $("#recieved").focus();
                }
            });


            $('#add_sold_form').ajaxForm({
                beforeSend:function(){
                    if ($("#posTable > tbody > tr").length == 0) {
                        alert("no rows");
                        preventDefault();
                    }
                },
                uploadProgress:function(event,position,total,percentComplete)
                {
                    
                },
                success:function(){
                    
                },
                complete:function(response){
                    if (response.responseText=="Err") {
                        alert("Couldnot add this cart. Please try again");
                    }else{
                        alert("Successfully Sold!"); 
                        location.reload();  
                    }
                    

                    //show the barcode here
                }
            });


            var options = {

              url: "smartsearch.php",

              getValue: "itemName",

              list: {   
                match: {
                  enabled: true
                }
              },

              theme: "bootstrap"
            };

            $("#productIdTxt").easyAutocomplete(options);

            $('#productIdTxt').on("keypress", function(e) {
                if (e.keyCode == 13) {
                    $("#spinner").css('display','block');

                    var arr = new Array();
                    //var arr2 = new Array();
                    
                    if ($("#productIdTxt").val()=="") {
                        alert("Please scan a product first");
                    }else{
                        $(".itemIdClass").each(function(){
                            arr.push($(this).val());
                        });
                        if(jQuery.inArray($("#productIdTxt").val(),arr) == -1){
                            $.getJSON("getItemForSale.php?itemId="+$('#productIdTxt').val(),function(data){
                                var _len = data.length, post, i;

                                if (_len>0) {
                                var trHTML = '';
                                $.each(data, function (i, item) {
                                    if (item.count=="0" && item.weight!="0") {
                                        trHTML='<tr><td><input type="text" class="itemIdClass inputText" name="itemId[]" value="'+item.itemId+'" readonly></td><td><input type="text" class="inputText nameClass" name="name[]" value="'+item.itemName+'" readonly></td><td><input type="number" min="0" class="countClass inputText" name="count[]" max="'+item.count+'" value="'+item.count+'" readonly></td><td><input type="number" class="weightClass" min="0" style="width:100%"  max="'+item.weight+'" name="weight[]" value="'+item.weight+'"></td><td><input type="number" class="unitPriceClass inputText" min="0" max="'+item.unitPrice+'" name="unitprice[]" value="'+parseInt(item.unitPrice)+'" readonly></td><td><input type="number" class="priceClass inputText" min="0" max="'+item.unitPrice*item.weight+'" name="price[]" value="'+parseInt(item.unitPrice*item.weight)+'" readonly></td><td><input type="number" class="discountClass" min="0" style="width:100%"  name="discount[]" value="0"/></td><td><input type="button" value="delete" class="btn btn-danger btn-xs deleteBtn"></td></tr>';
                                    }else if(item.count!="0" && item.weight=="0"){
                                        trHTML='<tr><td><input type="text" name="itemId[]" class="itemIdClass inputText"  value="'+item.itemId+'" readonly></td><td><input type="text" name="name[]" class="inputText nameClass" value="'+item.itemName+'" readonly></td><td><input type="number" min="0" class="countClass" name="count[]" max="'+item.count+'" value="'+item.count+'"></td><td><input type="number" min="0" class="weightClass inputText"  max="'+item.weight+'" name="weight[]" style="width:100%" value="'+item.weight+'" readonly></td><td><input type="number" min="0" class="unitPriceClass inputText" max="'+item.unitPrice+'" name="unitprice[]" value="'+parseInt(item.unitPrice)+'" readonly></td><td><input type="number" min="0" max="'+item.unitPrice*item.count+'" name="price[]" class="priceClass inputText" value="'+parseInt(item.unitPrice*item.count)+'" readonly></td><td><input type="number" class="discountClass" min="0" style="width:100%"  name="discount[]" value="0" /></td><td><input type="button"  value="delete" class="btn btn-danger btn-xs deleteBtn"></td></tr>';
                                    }else if(item.count!="0" && item.weight!="0"){
                                        trHTML='<tr><td><input type="text" name="itemId[]" class="itemIdClass inputText"  value="'+item.itemId+'" readonly></td><td><input type="text" name="name[]" class="inputText nameClass" value="'+item.itemName+'" readonly></td><td><input type="number" min="0" class="countClass inputText" name="count[]" max="'+item.count+'" value="'+item.count+'" readonly></td><td><input type="number" min="0" class="weightClass inputText"  max="'+item.weight+'" name="weight[]" style="width:100%" value="'+item.weight+'" readonly></td><td><input type="number" min="0" class="unitPriceClass inputText" max="'+item.unitPrice+'" name="unitprice[]" value="'+parseInt(item.unitPrice)+'" readonly></td><td><input type="number" min="0" max="'+item.unitPrice+'" name="price[]" class="priceClass inputText" value="'+item.unitPrice+'" readonly></td><td><input type="number" class="discountClass" min="0" style="width:100%"  name="discount[]" value="0" /></td><td><input type="button"  value="delete" class="btn btn-danger btn-xs deleteBtn"></td></tr>';
                                    }
                                    
                                    });

                                        $('#posTable tbody').append(trHTML);
                                        $("#spinner").css('display','none');
                                        $("#productIdTxt").val("");
                                        var sum = 0;
                                        $(".priceClass").each(function(){
                                            sum += +$(this).val();
                                        });
                                        $("#amount").text(parseInt(sum));
                                   
                                }else{
                                    alert("No Data Found For This Item!");
                                    $("#productIdTxt").val("");
                                    $("#spinner").css('display','none');
                                }
                            });
                        }else{
                            alert("Item already added!");
                            $("#spinner").css('display','none');
                            $("#productIdTxt").val("");

                        }
                    }
                }
            });



        });


        


    </script>

</body>
</html>