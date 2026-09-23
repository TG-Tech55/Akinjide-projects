<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 

$roomId = trim($_POST['roomId']);

$checkRoomQuery = mysqli_query($conn, "SELECT * FROM room_tab WHERE room_id = '$roomId'") or die(mysqli_error($conn));

if ($roomId == '') {
    $response = [
        'success' => false,
        'message' => 'ROOM ID REQUIRED'
    ];
    goto end;
}

if (mysqli_num_rows($checkRoomQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'ROOM NOT FOUND'
    ];
    goto end;
}


$fetchEachRoomQuery = mysqli_query($conn, "SELECT * FROM room_tab WHERE room_id = '$roomId'") or die(mysqli_error($conn));

while ($fetchdata = mysqli_fetch_assoc($fetchEachRoomQuery)) {
    $response = [
        'success' => true,
        'mesagge' => "ROOM FETCH SUCCESSFULLY",
        'date' => $fetchdata

    ];
}

$fetchEachRoomQuery = mysqli_query($conn, "SELECT room_tab.*, status_tab.status_name FROM room_tab, status_tab WHERE room_tab.status_id = status_tab.status_id AND room_tab.room_id = '$roomId'") or die(mysqli_error($conn));
$roomData = mysqli_fetch_assoc($fetchEachRoomQuery);

$response = [
    'success' => true,
    'message' => "ROOM FETCH SUCCESSFUL",
    'data' => [
        'roomId' => $roomData['room_id'],
        'Name' => $roomData['room_name'],
        'capacity' => $roomData['capacity'],
        'statusId' => $roomData['status_id'],
        'statusName' => $roomData['status_name'],
        'createdAt' => $roomData['created_at'],
        'updatedAt' => $roomData['updated_at']
    ]
];
end:
echo json_encode($response);
?>