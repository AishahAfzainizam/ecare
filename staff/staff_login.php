<?php
    session_start();
    include('assets/inc/config.php');//get configuration file
    if(isset($_POST['doc_login']))
    {
        $doc_number = $_POST['doc_number'];
        $doc_pwd = sha1(md5($_POST['doc_pwd']));//double encrypt to increase security
        $stmt=$mysqli->prepare("SELECT doc_number, doc_pwd, doc_id FROM his_docs WHERE  doc_number=? AND doc_pwd=? ");//sql to log in user
        $stmt->bind_param('ss', $doc_number, $doc_pwd);//bind fetched parameters
        $stmt->execute();//execute bind
        $stmt -> bind_result($doc_number, $doc_pwd ,$doc_id);//bind result
        $rs=$stmt->fetch();
        $_SESSION['doc_id'] = $doc_id;
        $_SESSION['doc_number'] = $doc_number;//Assign session to doc_number id

        if($rs)
            {//if its sucessfull
                header("location:dashboard.php");
            }

        else
            {
                $err = "Access Denied Please Check Your Credentials";
            }
    }
?>
<!--End Login-->
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title>eCare Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="MartDevelopers" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!--Load Sweet Alert Javascript-->
        
        <script src="assets/js/swal.js"></script>
        <!--Inject SWAL-->
        <?php if(isset($success)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success","<?php echo $success;?>","success");
                            },
                                100);
                </script>

        <?php } ?>

        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed","<?php echo $err;?>","error");
                            },
                                100);
                </script>

        <?php } ?>



    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="staff_login.php">
                                        <span><img src="assets/images/logo_dark.png" alt="" height="50"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Enter your staff number and password to access staff panel.</p>
                                </div>

                                <form method='post' >

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Staff Number</label>
                                        <input class="form-control" name="doc_number" type="text" id="doctornumber" required="" placeholder="Enter your Staff number">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" name="doc_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-success btn-block" name="doc_login" type="submit"> Log In </button>
                                    </div>

                                </form>

                               

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                       

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <?php include ("assets/inc/footer1.php");?>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>