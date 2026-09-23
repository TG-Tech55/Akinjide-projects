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


$searchRoomQuery = mysqli_query($conn, "SELECT room_tab.*, status_tab.status_name FROM room_tab, status_tab WHERE room_tab.status_id = status_tab.status_id AND (room_tab.name LIKE '%$searchContent%' OR room_tab.room_id LIKE '%$searchContent%')") or die(mysqli_error($conn));

if (mysqli_num_rows($searchRoomQuery) == 0) {
    $response = [
        'success' => false,
        'message' => "NO ROOM FOUND"
    ];
    goto end;
}

$fetchData = mysqli_fetch_all($searchRoomQuery, MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => "ROOM SEARCH SUCCESFULLY",
    'data' => $fetchData
];

end:
echo json_encode($response);
?>