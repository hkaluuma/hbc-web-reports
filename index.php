<!-- Export link -->
<!-- Bootstrap library -->
<!-- <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css"> -->
<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">

<!-- Stylesheet file -->
<!--<link rel="stylesheet" href="assets/css/style.css"> -->
<!-- done linking the bootstrap -->

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <div class="col-md-12 head">
            <tr>
                <td>
                    <div class="float-right">
                    <a href="download_patients.php" class="btn btn-success"><i class="dwn"></i> Download Patients</a>
                    </div>
                </td>
                    <td><div class="float-right">
                    <a href="download_alerts.php" class="btn btn-success"><i class="dwn"></i> Download Alerts</a>
                    </div>
                </td>
                <td>
                    <div class="float-right">
                    <a href=" " class="btn btn-success"><i class="dwn"></i> Other Downloads</a>
                    </div>
                </td>
                    <td><div class="float-right">
                    <a href=" " class="btn btn-success"><i class="dwn"></i> Other Downloads</a>
                    </div>
                </td> 
            </tr>
        </div>
</thead>
</table>

</div
<p class="text-center">Patients in summary below:</p>
</div>

<!-- Data list table --> 
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>HBC APP ID</th>
            <th>Patient Names</th>
            <th>Test Status</th>
            <th>Phone Number</th>
            <th>Age</th>
            <th>Gender</th>
            <th>District</th>
        </tr>
    </thead>
    <tbody>
   <?php 
    // Fetch records from database
   include_once 'dbConfig.php'; 
    $result = $db->query("SELECT patient_id,p_fullnames,p_test_status,p_phonenumber,p_age,gender,p_location FROM patient ORDER BY patient_id ASC"); 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){ 
    ?>
        <tr>
            <td><?php echo $row['patient_id']; ?></td>
            <td><?php echo $row['p_fullnames']; ?></td>
            <td><?php echo $row['p_test_status']; ?></td>
            <td><?php echo $row['p_phonenumber']; ?></td>
            <td><?php echo $row['p_age']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['p_location']; ?></td>
        </tr>
    <?php } }else{ ?>
        <tr><td colspan="7">No Patient(s) found...</td></tr>
    <?php } ?>
    </tbody>
</table>