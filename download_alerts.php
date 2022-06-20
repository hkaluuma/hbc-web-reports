<?php 
 
// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Fetch records from database 
$query = $db->query("SELECT check_up_id,patient_names,patient_temperature,cough,chills,new_chest_pain,headache,difficulty_breathing,fatigue,runny_nose,diarrhea,sore_throat,check_up_time,other_symptoms,alert_status,patient_fk,health_centre_fk,alert_type_fk,comment1,comment2,comment3 FROM check_up ORDER BY check_up_id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "alerts-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('CHECKUP_ID', 'PATIENT NAMES', 'TEMPERATURE', 'COUGH', 'CHILLS', 'NEW CHEST PAIN', 'HEADACHE', 'DIFFICULTY BREATHING', 'FATIGUE', 'RUNNY NOSE', 'DIARRHEA', 'SORE THROAT', 'CHECKUP TIME', 'OTHER SYMPTOMS', 'ALERT STATUS', 'PATIENT ID', 'HEALTH CENTER', 'ALERT TYPE', 'COMMENT1', 'COMMENT2', 'COMMENT3'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        //$status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['check_up_id'], $row['patient_names'], $row['patient_temperature'], $row['cough'], $row['chills'], $row['new_chest_pain'], $row['headache'], $row['difficulty_breathing'], $row['fatigue'], $row['runny_nose'], $row['diarrhea'], $row['sore_throat'], $row['check_up_time'], $row['other_symptoms'], $row['alert_status'], $row['patient_fk'], $row['health_centre_fk'], $row['alert_type_fk'], $row['comment1'], $row['comment2'], $row['comment3']); 
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