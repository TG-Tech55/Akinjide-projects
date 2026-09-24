<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$doctorId = trim($_POST['doctorId']);

$checkDoctorQuery = mysqli_query($conn, "SELECT * FROM doctor_tab WHERE doctor_id = '$doctorId'") or die(mysqli_error($conn));

if ($doctorId == '') {
    $response = [
        'success' => false,
        'message' => 'DOCTOR ID REQUIRED'
    ];
   goto end;  

}

if (mysqli_num_rows($checkDoctorQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'DOCTOR NOT FOUND'
    ];
   goto end;  

}


  $fetchEachDoctorQuery = mysqli_query($conn, "SELECT * FROM doctor_tab WHERE doctor_id = '$doctorId'") or die(mysqli_error($conn));
  
  while ($fetchdata = mysqli_fetch_assoc($fetchEachDoctorQuery)) {
    $response = [
    'success' => true,
    'mesagge' => "DOCTOR FETCH SUCCESSFULLY",
    'date' => $fetchdata
    
   ];
}

$fetchEachDoctorQuery = mysqli_query($conn, "SELECT doctor_tab.*, status_tab.status_name FROM doctor_tab, status_tab WHERE doctor_tab.status_id = status_tab.status_id AND doctor_tab.doctor_id = '$doctorId'") or die(mysqli_error($conn));
$doctorData = mysqli_fetch_assoc($fetchEachDoctorQuery);

$response = [
    'success' => true,
    'message' => "DOCTOR FETCH SUCCESSFUL",
    'data' => [
        'doctorId' => $doctorData['doctor_id'],
        'firstName' => $doctorData['first_name'],
        'lastName' => $doctorData['last_name'],
        'emailAddress' => $doctorData['email_address'],
        'phoneNumber' => $doctorData['phone'],
        'statusId' => $doctorData['status_id'],
        'statusName' => $doctorData['status_name'],
        'password' => $doctorData['password'],
        'createdAt' => $doctorData['created_at'],
        'updatedAt' => $doctorData['updated_at']
    ]
];
end:
echo json_encode($response);
?>