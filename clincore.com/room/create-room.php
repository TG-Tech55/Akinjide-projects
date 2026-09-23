<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$Name = trim($_POST['Name']);
$capacity = trim($_POST['capacity']);
$statusId = 'A';




if ($Name == '') {
    $response = [
        'success' => false,
        'message' => "ROOM NAME IS REQUIRED, Kindly fill in the room name to continue"
    ];
    goto end;
}

if ($capacity == '') {
    $response = [
        'success' => false,
        'message' => "CAPACITY IS REQUIRED, Kindly fill in the capacity to continue"
    ];
    goto end;
}



$Namecheck = mysqli_query($conn, "SELECT * FROM room_tab WHERE room_name = '$Name'") or die(mysqli_error($conn));
if (mysqli_num_rows($Namecheck) > 0) {
    $response = [
        "success" => false,
        "message" => "ROOM ALREADY EXIST"
    ];
    goto end;
}

$roomId = 'ROOM' . date("Ymdhis");


mysqli_query($conn, "INSERT INTO `doctor_tab`
    ( `room_id`, `room_name`, `capacity`, `created_at`, `updated_at`) VALUES
    ('$roomId', '$Name','$capacity', NOW(), NOW())") or die(mysqli_error($conn));

$createRoomQuery = mysqli_query($conn, "SELECT room_tab.*, status_tab.status_name FROM doctor_tab, status_tab WHERE room_tab.status_id = status_tab.status_id AND room_tab.room_name = '$Name'") or die(mysqli_error($conn));
$roomData = mysqli_fetch_assoc($createRoomQuery);

$response = [
    'success' => true,
    'message' => "ROOM CREATED SUCCESSFUL",
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