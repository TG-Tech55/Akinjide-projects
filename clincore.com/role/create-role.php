<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$name = trim($_POST['name']);



if ($name == '') {
    $response = [
        'success' => false,
        'message' => "ROLE NAME IS REQUIRED, Kindly fill in the role name to continue"
    ];
    goto end;
}



$namecheck = mysqli_query($conn, "SELECT * FROM role_tab WHERE role_name = '$name'") or die(mysqli_error($conn));
if (mysqli_num_rows($namecheck) > 0) {
    $response = [
        "success" => false,
        "message" => "ROLE ALREADY EXIST"
    ];
    goto end;
}

$roleId = 'ROLE' . date("Ymdhis");


mysqli_query($conn, "INSERT INTO `role_tab`
    ( `role_id`, `role_name`, `created_at`, `updated_at`) VALUES
    ('$roleId', '$name', NOW(), NOW())") or die(mysqli_error($conn));

$createRoleQuery = mysqli_query($conn, "SELECT role_tab.* FROM role_tab WHERE role_tab.role_name = '$name'") or die(mysqli_error($conn));
$roleData = mysqli_fetch_assoc($createRoleQuery);

$response = [
    'success' => true,
    'message' => "ROLE CREATED SUCCESSFUL",
    'data' => [
        'roleId' => $roleData['role_id'],
        'name' => $roleData['role_name'],
        'createdAt' => $roleData['created_at'],
        'updatedAt' => $roleData['updated_at']
    ]
];

end:
echo json_encode($response);
?>