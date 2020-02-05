<?php
    session_start();
    
    include 'db_connect.php';
    if(isset($_POST['submit'])){

        $email= mysqli_real_escape_string($con, $_POST['login_email']);
        $password= mysqli_real_escape_string($con, $_POST['login_password']);


        //admin view
        // if ($email == "admin@bcp" && $password=="abc@123") {
        //         //$_SESSION['adminIDFromSession']="admin";
        //         //header("location:vxt_view.php");
        // }

        //check for retailers
        $query= mysqli_query($con,"SELECT retailerId from users where email='$email' and password='$password'");
          if (mysqli_num_rows($query)>0) {
                      //making an array
                $rows=array();
                //filling that array
                while($row=mysqli_fetch_assoc($query))
                {
                    //$_SESSION['retailerIDFromSession']=$row['userId'];
                    //header("location:retailer_view.php");
                    echo "<script>alert('".$row['userId']."');</script>";        
                }
          }else{
            echo "<script>alert('No Data Found!');</script>";
          }
    }
    
    // if($_SESSION['adminIDFromSession']=="admin")
    // {
    //     header("location:vxt_view.php");
    // }
    // else if($_SESSION['retailerIDFromSession']!="")
    // {
    //     header("location:retailer_view.php");
    // }

?>

<!DOCTYPE html>
<html>
<head>
	<title>POS | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">

    <script src="js/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">

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
    </style>

</head>


<body style="overflow-x: hidden">


    <section id="homeSection" style="">


                <div class="outer">
                  <div class="middle">
                    <div class="inner center-block">

                      <form id="signInForm"  method="post" style="display:block">
                <section>
                    <div class="row" id="loginWrapper">
                        <div class="container" id="loginContainer">
                            <div class="row" id="loginBox">
                                <!-- login container -->
                                <div style="width: 300px;height: auto;margin:0px auto;border-radius: 10px;border-color: #b7d3f7; background-color:#b7d3f7;  border-width: 2px; border-style: solid;box-shadow: 10px 10px 5px #e6e6e6;">
                                <!-- email -->
                                <div style="padding:15px ">
                                    <input class="form-control" type="text" name="login_email" id="login_email" placeholder="Email">
                                </div>
                                <!-- password -->
                                <div style="padding:0px 15px 15px 15px">
                                    <input class="form-control" type="password" name="login_password" placeholder="Password">
                                </div>
                                <!-- submit -->
                                <div style="padding:0px 15px 15px 15px">
                                    <input type="submit" name="submit" value="Log In" class="btn btn-success" style="width: 100%">
                                </div>
                                <!-- forgot -->
                                <div style="padding:0px 15px 0px 15px; margin-bottom: 10px;">
                                    <p style="margin:0px;text-align: center;"><a style="text-decoration: none; color:black; cursor:pointer"  id="forgot_email">Forgot Password?</a></p>
                                </div>  
                                <!-- some text -->
                                <div style="padding:0px 15px 15px 15px">
                                    <p style="text-align: center; font-size: small;">By signing in to our application you agree to abide by the <a target="_blank" href="tnc.html" style="color:black;cursor:pointer "><i>Terms & Conditions</i></b></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>  
            </form>

                    </div>
                  </div>
                </div>




            <form id="signInForm"  method="post" style="display:none">
                <section>
                    <div class="row" id="loginWrapper">
                        <div class="container" id="loginContainer">
                            <div class="row" id="loginBox">
                                <!-- login container -->
                                <div style="width: 300px;height: auto;margin:0px auto;border-radius: 10px;border-color: #b7d3f7; background-color:#b7d3f7;  border-width: 2px; border-style: solid;box-shadow: 10px 10px 5px #e6e6e6;">
                                <!-- email -->
                                <div style="padding:15px ">
                                    <input class="form-control" type="text" name="login_email" id="login_email" placeholder="Email">
                                </div>
                                <!-- password -->
                                <div style="padding:0px 15px 15px 15px">
                                    <input class="form-control" type="password" name="login_password" placeholder="Password">
                                </div>
                                <!-- submit -->
                                <div style="padding:0px 15px 15px 15px">
                                    <input type="submit" name="submit" value="Log In" class="btn btn-success" style="width: 100%">
                                </div>
                                <!-- forgot -->
                                <div style="padding:0px 15px 0px 15px; margin-bottom: 10px;">
                                    <p style="margin:0px;text-align: center;"><a style="text-decoration: none; color:black; cursor:pointer"  id="forgot_email">Forgot Password?</a></p>
                                </div>  
                                <!-- some text -->
                                <div style="padding:0px 15px 15px 15px">
                                    <p style="text-align: center; font-size: small;">By signing in to our application you agree to abide by the <a target="_blank" href="tnc.html" style="color:black;cursor:pointer "><i>Terms & Conditions</i></a> presided by <br><b><a href="http://vxt.com" target="_blank" style="text-decoration: none; color:black; cursor:pointer">Vectracom Pvt Ltd</a>.</b></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>  
            </form>
    </section>

    <script type="text/javascript">
    	$().ready(function(){





        });
    </script>

</body>
</html>