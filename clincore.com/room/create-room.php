<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$name = trim($_POST['name']);
$capacity = trim($_POST['capacity']);
$statusId = trim($_POST['statusId']);




if ($name == '') {
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

if ($statusId == '') {
    $response = [
        'success' => false,
        'message' => "STATUS ID IS REQUIRED, Kindly fill in the describtion to continue"
    ];
    goto end;
}



$namecheck = mysqli_query($conn, "SELECT * FROM room_tab WHERE room_name = '$name'") or die(mysqli_error($conn));
if (mysqli_num_rows($namecheck) > 0) {
    $response = [
        "success" => false,
        "message" => "ROOM ALREADY EXIST"
    ];
    goto end;
}

$roomId = 'ROOM' . date("Ymdhis");


mysqli_query($conn, "INSERT INTO `room_tab`
    ( `room_id`, `room_name`, `capacity`,`status_id`, `created_at`, `updated_at`) VALUES
    ('$roomId', '$name','$capacity','$statusId', NOW(), NOW())") or die(mysqli_error($conn));

$createRoomQuery = mysqli_query($conn, "SELECT room_tab.*, status_tab.status_name FROM room_tab, status_tab WHERE room_tab.status_id = status_tab.status_id AND room_tab.room_id = '$roomId'") or die(mysqli_error($conn));
$roomData = mysqli_fetch_assoc($createRoomQuery);

$response = [
    'success' => true,
    'message' => "ROOM CREATED SUCCESSFUL",
    
];

end:
echo json_encode($response);
?>