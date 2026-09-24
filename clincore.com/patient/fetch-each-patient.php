<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$patientId = trim($_POST['patientId']);

$checkPatientQuery = mysqli_query($conn, "SELECT * FROM patient_tab WHERE patient_id = '$patientId'") or die(mysqli_error($conn));

if ($patientId == '') {
    $response = [
        'success' => false,
        'message' => 'PATIENT ID REQUIRED'
    ];
   goto end;  

}

if (mysqli_num_rows($checkPatientQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'PATIENT NOT FOUND'
    ];
   goto end;  

}


  $fetchEachPatientQuery = mysqli_query($conn, "SELECT * FROM patient_tab WHERE patient_id = '$patientId'") or die(mysqli_error($conn));
  
  while ($fetchdata = mysqli_fetch_assoc($fetchEachPatientQuery)) {
    $response = [
    'success' => true,
    'mesagge' => "PATIENT FETCH SUCCESSFULLY",
    'date' => $fetchdata
    
   ];
}

$createPatientQuery = mysqli_query($conn, "SELECT patient_tab.*, room_tab.room_name, status_tab.status_name FROM patient_tab, room_tab, status_tab WHERE patient_tab.room_id = room_tab.room_id AND patient_tab.status_id = status_tab.status_id AND patient_tab.patient_id = '$patientId'") or die(mysqli_error($conn));
$patientData = mysqli_fetch_assoc($createPatientQuery);

$response = [
    'success' => true,
    'message' => "STAFF CREATED SUCCESSFUL",
    'data' => [
        'patientId' => $patientData['patient_id'],
        'name' => $patientData['name'],
        'emailAddress' => $patientData['email_address'],
        'phone' => $patientData['phone'],
        'address' => $patientData['address'],
        'statusId' => $patientData['status_id'],
        'statusName' => $patientData['status_name'],
        'password' => $patientData['password'],
        'treatment' => $patientData['treatment'],
        'doctorId' => $patientData['doctor_id'],
        'rooId' => $patientData['room_id'],
        'roomName' => $patientData['room_name'],
        'createdAt' => $patientData['created_at'],
        'updatedAt' => $patientData['updated_at']
    ]
];

end:
echo json_encode($response);
?>