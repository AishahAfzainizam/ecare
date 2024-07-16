<?php
	session_start();
	include('assets/inc/config.php');
    if(isset($_POST['add_patient'])) {
        $pat_fname = $_POST['pat_fname'];
        $pat_lname = $_POST['pat_lname'];
        $pat_number = $_POST['pat_number'];
        $pat_phone = $_POST['pat_phone'];
        $pat_type = $_POST['pat_type'];
        $pat_addr = $_POST['pat_addr'];
        $pat_age = $_POST['pat_age'];
        $pat_dob = $_POST['pat_dob'];
        $pat_ailment = $_POST['pat_ailment'];

        // Insert patient details into his_patients table
        $query = "INSERT INTO his_patients (pat_fname, pat_ailment, pat_lname, pat_age, pat_dob, pat_number, pat_phone, pat_type, pat_addr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('sssssssss', $pat_fname, $pat_ailment, $pat_lname, $pat_age, $pat_dob, $pat_number, $pat_phone, $pat_type, $pat_addr);
        $stmt->execute();

        if($stmt) {
            // Prepare variables for his_laboratory table
            $lab_pat_name = $pat_fname . ' ' . $pat_lname;
            
            // Insert into his_laboratory table
            $lab_query = "INSERT INTO his_laboratory (lab_pat_number, lab_pat_name, lab_pat_ailment) VALUES (?, ?, ?)";
            $lab_stmt = $mysqli->prepare($lab_query);
            $lab_stmt->bind_param('sss', $pat_number, $lab_pat_name, $pat_ailment);
            $lab_stmt->execute();

            // Prepare variables for his_medical_records table
            $mdr_pat_name = $pat_fname . ' ' . $pat_lname;
            
            // Insert into his_medical_records table
            $mdr_query = "INSERT INTO his_medical_records (mdr_pat_number, mdr_pat_name, mdr_pat_adr, mdr_pat_age, mdr_pat_ailment) VALUES (?, ?, ?, ?, ?)";
            $mdr_stmt = $mysqli->prepare($mdr_query);
            $mdr_stmt->bind_param('sssss', $pat_number, $mdr_pat_name, $pat_addr, $pat_age, $pat_ailment);
            $mdr_stmt->execute();

            // Check if both inserts were successful
            if($lab_stmt && $mdr_stmt) {
                $success = "Patient and related records added successfully";
            } else {
                $err = "Failed to add laboratory or medical records";
            }
        } else {
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
            <?php include("assets/inc/nav.php");?>
            <?php include("assets/inc/sidebar.php");?>

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
                                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">Add Patient</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Patient Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <?php 
                                                        $length = 5;    
                                                        $patient_number =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                    ?>
                                                    <label for="inputZip" class="col-form-label">Patient Number</label>
                                                    <input type="text" name="pat_number" value="<?php echo $patient_number;?>" class="form-control" id="inputZip">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputfname" class="col-form-label">First Name</label>
                                                    <input type="text" required="required" name="pat_fname" class="form-control" id="inputfirstname4" placeholder="Patient's First Name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputlname4" class="col-form-label">Last Name</label>
                                                    <input required="required" type="text" name="pat_lname" class="form-control"  id="inputlastname4" placeholder="Patient`s Last Name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputdob" class="col-form-label">Date Of Birth</label>
                                                    <input type="text" required="required" name="pat_dob" class="form-control" id="inputdate" placeholder="DD/MM/YYYY">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputage4" class="col-form-label">Age</label>
                                                    <input required="required" type="text" name="pat_age" class="form-control"  id="inputAge" placeholder="Patient`s Age">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Address</label>
                                                <input required="required" type="text" class="form-control" name="pat_addr" id="inputAddress" placeholder="Patient's Addresss">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="inputphone" class="col-form-label">Mobile Number</label>
                                                    <input required="required" type="text" name="pat_phone" class="form-control" id="inputhp" placeholder="Patient's Phone Number">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="inputailment" class="col-form-label">Patient Ailment</label>
                                                    <input required="required" type="text" name="pat_ailment" class="form-control" id="inputailment" placeholder="Type something here...">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="inputState" class="col-form-label">Patient's Type</label>
                                                    <select id="inputState" required="required" name="pat_type" class="form-control">
                                                        <option>Choose</option>
                                                        <option>InPatient</option>
                                                    </select>
                                                </div>
                                                
                                            </div>

                                            <button type="submit" name="add_patient" class="ladda-button btn btn-primary" data-style="expand-right">Add Patient</button>

                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
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