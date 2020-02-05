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
	<title>Awesome POS | REPORTS</title>
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

        .form-control{
            margin-bottom: 15px;
        }

        .priceClass{
            background-color: transparent; border: none;
        }
    </style>

</head>


<body style="overflow-x: hidden">

<section id="header" style="background-color: #B7D3F7">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
            <div class="col-md-6" >
                <a href="pos.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px">Open Point Of Sale</a>
                <a href="inventory.php" class="btn btn-default btn-sm pull-left" style="margin-top: 15px;margin-left:5px;">Check Inventory</a>
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
                            <strong>REPORTS</strong>
                        </h3>       
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="transaction" type="radio" name="ops" checked>Transaction Reports</label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="inventory" type="radio" name="ops">Inventory Reports
                        </label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="purchase" type="radio" name="ops">Purchase Reports
                        </label>
                        <label class="radio-inline" style="text-decoration: underline;">
                            <input id="wastage" type="radio" name="ops">Wastage Reports
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<br>
<section id="transactionSection">
    <section>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="row center-block text-center">
                            <h3>    
                                <strong> </strong>
                            </h3>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="center-block text-center">Start Date</label>
                                <input class="form-control" type="date" id="startDate" placeholder="Select Start Date">
                            </div>
                            <div class="col-md-4">
                                <label class="text-center center-block">End Date</label>
                                <input class="form-control" type="date" id="endDate" placeholder="Select End Date">
                            </div>
                            <div class="col-md-4">
                                <label style="visibility: hidden">Action</label>
                                <input type="button" id="reportBtn" value="Get Report" class="btn btn-primary" style="width:100%">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <h4 id="earned" class="center-block text-center"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <input type="button" value="Export Excel File" id="btnExport"  class="btn btn-default btn-sm pull-right" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table hover" style="table-layout: fixed" id="reportsTable">
                        <thead>
                            <tr>
                                <th>ItemId</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Weight (Kg)</th>
                                <th>Price Cost (Rs)</th>
                                <th>Price Sales(Rs)</th>
                                <th>Discount (Rs)</th>
                                <th>Profit</th>
                                <th>Code</th>
                                <th>Sold On</th>
                            </tr>
                        </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </section>    
</section>

<section id="inventorySection" style="display: none">
    <section>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <input type="button" value="Export Excel File" id="btnExportInventory"  class="btn btn-default btn-sm pull-right" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table hover" style="table-layout: fixed" id="inventoryTable">
                        <thead>
                            <tr>
                                <th>ItemId</th>
                                <th>Name</th>
                                <th>Weight</th>
                                <th>Rev Weight (Kg)</th>
                                <th>Quantity</th>
                                <th>Margin (%)</th>
                                <th>Unit Cost(Rs)</th>
                                <th>Cost (Rs)</th>
                                <th>Remaining</th>
                                <th>Sold</th>
                                <th>Added On</th>
                                <th>Age (Days)</th>
                            </tr>
                        </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </section>   
</section>

<section id="purchaseSection" style="display: none">
    <section>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="row center-block text-center">
                            <h3>    
                                <strong> </strong>
                            </h3>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="center-block text-center">Start Date</label>
                                <input class="form-control" type="date" id="startDatePurchase" placeholder="Select Start Date">
                            </div>
                            <div class="col-md-4">
                                <label class="text-center center-block">End Date</label>
                                <input class="form-control" type="date" id="endDatePurchase" placeholder="Select End Date">
                            </div>
                            <div class="col-md-4">
                                <label style="visibility: hidden">Action</label>
                                <input type="button" id="reportBtnPurchase" value="Get Report" class="btn btn-primary" style="width:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <input type="button" value="Export Excel File" id="btnExportPurchase"  class="btn btn-default btn-sm pull-right" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table hover" style="table-layout: fixed" id="purchaseTable">
                        <thead>
                            <tr>
                                <th>ItemId</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Vendor</th>
                                <th>Weight</th>
                                <th>Rev Weight (Kg)</th>
                                <th>Quantity</th>
                                <th>Margin (%)</th>
                                <th>Unit Cost(Rs)</th>
                                <th>Unit Sale (Rs)</th>
                                <th>Remaining</th>
                                <th>Sold</th>
                                <th>Added On</th>
                                <th>Age (Days)</th>
                            </tr>
                        </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </section> 
</section>

<section id="wastageSection" style="display: none">
    <section>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <input type="button" value="Export Excel File" id="btnExportWastage"  class="btn btn-default btn-sm pull-right" style="margin-bottom: 10px;">
                </div>
                <div class="row">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table hover" style="table-layout: fixed" id="wastageTable">
                        <thead>
                            <tr>
                                <th>ItemId</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Vendor</th>
                                <th>Weight</th>
                                <th>Rev Weight (Kg)</th>
                                <th>Quantity</th>
                                <th>Wasted (Kg)</th>
                            </tr>
                        </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </section> 
</section>      











    <script type="text/javascript">
    	$().ready(function(){

            // inventory reports
            $.getJSON("getInventoryReport.php",function(data){
                    var _len = data.length, post, i;

                    if (_len>0) {
                    $("#inventoryTable tr:has(td)").remove();
                    var trHTML = '';
                    $.each(data, function (i, item) {


                    trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.itemName+'</td><td>'+item.weight+'</td><td>'+item.revisedWeight+'</td><td>'+item.count+'</td><td>'+item.margin+'</td><td>'+item.unitPrice+'</td><td>'+item.price+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOn+'</td><td>'+item.age+'</td></tr>';

                    });

                    $('#inventoryTable > tbody').html(trHTML);
                    }else{
                        //show not found bar
                        alert("No Data Found");
                        $("#inventoryTable tr:has(td)").remove();
                    }
            });

            // purchase report
            $("#reportBtnPurchase").click(function(){
                if ($("#startDatePurchase").val()=="" || $("#endDatePurchase").val()=="") {
                    alert("Please Select Date");
                }else{
                    $.getJSON("getPurchaseReport.php?start="+$("#startDatePurchase").val()+"&end="+$("#endDatePurchase").val(),function(data){
                            var _len = data.length, post, i;

                            if (_len>0) {
                            $("#purchaseTable tr:has(td)").remove();
                            var trHTML = '';
                            $.each(data, function (i, item) {

                            trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.itemName+'</td><td>'+item.weight+'</td><td>'+item.revisedWeight+'</td><td>'+item.count+'</td><td>'+item.margin+'</td><td>'+item.unitPrice+'</td><td>'+item.price+'</td><td>'+item.remaining+'</td><td>'+item.sold+'</td><td>'+item.addedOn+'</td><td>'+item.age+'</td></tr>';


                            });

                            $('#purchaseTable > tbody').html(trHTML);
                            }else{
                                //show not found bar
                                alert("No Data Found For This Item!");
                                $("#purchaseTable tr:has(td)").remove();
                            }
                    });
                        
                }

            });



            // wastage report
            $.getJSON("getWastageReport.php",function(data){
                    var _len = data.length, post, i;

                    if (_len>0) {
                    $("#wastageTable tr:has(td)").remove();
                    var trHTML = '';
                    $.each(data, function (i, item) {


                    trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.itemName+'</td><td>'+item.type+'</td><td>'+item.vendor+'</td><td>'+item.weight+'</td><td>'+item.revisedWeight+'</td><td>'+item.count+'</td><td>'+item.wastage+'</td></tr>';

                    });

                    $('#wastageTable > tbody').html(trHTML);
                    }else{
                        //show not found bar
                        alert("No Data Found");
                        $("#wastageTable tr:has(td)").remove();
                    }
            });



























            $("#logoutBtn").click(function(){
                window.location.href = "logoff.php";
            });

            $("input[name=ops]").change(function(){
                if ($("#transaction").is(":checked")) {
                    $("#transactionSection").css('display', 'block');
                    $("#inventorySection").css('display', 'none');
                    $("#purchaseSection").css('display', 'none');
                    $("#wastageSection").css('display', 'none');
                }else if($("#inventory").is(":checked")) {
                    $("#transactionSection").css('display', 'none');
                    $("#inventorySection").css('display', 'block');
                    $("#purchaseSection").css('display', 'none');
                    $("#wastageSection").css('display', 'none');
                }else if($("#purchase").is(":checked")) {
                    $("#transactionSection").css('display', 'none');
                    $("#inventorySection").css('display', 'none');
                    $("#purchaseSection").css('display', 'block');
                    $("#wastageSection").css('display', 'none');
                }else if($("#wastage").is(":checked")) {
                    $("#transactionSection").css('display', 'none');
                    $("#inventorySection").css('display', 'none');
                    $("#purchaseSection").css('display', 'none');
                    $("#wastageSection").css('display', 'block');
                }
            });


            $("#reportBtn").click(function(){
                if ($("#startDate").val()=="" || $("#endDate").val()=="") {
                    alert("Please Select Date");
                }else{
                    $.getJSON("getSoldReports.php?start="+$("#startDate").val()+"&end="+$("#endDate").val(),function(data){
                            var _len = data.length, post, i;

                            if (_len>0) {
                            $("#reportsTable tr:has(td)").remove();
                            var trHTML = '';
                            $.each(data, function (i, item) {

                                if (item.vendor == "self") {
                                    trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.name+'</td><td>'+item.count+'</td><td>'+item.weight+'</td><td>'+item.unitpricecost+'</td><td class="priceClass">'+item.price+'</td><td>'+item.discount+'</td><td class="profitClass">'+(parseInt(item.price)-parseInt(item.unitpricecost))+'</td><td>'+item.code+'</td><td>'+item.soldOn+'</td></tr>';
                                }else{
                                    trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.name+'</td><td>'+item.count+'</td><td>'+item.weight+'</td><td>'+item.unitpricecost*item.weight+'</td><td class="priceClass">'+item.price+'</td><td>'+item.discount+'</td><td class="profitClass">'+(parseInt(item.price)-parseInt(item.unitpricecost*item.weight))+'</td><td>'+item.code+'</td><td>'+item.soldOn+'</td></tr>';
                                }

                            // if (item.count=="0" && item.weight!="0") {

                            //     if (item.vendor=="self") {
                            //     trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.name+'</td><td>'+item.count+'</td><td>'+item.weight+'</td><td>'+item.unitpricecost+'</td><td class="priceClass">'+item.price+'</td><td>'+item.discount+'</td><td class="profitClass">'+(parseInt(item.price)-parseInt(item.unitpricecost)*parseInt(item.weight))+'</td><td>'+item.code+'</td><td>'+item.soldOn+'</td></tr>';
                            //     }else{
                            //     trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.name+'</td><td>'+item.count+'</td><td>'+item.weight+'</td><td>'+parseInt(item.unitpricecost)*parseInt(item.weight)+'</td><td class="priceClass">'+item.price+'</td><td>'+item.discount+'</td><td class="profitClass">'+(parseInt(item.price)-parseInt(item.unitpricecost)*parseInt(item.weight))+'</td><td>'+item.code+'</td><td>'+item.soldOn+'</td></tr>';
                            //     }
                            //     //multiple with weight

                            // }else{
                            //     // otherwise
                            //     trHTML+='<tr><td>'+item.itemId+'</td><td>'+item.name+'</td><td>'+item.count+'</td><td>'+item.weight+'</td><td>'+parseInt(item.costprice)+'</td><td class="priceClass">'+item.price+'</td><td>'+item.discount+'</td><td class="profitClass">'+parseInt(item.price-item.costprice)+'</td><td>'+item.code+'</td><td>'+item.soldOn+'</td></tr>';
                            // }


                            });

                            $('#reportsTable > tbody').html(trHTML);
                            }else{
                                //show not found bar
                                alert("No Data Found For This Item!");
                                $("#reportsTable tr:has(td)").remove();
                            }
                            var sum = 0; var sum2 =0;
                            $(".priceClass").each(function(){
                                sum += +$(this).text();
                            });
                            $(".profitClass").each(function(){
                                sum2 += +$(this).text();
                            });
                            $("#earned").text("You Earned "+sum+"(Rs) In This Interval! and profited of about "+sum2+"(Rs)");
                    });
                        
                }

            });

            $("#btnExport").click(function(){
                if ($("#reportsTable > tbody > tr").length == 0) {
                    alert("no rows");
                }else{
                    fnExcelReport();
                }
            });

            $("#btnExportInventory").click(function(){
                if ($("#inventoryTable > tbody > tr").length == 0) {
                    alert("no rows");
                }else{
                    fnExcelReportInventory();
                }
            });

            $("#btnExportPurchase").click(function(){
                if ($("#purchaseTable > tbody > tr").length == 0) {
                    alert("no rows");
                }else{
                    fnExcelReportPurchase();
                }
            });

            $("#btnExportWastage").click(function(){
                if ($("#wastageTable > tbody > tr").length == 0) {
                    alert("no rows");
                }else{
                    fnExcelReportWastage();
                }
            });

        });

        function fnExcelReport()
        {
            var tab_text="<table border='2px'><tr bgcolor='#B7D3F7'>";
            var textRange; var j=0;
            tab = document.getElementById('reportsTable'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Report.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
        }

        function fnExcelReportInventory()
        {
            var tab_text="<table border='2px'><tr bgcolor='#B7D3F7'>";
            var textRange; var j=0;
            tab = document.getElementById('inventoryTable'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Report.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
        }

        function fnExcelReportPurchase()
        {
            var tab_text="<table border='2px'><tr bgcolor='#B7D3F7'>";
            var textRange; var j=0;
            tab = document.getElementById('purchaseTable'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Report.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
        }

        function fnExcelReportWastage()
        {
            var tab_text="<table border='2px'><tr bgcolor='#B7D3F7'>";
            var textRange; var j=0;
            tab = document.getElementById('wastageTable'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Report.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
        }

    </script>

</body>
</html>