<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLARATION OF VARIABLE
$searchContent = trim($_POST['searchContent'] ?? '');

if ($searchContent == '') {
    $response = [
        'success' => false,
        'message' => "SEARCH CONTENT IS REQUIRED, Kindly fill in the search content to continue"
    ];
    goto end;
}


$searchRoleQuery = mysqli_query($conn, "SELECT role_tab *  FROM role_tab WHERE (role_tab.role_name LIKE '%$searchContent%' OR role_tab.role_id LIKE '%$searchContent%')") or die(mysqli_error($conn));

if (mysqli_num_rows($searchRoleQuery) == 0) {
    $response = [
        'success' => false,
        'message' => "NO ROLE FOUND"
    ];
    goto end;
}

$fetchData = mysqli_fetch_all($searchRoleQuery, MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => "ROLE SEARCH SUCCESFULLY",
    'data' => $fetchData
];

end:
echo json_encode($response);
?>