<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$departmentId = trim($_POST['departmentId']);

$checkDepartmentQuery = mysqli_query($conn, "SELECT * FROM department_tab WHERE department_id = '$departmentId'") or die(mysqli_error($conn));

if ($departmentId == '') {
    $response = [
        'success' => false,
        'message' => 'DEPARTMENT ID REQUIRED'
    ];
   goto end;  

}

if (mysqli_num_rows($checkDepartmentQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'DEPARTMENT NOT FOUND'
    ];
   goto end;  

}


  $fetchEachDepartmentQuery = mysqli_query($conn, "SELECT * FROM department_tab WHERE department_id = '$departmentId'") or die(mysqli_error($conn));
  
  while ($fetchdata = mysqli_fetch_assoc($fetchEachDepartmentQuery)) {
    $response = [
    'success' => true,
    'mesagge' => "DEPARTMENT FETCH SUCCESSFULLY",
    'date' => $fetchdata
    
   ];
}

$createdepartmentQuery = mysqli_query($conn, "SELECT department_tab.*, department_tab.department_name, department_tab.describtion FROM doctor_tab WHERE department_tab.department_id = department_tab.department_id AND department_tab.department_name = '$Name'") or die(mysqli_error($conn));
$departmentData = mysqli_fetch_assoc($createdepartmentQuery);

$response = [
    'success' => true,
    'message' => "DEPARTMENT CREATED SUCCESSFUL",
    'data' => [
        'departmentId' => $departmentData['department_id'],
        'Name' => $departmentData['department_name'],
        'describtion' => $departmentData['describtion'],
        'createdAt' => $departmentData['created_at'],
        'updatedAt' => $departmentData['updated_at']
    ]
];

end:
echo json_encode($response);
?>