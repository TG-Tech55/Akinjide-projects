<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php

$doctorId = trim($_POST['doctor_Id']);

$checkDoctorQuery = mysqli_query($conn, "SELECT * FROM doctor_tab WHERE doctor_id = '$doctorId'") or die(mysqli_error($conn));
if (mysqli_num_rows($checkDoctorQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE DOCTOR NOT FOUND'
    ];
   Goto end;  
}

 mysqli_query($conn, "DELETE FROM doctor_tab WHERE doctor_id = '$doctorId'") or die(mysqli_error($conn));

    $response = [
        'success' => true,
        'message' => 'DOCTOR INFO DELETED SUCCESSFULLY'
    ];

 

end:
echo json_encode($response);

?>