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


$searchDoctorQuery = mysqli_query($conn, "SELECT doctor_tab.*, status_tab.status_name FROM doctor_tab, status_tab WHERE doctor_tab.status_id = status_tab.status_id AND (doctor_tab.name LIKE '%$searchContent%' OR doctor_tab.phone LIKE '%$searchContent%' OR doctor_tab.email_address LIKE '%$searchContent%' OR doctor_tab.doctor_id LIKE '%$searchContent%')") or die(mysqli_error($conn));

if (mysqli_num_rows($searchDoctorQuery) == 0) {
    $response = [
        'success' => false,
        'message' => "NO DOCTOR FOUND"
    ];
    goto end;
}

$fetchData = mysqli_fetch_all($searchDoctorQuery, MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => "DOCTOR SEARCH SUCCESFULLY",
    'data' => $fetchData
];

end:
echo json_encode($response);
?>