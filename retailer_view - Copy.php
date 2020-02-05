<?php
session_start();

include 'db_connect.php';
    
    if (isset($_SESSION['retailerIDFromSession'])) {
        if ($_SESSION['retailerIDFromSession']==null) {
         header("location:login.php");
        }else {
            //echo $_SESSION['retailerIDFromSession'];
        }
    }else{
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Retailer</title>
    <link rel="icon" href="assets/120.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">

    <script src="js/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">


   <!--  <script src="http://malsup.github.com/jquery.form.js"></script>  -->

    <script src="js/form.js" type="text/javascript"></script>

    <script>

    //function to redeem a coupon;
    function redeemCoupon(key_val){
        var ret_id_sess_red = <?php echo $_SESSION['retailerIDFromSession'];?>;
                $.ajax({
                    type: "get",
        url: "redeem_coupon.php?u_key="+key_val+"&retailerId="+ret_id_sess_red,
                    data: {
                    },
                    success: function (response){
                        alert(response.responseText);
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                });
                return false;
    }

    function deleteCoupon(id){
                $.ajax({
                    type: "get",
                    url: "deletecoupon.php?id="+id,
                    data: {
                    },
                    success: function (response){
                        alert("Successfully Deleted!");
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                });
                return false;
    }

    function deleteCampaignCoupon(id){
        $.ajax({
                    type: "get",
                    url: "deletecampaigncoupon.php?id="+id,
                    data: {
                    },
                    success: function (response){
                        alert("Successfully Deleted!");
                        var btn_id='btn_'+id;
                        //alert(btn_id);
                        document.getElementById(btn_id).setAttribute("disabled","disabled");
                        document.getElementById(btn_id).href="../website/retailer_view.php#view";
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                });
                return false;
    }

    function notifyUser(campaignCode){
        $.ajax({
                    type: "get",
                    url: "notify_users_spc.php?code="+campaignCode,
                    data: {
                    },
                    success: function (response){
                        alert("Notifications Sent");
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                });
                return false;
    }

    function deleteCampaign(id){
        $.ajax({
                    type: "get",
                    url: "deletecampaign.php?id="+id,
                    data: {
                    },
                    success: function (response){
                        //alert(response.responseText);
                        //var btn_id='btn_'+id;
                        //alert(btn_id);
                        //document.getElementById(btn_id).setAttribute("disabled","disabled");
                        //document.getElementById(btn_id).href="../website/retailer_view.php#view";
                        //location.reload(true);

                        


                    // setTimeout(function(){
                    //     //$('#dashboard_campaign_select option:last').prop('selected',true);
                    //     $('#view_all_campaigns').click();
                    // },2);


                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                }).done(function(data,textStatus,jqXHR){
                    alert(data);
                    $('#view_all_campaigns').click();
                });

                return false;
    }

    $().ready(function(){

        //select the tab based on #
        $('#myTab a[href="' + hash + '"]').tab('show');

        var ret_id_sess = <?php echo $_SESSION['retailerIDFromSession'];?>;

        $('#newCampaignSearchBtn').click(function(){
                //alert("asd");
            var city = $("input[name=city]:checked").val();
            var gender = $("input[name=gender]:checked").val();
            var spending_range = $("#spending_range").val();
            var redemption_range = $("#redemption_range").val();

            $.getJSON("getTotalCustomers.php?city="+city+"&gender="+gender+"&spending_range="+spending_range+"&redemption_range="+redemption_range


                //city="+city+"&gender="+gender+"&spending_range="+spending_range+"&redemption_range"=redemption_range+""
                , 
                function(data){

                var _len = data.length;


                $('#newCampaignSearchResult').text("Search Results: "+_len+" Customer(s) Found!");
                $('#newCampaignSearchContainer').css('display', 'block');

             });
        });


        //changing the niggers accordingly
        $('#cPerc').change(function(){
            var price = -(($('#cPrice').val() * ($('#cPerc').val()/100)) - ($('#cPrice').val()));
            $('#cdPrice').val(price);
        });

        $('#log_out_retailer').click(function(){
            window.location.href="logoff.php";
        });

        $('#campaign_type_select_new_tab').on('change',function(){
            var selected_value = $('#campaign_type_select_new_tab').val();
            //alert(selected_value);
            if (selected_value=="general") {
                //search_container_new_tab
                $('#search_container_new_tab').css('display','none');
                $('#newTabSelectCustomersCB').prop('checked',false);
                $('#newTabSelectCustomersCB').prop('disabled',true);
            }else{
                $('#search_container_new_tab').css('display','block');
                $('#newTabSelectCustomersCB').prop('checked',true);
                $('#newTabSelectCustomersCB').prop('disabled',true);
            }
        });

        
        //populating the campaign select in dashboard
        $.getJSON("showRetailer.php?id="+ret_id_sess,function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {
                    $('#profile_image').attr('src', item.logo);
                    $('#pro_id').val(item.retailerId);
                    $('#pro_name').val(item.name);
                    $('#pro_mob').val(item.mobile);
                    $('#pro_land').val(item.landline);
                    $('#pro_address').val(item.address);
                    $('#pro_city').val(item.city);
                    $('#pro_ppn').val(item.personName);
                    $('#pro_email').val(item.email);
                    $('#pro_pass').val(item.password);
                    $('#profile_location').val(item.logo);
                     
                });
                }else{
                    //show not found bar
                    alert("No Data Found For Retailer Profile!");
                }
        });


        //populating the profile stuff
        $.getJSON("allcampaigns.php?retailerId="+ret_id_sess, function(data){
                var _len = data.length, post, i;
                
                if (_len>0) {
                var trHTML = '';
                trHTML='<option selected disabled>Select Campaign</option>';
                $.each(data, function (i, item) {
                        trHTML += '<option value="'+item.campaignId+'">'+item.name+'</option>';
                });
                $('#dashboard_campaign_select').append(trHTML);


                $('#dashboard_campaign_select option:last').prop('selected',true);

                    setTimeout(function(){
                        //$('#dashboard_campaign_select option:last').prop('selected',true);
                        $('#dashboard_campaign_search_btn').click();
                    },2);

                }else{
                    //show not found bar
                    var trHTML = '';
                    trHTML='<option selected disabled>Select Campaign</option>';
                    $('#dashboard_campaign_select').append(trHTML);
                    //alert("No Data Found For Retailer Profile!");
                }
        });


        //show added coupons in the campaign
        $('#myModal3').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal

            $("#added_coupons_modal_table tr:has(td)").remove();

            $.getJSON("getcouponsincampaign.php?campaignId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                var trHTML = '';
                $.each(data, function (i, item) {
                        trHTML += '<tr id="'+item.couponId+'"><td>' + item.couponId + '</td><td><a href="'+'#myModal22'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.couponId+'"  title="View this coupon" style="text-decoration:none; color:#333;cursor:pointer">' + item.discountTitle + '</a></td><td>' + item.category + '</td><td>' + item.discountPerc + '</td><td>' + item.dateAdded.substring(0,10) + '</td><td><a href="javascript:deleteCampaignCoupon('+item.couponId+');" id=btn_'+item.couponId+' style="text-decoration:none;cursor:pointer;color:#333;" class="btn btn-default btn-xs" title="Remove this coupon from current campaign">Remove</a></td></tr>';
                });
                $('#added_coupons_modal_table').append(trHTML);

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });

        //redeemed coupons in campaign
        $('#myModal10').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal

            $("#redeemed_coupons_modal_table tr:has(td)").remove();

            $.getJSON("getredeemedcouponsincampaign.php?campaignId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                var trHTML = '';
                $.each(data, function (i, item) {
                        trHTML += '<tr><td>' + item.couponId + '</td><td><a href="'+'#myModal22'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.couponId+'"  title="View this coupon" style="text-decoration:none; color:#333;cursor:pointer">' + item.title + '</a></td><td>' + item.category + '</td><td>' + item.redeemedDateTime + '</td><td>' + item.user + '</td><td>' + item.u_key + '</td></tr>';
                });
                $('#redeemed_coupons_modal_table').append(trHTML);

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });


        //View Coupon Information Stuff tempCoupon
        $('#myModal2').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
            $.getJSON("editcoupon.php?couponId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                    $.each(data, function (i, item) {
                        console.log(item.headerImg);
                        //fill all the stuff
                        $('#coupon_info_modal_title').text(item.title);
                        $('#coupon_info_modal_img').attr("src",item.image);
                        $('#coupon_info_modal_desc').text(item.c_desc);
                    });

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });

        //coupon from coupons_table
        $('#myModal22').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
            $.getJSON("editcouponfromcoupons.php?couponId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                    $.each(data, function (i, item) {
                        console.log(item.headerImg);
                        //fill all the stuff
                        $('#coupon_info_modal_title_coupons').text(item.discountTitle);
                        $('#coupon_info_modal_img_coupons').attr("src",item.headerImg);
                        $('#coupon_info_modal_desc_coupons').text(item.discountDesc);
                    });

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });


        //EditCouponModal Stuff
        $('#myModal6').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
            $.getJSON("editcoupon.php?couponId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                    $.each(data, function (i, item) {
                        console.log(item.headerImg);
                        //fill all the stuff
                        $('#edit_modal_id').val(item.tempCouponId);
                        $('#edit_modal_img').attr("src",item.image);
                        $('#edit_modal_title').val(item.title);
                        $('#edit_modal_category').val(item.category);
                        $('#edit_modal_desc').val(item.c_desc);
                        $('#edit_modal_perc').val(item.perc);
                        $('#edit_modal_price').val(item.price);
                        $('#edit_modal_disc_price').val(item.disc_price);
                        $('#edit_modal_location').val(item.image);
                    });

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });

        //add coupon modal
        $('#myModal').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button

            var retid= $('#retailer_id_saved_coupons_modal').val();

            $('#campaign_id_saved_coupons_modal').val(id);
            
            //populate modal with entries from tempTable
            $("#saved_coupons_table tr:has(td)").remove();

            $.getJSON("allcoupons.php?retailerId="+retid, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {
                        trHTML += '<tr><td><input id="added" class="restrict_checked" type="checkbox" name="checkboxs[]" value="' + item.tempCouponId + '"></td><td>' + item.tempCouponId + '</td><td><a href="'+'#myModal2'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.tempCouponId+'"  title="View this coupon" style="text-decoration:none; color:#333;cursor:pointer">' + item.title + '</a></td><td>' + item.category + '</td><td>' + item.perc + '</td><td>' + item.added + '</td></tr>';
                });
                $('#saved_coupons_table').append(trHTML);
                }else{
                    //show not found bar
                    alert("No Data Found!");
                }

            });
   
        });

        
                //add coupon modal
        $('#myModal4').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button

            $('#edit_campaign_modal_campaignId').val(id);
            
            

            $.getJSON("getcampaigninfo.php?campaignId="+id, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                
                    $.each(data, function (i, item) {
                    $('#edit_campaign_modal_title').val(item.name);
                    $('#edit_campaign_modal_count').val(item.count_c);
                    //$('#edit_campaign_modal_category').val(item.category);
                    $('#edit_campaign_modal_start').val(item.start_date);
                    $('#edit_campaign_modal_end').val(item.end_date);
                });

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }

            });
        });

                        //add coupon modal
        $('#myModal25').on('show.bs.modal', function (e) { //Modal Event
            var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
            $('#unique_id_price_modal').val(id);
        });

        $('#redeem_coupon_modal_btn').click(function(){
            var key_val = $('#unique_id_price_modal').val();
            var price = $('#product_price_text').val();

            var ret_id_sess_red = <?php echo $_SESSION['retailerIDFromSession'];?>;
                $.ajax({
                    type: "get",
        url: "redeem_coupon.php?u_key="+key_val+"&retailerId="+ret_id_sess_red+"&price="+price 
        ,
                    data: {
                    },
                    success: function (response){
                        alert("Successful");
                        location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert("Unsuccessful");
                    }
                });
                return false;    
        });


        $('#createCampaignForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                // $('#upload_image_coupon_btn').prop('value','<i class="fa fa-spinner"></i>');
            },
            success:function(){
                // $('#upload_image_coupon_btn').prop('value','upload');

            },
            complete:function(response){
                // $('#uploaded_coupon_loc_text').val(response.responseText);

                if ($.isNumeric(response.responseText)) {
                alert("Campaign Successfully Created");
                var btnHtml='<input type="button" value="Add Coupons" class="btn btn-primary" style="background-color:color:#169ce2;" style="width: 150px; margin:0px auto;" href="#myModal" id="openBtn" data-id="'+response.responseText+'" data-toggle="modal" data-backdrop="static" data-keyboard="false"> ';
                $('#addCouponContainer').append(btnHtml);
                $('#add_coupon_new_campaign_container').css('display','block'); 
                }else{
                    alert("There was a network error; Please try again");
                    location.reload();
                }


            }
        });

        //handle the couponImageUpload here
        $('#updateRetailerForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                // $('#upload_image_coupon_btn').prop('value','<i class="fa fa-spinner"></i>');
            },
            success:function(){
                // $('#upload_image_coupon_btn').prop('value','upload');

            },
            complete:function(response){
                // $('#uploaded_coupon_loc_text').val(response.responseText);
                alert(response.responseText);
            }
        });
            
        $('#uploadProfileImgForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                // $('#upload_image_coupon_btn').prop('value','<i class="fa fa-spinner"></i>');
            },
            success:function(){
                // $('#upload_image_coupon_btn').prop('value','upload');

            },
            complete:function(response){
                // $('#uploaded_coupon_loc_text').val(response.responseText);

                //path
                $('#profile_location').val(response.responseText);

                //setting image
                $('#profile_image').attr("src",response.responseText);
            }
        }); 
        
        $('#updateCouponImgForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                // $('#upload_image_coupon_btn').prop('value','<i class="fa fa-spinner"></i>');
            },
            success:function(){
                // $('#upload_image_coupon_btn').prop('value','upload');

            },
            complete:function(response){
                // $('#uploaded_coupon_loc_text').val(response.responseText);

                //path
                $('#edit_modal_location').val(response.responseText);

                //setting image
                $('#edit_modal_img').attr("src",response.responseText);
            }
        });
        
        $('#uploadCouponImgForm').ajaxForm({
            beforeSend:function(){
                
                $('#spinner').css('display','block');

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                // $('#upload_image_coupon_btn').prop('value','<i class="fa fa-spinner"></i>');
            },
            success:function(){
                // $('#upload_image_coupon_btn').prop('value','upload');

            },
            complete:function(response){
                // $('#uploaded_coupon_loc_text').val(response.responseText);

                //path
                $('#img_loc').val(response.responseText);

                //setting image
                $('#image_placeholder_coupon').attr("src",response.responseText);
                
                
                
                if($('#img_loc').val().match("^uploads")){
                    $('#spinner').css('display','none');
                }else{
                    alert("Image size was larger. Please use some other image.");
                }
            }
        });
    
        $('#updateCouponForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                
            },
            success:function(){
                
            },
            complete:function(response){
                alert(response.responseText);
            }
        });

        $('#updateCampaignForm').ajaxForm({
            beforeSend:function(){
                

            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                
            },
            success:function(){
                
            },
            complete:function(response){
                //alert(response.responseText);
                location.reload();
            }
        });

        $('#cTitle').on('input',function(e){
            if (  $('#cTitle').val().indexOf('\'')>=0 ) {

                    $("#cTitle").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        $('#cDesc').on('input',function(e){
            if (  $('#cDesc').val().indexOf('\'')>=0 ) {

                    $("#cDesc").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        $('#edit_modal_title').on('input',function(e){
            if (  $('#edit_modal_title').val().indexOf('\'')>=0 ) {

                    $("#edit_modal_title").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        $('#edit_modal_desc').on('input',function(e){
            if (  $('#edit_modal_desc').val().indexOf('\'')>=0 ) {

                    $("#edit_modal_desc").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        $('#edit_campaign_modal_title').on('input',function(e){
            if (  $('#edit_campaign_modal_title').val().indexOf('\'')>=0 ) {

                    $("#edit_campaign_modal_title").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        $('#campaign_name_new').on('input',function(e){
            if (  $('#campaign_name_new').val().indexOf('\'')>=0 ) {

                    $("#campaign_name_new").val(function(i, v) { //index, current value
                        return v.replace('\'','');
                    });
            }
        });

        // $('#uploadCouponForm').submit(function(){

        //     if (  $('#cTitle').val().indexOf('\'')>=0 || $('#cDesc').val().indexOf('\'')>=0) {
        //             alert("You cannot use ('s) in this field");
        //             return false;
        //     }else{

        //              $(this).ajaxForm();
        //              alert("Success");
        //     }

        //     return false;
        // });

        // $('#uploadCouponForm').on('submit',function(e){
        //     e.preventDefault();

        //     if (  $('#cTitle').val().indexOf('\'')>=0 || $('#cDesc').val().indexOf('\'')>=0) {
        //             alert("You cannot use ('s) in this field");
        //             return false;
        //     }

        //     $(this).off("submit");

        //     this.submit();

        //     return false;


        // });



        $('#uploadCouponForm').ajaxForm({
            beforeSend:function(){

                $('#spinnerUploadCoupon').css('display','block');
            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                
            },
            success:function(){
                
            },
            complete:function(response){
                $('#spinnerUploadCoupon').css('display','none');
                alert(response.responseText);
            }
        });

        $('#addCouponForm').ajaxForm({
            beforeSend:function(){
                
            },
            uploadProgress:function(event,position,total,percentComplete)
            {
                
            },
            success:function(){
                
            },
            complete:function(response){
                alert(response.responseText);
                //window.location.reload();

                if (response.responseText.trim()=="Done"){
                    window.location.reload();
                }
                
            }
        });

        // $('#dashboard_campaign_search_btn').trigger('click');











































        //dashboard_campaign_search_btn
        $('#dashboard_campaign_search_btn').click(function(){
            //alert($('#redeem_text').val());
            var campaignId=$('#dashboard_campaign_select').val();

            //change the data url here for getting dashboard data
            $.getJSON("getcampaigndashboard.php?campaignId="+campaignId, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {
                    $('#dashboard_container').css('display','block');
                    $('#dashboard_status').text(item.status);
                    $('#dashboard_issued').text(item.issued);
                    $('#dashboard_redeemed').text(item.redeemed);

                    if((item.issued-item.redeemed)<0){
                        $('#dashboard_remaining').text("Error");
                    }else{
                        $('#dashboard_remaining').text(item.issued-item.redeemed);
                    }

                    
                    
                    $('#dashboard_expiry').text(item.end_date);
                    $('#dashboard_perday').text(item.perday);

                    if(item.spent==null){
                        $('#dashboard_spent').text("0");
                    }else{
                        $('#dashboard_spent').text(item.spent);
                    }

                    
                });
                }else{
                    //show not found bar
                    alert("No Data Found!");
                    $('#dashboard_container').css('display','none');
                }

            });
        });


















        


        //handle the search click in redeem coupons tab;
        $('#search_redeem').click(function(){
            //alert($('#redeem_text').val());
            var key=$('#redeem_text').val();
            $("#redeem_results_table tr:has(td)").remove();

            $.getJSON("getInfo.php?u_key="+key, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {
                    if (item.iscouponvalid==0 || item.isRedeemed==1) {
                        trHTML += '<tr><td>' + item.retailername + '</td><td>' + item.campaignname + '</td><td>' + item.campaignvalidity + '</td><td>' + item.couponid + '</td><td>' + item.username + '</td><td>' + item.reservedDateTime + '</td><td>' + item.iscouponvalid + '</td><td>' + item.u_key + 
                        '</td><td><input type="button" class="btn btn-default btn-xs" value="Redeem" disabled></td></tr>';
                    }else{
                        // trHTML += '<tr><td>' + item.retailername + '</td><td>' + item.campaignname + '</td><td>' + item.campaignvalidity + '</td><td>' + item.couponid + '</td><td>' + item.username + '</td><td>' + item.reservedDateTime + '</td><td>' + item.iscouponvalid + '</td><td>' + item.u_key + 
                        // '</td><td><a href="'+'javascript:redeemCoupon('+key+');'+'" class="btn btn-default btn-xs">Redeem</a></td></tr>';

                     trHTML += '<tr><td>' + item.retailername + '</td><td>' + item.campaignname + '</td><td>' + item.campaignvalidity + '</td><td>' + item.couponid + '</td><td>' + item.username + '</td><td>' + item.reservedDateTime + '</td><td>' + item.iscouponvalid + '</td><td>' + item.u_key + 
                         '</td><td><a href="'+'#myModal25'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.u_key+'" style="color:#333; text-decoration:none;cursor:pointer" title="Redeem Coupon">Redeem</a></td></tr>';
                    }
                });
                    $('#redeem_results_table').append(trHTML);
                }else{
                    //show not found bar
                    alert("No Data Found! \n\nAre you sure that the campaign associated with this coupon is not expired?");
                }

            });
        });

        //handle the show all coupons button
        $('#view_all_coupons').click(function(){
            
            $("#spinnerViewAllCoupon").css('display','block');

            $("#show_all_coupons_table tr:has(td)").remove();

            $.getJSON("allcoupons.php?retailerId="+ret_id_sess, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {
                    
            trHTML += '<tr><td>' + item.tempCouponId + '</td><td><a href="'+'#myModal2'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.tempCouponId+'"  title="View this coupon" style="text-decoration:none; color:#333;cursor:pointer">' + item.title + '</a></td><td>' + item.c_desc + '</td><td>' + item.perc + '</td><td>' + item.category + '</td><td>' + item.added + 
            '</td><td><a href="'+'#myModal6'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.tempCouponId+'" class="btn btn-default btn-xs " title="Edit this coupon">Edit</a>&nbsp;<a href="'+'javascript:deleteCoupon('+item.tempCouponId+');'+'" class="btn btn-default btn-xs"  title="Delete this coupon" onclick="return confirmation(this); return false;">Remove</a></td></tr>';
                    
                });
                    $('#show_all_coupons_table').append(trHTML);

                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
            $("#spinnerViewAllCoupon").css('display','none');
        });

        //handle the show all coupons button
        $('#view_all_campaigns').click(function(){
            

            $("#view_all_campaigns_table tr:has(td)").remove();

            $.getJSON("allcampaigns.php?retailerId="+ret_id_sess, function(data){
                var _len = data.length, post, i;
 
                if (_len>0) {
                var trHTML = '';
                $.each(data, function (i, item) {

                    if (item.noti=="0" && item.issuedCoupons!="0" && item.main_type!="general") {
                        //not notified

            if (item.couponsInCampaign=="0") {
                //show modal in a
                trHTML += '<tr><td>' + item.campaignId + '</td><td><a style="text-decoration:none; color:#ff0000" href="'+'#myModal'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'"  title="Add Coupon" style="text-decoration:none; cursor:pointer">' + item.name + '</a></td><td>' + item.main_type + '</td><td>' + item.start_date.substring(0,10) + '</td><td>' + item.end_date.substring(0,10) + '</td><td>' + item.added.substring(0,10) + 
                '</td><td><a href="'+'#myModal3'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View all the issued coupons in this campaign. If you added coupons and there are no coupons here it means they are still subjected to moderation.">' + item.issuedCoupons + 
                '</a></td><td><a href="'+'#myModal10'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View redeemed coupons in this campaign">' + item.redeemedCoupons + 
                '</a></td><td>' + item.status + 
                '</td><td><a href="'+'javascript:notifyUser('+item.campaignId+')'+'"    class="btn btn-success btn-xs " title="Send puch Notifications to selected customers">Notify Users</a></td><td><a href="'+'#myModal4'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" class="btn btn-default btn-xs " title="Edit this campaign">Edit</a>&nbsp;<a href="'+'javascript:deleteCampaign('+item.campaignId+')'+'"  class="btn btn-default btn-xs " title="Remove this campaign">Remove</a></td></tr>';
            }else{
                //dont show modal in a
                trHTML += '<tr><td>' + item.campaignId + '</td><td><a style="text-decoration:none; color:#333">' + item.name + '</a></td><td>' + item.main_type + '</td><td>' + item.start_date.substring(0,10) + '</td><td>' + item.end_date.substring(0,10) + '</td><td>' + item.added.substring(0,10) + 
                '</td><td><a href="'+'#myModal3'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View all the issued coupons in this campaign. If you added coupons and there are no coupons here it means they are still subjected to moderation.">' + item.issuedCoupons + 
                '</a></td><td><a href="'+'#myModal10'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View redeemed coupons in this campaign">' + item.redeemedCoupons + 
                '</a></td><td>' + item.status + 
                '</td><td><a href="'+'javascript:notifyUser('+item.campaignId+')'+'"    class="btn btn-success btn-xs " title="Send puch Notifications to selected customers">Notify Users</a></td><td><a href="'+'#myModal4'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" class="btn btn-default btn-xs " title="Edit this campaign">Edit</a>&nbsp;<a href="'+'javascript:deleteCampaign('+item.campaignId+')'+'"  class="btn btn-default btn-xs " title="Remove this campaign">Remove</a></td></tr>';
            }

            }else{
                if (item.couponsInCampaign=="0") {
                    //show modal in a
                trHTML += '<tr><td>' + item.campaignId + '</td><td><a style="text-decoration:none; color:#ff0000" href="'+'#myModal'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'"  title="Add Coupon" style="text-decoration:none; cursor:pointer">' + item.name + '</a></td><td>' + item.main_type + '</td><td>' + item.start_date.substring(0,10) + '</td><td>' + item.end_date.substring(0,10) + '</td><td>' + item.added.substring(0,10) + 
                '</td><td><a href="'+'#myModal3'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View all the issued coupons in this campaign. If you added coupons and there are no coupons here it means they are still subjected to moderation.">' + item.issuedCoupons + 
                '</a></td><td><a href="'+'#myModal10'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View redeemed coupons in this campaign">' + item.redeemedCoupons + 
                '</a></td><td>' + item.status + 
                '</td><td><a disabled class="btn btn-default btn-xs " title="Either the users are already notified or the coupons in this campaign are still in moderation">Notified</a></td><td><a href="'+'#myModal4'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" class="btn btn-default btn-xs " title="Edit this campaign">Edit</a>&nbsp;<a href="'+'javascript:deleteCampaign('+item.campaignId+')'+'"  class="btn btn-default btn-xs " title="Remove this campaign">Remove</a></td></tr>';
                }else{
                    //dont show modal in a
                trHTML += '<tr><td>' + item.campaignId + '</td><td><a style="text-decoration:none; color:#333;">' + item.name + '</a></td><td>' + item.main_type + '</td><td>' + item.start_date.substring(0,10) + '</td><td>' + item.end_date.substring(0,10) + '</td><td>' + item.added.substring(0,10) + 
                '</td><td><a href="'+'#myModal3'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View all the issued coupons in this campaign. If you added coupons and there are no coupons here it means they are still subjected to moderation.">' + item.issuedCoupons + 
                '</a></td><td><a href="'+'#myModal10'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" style="color:#333; text-decoration:none;cursor:pointer" title="View redeemed coupons in this campaign">' + item.redeemedCoupons + 
                '</a></td><td>' + item.status + 
                '</td><td><a disabled class="btn btn-default btn-xs " title="Either the users are already notified or the coupons in this campaign are still in moderation">Notified</a></td><td><a href="'+'#myModal4'+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-id="'+item.campaignId+'" class="btn btn-default btn-xs " title="Edit this campaign">Edit</a>&nbsp;<a href="'+'javascript:deleteCampaign('+item.campaignId+')'+'"  class="btn btn-default btn-xs " title="Remove this campaign">Remove</a></td></tr>';
                }

            }
                    
                });
                    $('#view_all_campaigns_table').append(trHTML);
                }else{
                    //show not found bar
                    alert("No Data Found!");
                }
            });
        });

    });

    </script>

    <!-- <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script> -->

    <style type="text/css" media="screen">
        body{
            background-color: #e8f2ff;
            overflow-x: hidden;
            height: 100%;
            padding: 0px;
            margin: 0px;
        }
        #headerContainer{
            height: 80px;
            width: 100%;
            background-color: #169ce2;
            margin: 0px auto;
            text-align: center;
        }
        .space{
            height: 10px;
        }
        .paddingBottom{
            padding-bottom: 10px;
        }
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
            color: #333;
            background-color: #e8f2ff;
        }
        a{
            color: #333;
        }
    </style>
</head>

    <?php
        $dataPointsCity = array(
            array("y" => 48, "name" => "Islamabad"),
            array("y" => 30, "name" => "Lahore"),
            array("y" => 15, "name" => "Karachi"),
            array("y" => 2, "name" => "Others")
        );

        $dataPointsGender = array(
            array("y" => 52, "name" => "Male"),
            array("y" => 48, "name" => "Female")
        );
    ?> 

<body>
    <!-- header -->
    <section>
        <div class="row">
            <div class="container" id="headerContainer">
                <h1 style="color:whitesmoke;font-size: 40px; padding:0px;"><b>SHOPEY</b>!</h1>
            </div>
        </div>
    </section>
    <!-- header -->

    <!-- tabbed categories -->
    <section>
        <!-- centered pills -->
        <div class="row" style="background-color: #b7d3f7;padding:5px">
            <div class="row" style="margin-left: 20px;margin-right: 20px;">
                <!-- pills header -->
                <div class="row" style="margin:0px auto">
                    <ul class="nav nav-pills nav-justified" id="myTab">
                    
                        <li class="active"><a data-toggle="pill" href="#dashboard">Dashboard</a></li>
                        <li ><a data-toggle="pill" href="#redeem">Redeem Coupons</a></li>
                        
                        <li><a data-toggle="pill" href="#upload">Upload Coupons</a></li>
                        <li><a data-toggle="pill" href="#new">Campaigns (New)</a></li>
                        <li><a data-toggle="pill" href="#view">Campaigns (View)</a></li>
                        <li><a data-toggle="pill" href="#profile">Profile</a></li>
                        <li><a data-toggle="pill" href="#logout">Logout</a></li>
                    </ul>

                    <script type="text/javascript">
                                //selecting them tabs
                        $('#myTab a').click(function(e) {
                          e.preventDefault();
                          $(this).tab('show');
                          window.scrollTo(0,0);
                        });

                        // store the currently selected tab in the hash value
                        $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
                          var id = $(e.target).attr("href").substr(1);
                          window.location.hash = id;
                          window.scrollTo(0,0);
                        });

                        // on load of the page: switch to the currently selected tab
                        var hash = window.location.hash;
                        $( "#myTab" ).tabs( "option", "active", '2' );

                        $('#myTab a[href="' + hash + '"]').tab('show');
                        $('a[href="' + hash + '"]').click();
                    </script>
                </div>
            </div>
        </div>
    </section>

    <!-- tab Description -->
    <section>
        <div class="row" >
            <div class="container" >
                <!-- pills content -->
                <div class="tab-content">

                    <!-- dashboard tab -->
                    <?php include "dashboard_tab.php";?>

                    <!-- redeem tab -->
                    <?php include "redeem_tab.php";?>    
                        
                    <!-- upload tab -->
                    <?php include "upload_tab.php";?> 
                        
                    <!-- new tab -->
                    <?php include "new_tab.php";?>
                        
                    <!-- view tab -->
                    <?php include "view_tab.php";?>
                        
                    <!-- profile tab -->
                    <?php include "profile_tab.php";?>
                        
                    <!-- logout tab -->
                    <?php include "logout_tab.php";?>
                    
                </div>
            </div>
        </div>
    </section>


<!-- edit coupon modal -->
<?php include "edit_coupon_modal.php";?>

<!-- edit coupon modal -->
<?php include "deletion_modal.php";?>

<!-- edit campaign modal -->
<?php include "edit_campaign_modal.php";?>

<!-- Show added coupons Modal -->
<?php include "added_coupons_modal.php";?>

<!-- Show redeemed coupons Modal -->
<?php include "show_redeemed_coupons_modal.php";?>

<!-- add coupons Modal -->
<?php include "add_coupons_modal.php";?>

<!-- add coupons Modal -->
<?php include "product_price_modal.php";?>

<!-- add coupons Modal -->
<?php include "coupon_description_modal.php";?>

<!-- coupon information via coupons table -->
<?php include "coupon_description_coupons_table_modal.php";?>


</body>
</html>
