<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$Name = trim($_POST['Name']);
$describtion = trim($_POST['describtion']);

if ($Name == '') {
    $response = [
        'success' => false,
        'message' => "FULL NAME NAME IS REQUIRED, Kindly fill in the full name to continue"
    ];
    goto end;
}

if ($describtion == '') {
    $response = [
        'success' => false,
        'message' => "describtion IS REQUIRED, Kindly fill in the describtion to continue"
    ];
    goto end;
}


$Namecheck = mysqli_query($conn, "SELECT * FROM department_tab WHERE department_name = '$Name'") or die(mysqli_error($conn));
if (mysqli_num_rows($Namecheck) > 0) {
    $response = [
        "success" => false,
        "message" => "DEPARTMENT ALREADY EXIST"
    ];
    goto end;
}

$departmentId = 'DEPARTMENT' . date("Ymdhis");


mysqli_query($conn, "INSERT INTO `doctor_tab`
    ( `department_id`, `department_name`, `describtion`, `created_at`, `updated_at`) VALUES
    ('$departmentId', '$Name','$describtion', NOW(), NOW())") or die(mysqli_error($conn));

$createDepartmentQuery = mysqli_query($conn, "SELECT department_tab.*, department_tab.department_name, department_tab.describtion FROM doctor_tab WHERE department_tab.department_id = department_tab.department_id AND department_tab.department_name = '$Name'") or die(mysqli_error($conn));
$departmentData = mysqli_fetch_assoc($createDepartmentQuery);

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