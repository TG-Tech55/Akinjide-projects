<?php require_once __DIR__ . '/../../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$staffId = trim($_POST['staffId']);

$checkUserQuery = mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id = '$staffId'") or die(mysqli_error($conn));

if ($staffId == '') {
    $response = [
        'success' => false,
        'message' => 'STAFF ID REQUIRED'
    ];
   goto end;  

}

if (mysqli_num_rows($checkUserQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE STAFF NOT FOUND'
    ];
   goto end;  

}


  $fetchEachUserQuery = mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id = '$staffId'") or die(mysqli_error($conn));
  
  while ($fetchdata = mysqli_fetch_assoc($fetchEachUserQuery)) {
    $response = [
    'success' => true,
    'mesagge' => "STAFF FETCH SUCCESSFULLY",
    'date' => $fetchdata
    
   ];
}

$getQuery = mysqli_query($conn, "SELECT staff_tab.*, status_tab.status_name FROM staff_tab, status_tab WHERE staff_tab.status_id = status_tab.status_id AND staff_tab.staff_id = '$staffId'") or die(mysqli_error($conn));
$staffData = mysqli_fetch_assoc($getQuery);


$response = [
    'success' => true,
    'message' => "LOGIN SUCCESSFUL",
    'data' => [
        'staffId' => $staffData['user_id'],
        'firstName' => $staffData['first_name'],
        'lastName' => $staffData['last_name'],
        'emailAddress' => $staffData['email_address'],
        'phoneNumber' => $staffData['phone'],
        'statusId' => $staffData['status_id'],
        'statusName' => $staffData['status_name'],
        'password' => $staffData['password'],
        'roleId' => $staffData['role_id'],
        'createdAt' => $staffData['created_at'],
        'updatedAt' => $staffData['updated_at']
    ]
];


end:
echo json_encode($response);
?>