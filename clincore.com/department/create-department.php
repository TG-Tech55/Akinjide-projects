<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$name = trim($_POST['name']);
$describtion = trim($_POST['describtion']);
$statusId = trim($_POST['statusId']);


if ($name == '') {
    $response = [
        'success' => false,
        'message' => "DEPARTMENT NAME IS REQUIRED, Kindly fill in the department name to continue"
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

if ($statusId == '') {
    $response = [
        'success' => false,
        'message' => "STATUS ID IS REQUIRED, Kindly fill in the describtion to continue"
    ];
    goto end;
}


$Namecheck = mysqli_query($conn, "SELECT * FROM department_tab WHERE department_name = '$name'") or die(mysqli_error($conn));
if (mysqli_num_rows($Namecheck) > 0) {
    $response = [
        "success" => false,
        "message" => "DEPARTMENT ALREADY EXIST"
    ];
    goto end;
}

$departmentId = 'DEPARTMENT' . date("Ymdhis");


mysqli_query($conn, "INSERT INTO `department_tab`
    ( `department_id`, `department_name`, `describtion`, `status_id`, `created_at`, `updated_at`) VALUES
    ('$departmentId', '$name','$describtion', '$statusId', NOW(), NOW())") or die(mysqli_error($conn));

$createDepartmentQuery = mysqli_query($conn, "SELECT department_tab.*, status_tab.status_id FROM department_tab, status_tab WHERE department_tab.status_id = status_tab.status_id AND department_tab.department_name = '$name'") or die(mysqli_error($conn));
$departmentData = mysqli_fetch_assoc($createDepartmentQuery);

$response = [
    'success' => true,
    'message' => "DEPARTMENT CREATED SUCCESSFUL",

];

end:
echo json_encode($response);
?>