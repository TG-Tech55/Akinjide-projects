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


$searchDepartmentQuery = mysqli_query($conn, "SELECT department_tab.*, status_tab.status_name FROM department_tab, status_tab WHERE department_tab.status_id = status_tab.status_id AND (department_tab.patient_name LIKE '%$searchContent%' OR department_tab.describtion LIKE '%$searchContent%'  OR department_tab.department_id LIKE '%$searchContent%')") or die(mysqli_error($conn));

if (mysqli_num_rows($searchDepartmentQuery) == 0) {
    $response = [
        'success' => false,
        'message' => "NO DEPARTMENT FOUND"
    ];
    goto end;
}

$fetchData = mysqli_fetch_all($searchDepartmentQuery, MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => "DEPARTMENT SEARCH SUCCESFULLY",
    'data' => $fetchData
];

end:
echo json_encode($response);
?>