
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_vendor']))
		{
			$v_name=$_POST['v_name'];
			$v_adr=$_POST['v_adr'];
			$v_number=$_GET['v_number'];
            $v_email=$_POST['v_email'];
            $v_phone = $_POST['v_phone'];
            $v_desc = $_POST['v_desc'];
            
            //sql to insert captured values
			$query="UPDATE  his_vendor SET v_name=?, v_adr=?,  v_email = ?, v_phone=?, v_desc=? WHERE v_number=?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssss', $v_name, $v_adr,  $v_email, $v_phone, $v_desc, $v_number);
			$stmt->execute();
			
			if($stmt)
			{
				$success = "Vendor Details Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!DOCTYPE html>
<html lang="en">
    
    <!--Head-->
    <?php include('assets/inc/head.php');?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ===content-->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor</a></li>
                                            <li class="breadcrumb-item active">Update Vendor</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Vendor Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <?php
                            $v_number=$_GET['v_number'];
                            $ret="SELECT  * FROM his_vendor WHERE v_number = ?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('s',$v_number);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            while($row=$res->fetch_object())
                            {
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Vendor Number : #<?php echo $row->v_number;?></h4>
                                       
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="inputName" class="col-form-label">Vendor Name</label>
                                                    <input type="text" required="required" value="<?php echo $row->v_name;?>" name="v_name" class="form-control" id="inputName" >
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="inputPhoneno" class="col-form-label">Vendor Phone Number</label>
                                                    <input required="required" type="text" value="<?php echo $row->v_phone;?>" name="v_phone" class="form-control"  id="inputPhoneno">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="inputAddress" class="col-form-label">Vendor Address</label>
                                                    <input required="required" value="<?php echo $row->v_adr;?>" type="text" name="v_adr" class="form-control"  id="inputAddress">
                                                </div>
                                            

                                            
                                            <div class="form-group col-md-8">
                                                <label for="inputEmail1" class="col-form-label">Vendor Email</label>
                                                <input required="required" value="<?php echo $row->v_email;?>"type="email" class="form-control" name="v_email" id="inputEmail1">
                                            </div>
                                        </div>

                                            <div class="form-group">
                                                <label for="inputDetail" class="col-form-label">Vendor Details</label>
                                                <textarea class="form-control" name="v_desc" id="editor" rows="5"><?php echo $row->v_desc;?></textarea>
                                            </div>

                                            <button type="submit" name="update_vendor" class="ladda-button btn btn-success" data-style="expand-right">Update Vendor</button>

                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                            <?php }?>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>


        </div>
        <!-- END wrapper -->

       
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>