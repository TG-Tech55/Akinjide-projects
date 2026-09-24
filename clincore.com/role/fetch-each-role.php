<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$roleId = trim($_POST['roleId']);

$checkRoleQuery = mysqli_query($conn, "SELECT * FROM role_tab WHERE role_id = '$roleId'") or die(mysqli_error($conn));

if ($roleId == '') {
    $response = [
        'success' => false,
        'message' => 'ROLE ID REQUIRED'
    ];
    goto end;
}

if (mysqli_num_rows($checkRoleQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'Role NOT FOUND'
    ];
    goto end;
}


$fetchEachRoleQuery = mysqli_query($conn, "SELECT * FROM role_tab WHERE role_id = '$roleId'") or die(mysqli_error($conn));

while ($fetchdata = mysqli_fetch_assoc($fetchEachRoleQuery)) {
    $response = [
        'success' => true,
        'mesagge' => "ROLE FETCH SUCCESSFULLY",
        'date' => $fetchdata

    ];
}

$fetchEachRoleQuery = mysqli_query($conn, "SELECT role_tab * FROM role_tab WHERE role_tab.role_id = '$roleId'") or die(mysqli_error($conn));
$roleData = mysqli_fetch_assoc($fetchEachRoleQuery);

$response = [
    'success' => true,
    'message' => "ROLE FETCH SUCCESSFUL",
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