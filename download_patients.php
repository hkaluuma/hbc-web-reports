<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Fetch records from database 
$query = $db->query("SELECT patient_id,p_fullnames,p_test_status,p_phonenumber,p_age,gender,p_location,patient_subcounty,patient_parish,patient_village, vht_fk,health_centre_fk,cfl_surveillance_time,     cfl_psychosocial_time, p_healthcenter_id FROM patient ORDER BY patient_id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "patients-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('HBC APP ID', 'PATIENT NAMES', 'TEST STATUS', 'PHONENUMBER', 'AGE', 'GENDER', 'DISTRICT', 'SUBCOUNTY', 'PARISH', 'VILLAGE', 'VHT ID', 'HEALTH FACILITY', 'CFL SURVEILLANCE TIME', 'CFL PSYCHOSOCIAL TIME','PATIENT ID'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['patient_id'], $row['p_fullnames'], $row['p_test_status'], $row['p_phonenumber'], $row['p_age'], $row['gender'], $row['p_location'], $row['patient_subcounty'], $row['patient_parish'], $row['patient_village'], $row['vht_fk'], $row['health_centre_fk'], $row['cfl_surveillance_time'], $row['cfl_psychosocial_time'], $row['p_healthcenter_id']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>