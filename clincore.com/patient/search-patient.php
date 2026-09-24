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


$searchPatientQuery = mysqli_query($conn, "SELECT patient_tab.*, status_tab.status_name FROM patient_tab, status_tab WHERE patient_tab.status_id = status_tab.status_id AND (patient_tab.patient_name LIKE '%$searchContent%' OR patient_tab.phone LIKE '%$searchContent%' OR patient_tab.email_address LIKE '%$searchContent%' OR patient_tab.patient_id LIKE '%$searchContent%')") or die(mysqli_error($conn));

if (mysqli_num_rows($searchPatientQuery) == 0) {
    $response = [
        'success' => false,
        'message' => "NO PATIENT FOUND"
    ];
    goto end;
}

$fetchData = mysqli_fetch_all($searchPatientQuery, MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => "PATIENT SEARCH SUCCESFULLY",
    'data' => $fetchData
];

end:
echo json_encode($response);
?>