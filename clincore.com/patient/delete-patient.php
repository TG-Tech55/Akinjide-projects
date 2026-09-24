<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php

$patientId = trim($_POST['patient_Id']);

$checkPatientQuery = mysqli_query($conn, "SELECT * FROM patient_tab WHERE patient_id = '$patientId'") or die(mysqli_error($conn));
if (mysqli_num_rows($checkPatientQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE PATIENT NOT FOUND'
    ];
   Goto end;  
}

 mysqli_query($conn, "DELETE FROM patient_tab WHERE patient_id = '$patientId'") or die(mysqli_error($conn));

    $response = [
        'success' => true,
        'message' => 'PATIENT INFO DELETED SUCCESSFULLY'
    ];

 

end:
echo json_encode($response);

?>