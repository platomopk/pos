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
	<title>Awesome POS | Choice</title>
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

        .choices{
            background-color: #b7d3f7; font-size: large; color:#333;padding-top:15px;padding-bottom: 15px;font-weight: 1;margin:10px;
        }

        a:hover{
            text-decoration: none;
        }

        .choices:hover{
            color: #fff;
            background-color: #333;
        }

    </style>

</head>


<body style="overflow-x: hidden">


    <section id="homeSection" style="">


                <div class="outer">
                  <div class="middle">
                    <div class="inner center-block">

                        <div class="row">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <a href="/pos/inventory.php">
                                                    <div class="choices">
                                                        INVENTORY 
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="/pos/pos.php">
                                                    <div class="choices">
                                                        POINT OF SALE 
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="/pos/reports.php">
                                                    <div class="choices">
                                                        REPORTS 
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                  </div>
                </div>

    </section>

    <script type="text/javascript">
    	$().ready(function(){





        });
    </script>

</body>
</html>