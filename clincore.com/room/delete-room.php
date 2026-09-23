<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php

$roomId = trim($_POST['room_Id']);

$checkRoomQuery = mysqli_query($conn, "SELECT * FROM room_tab WHERE room_id = '$roomId'") or die(mysqli_error($conn));
if (mysqli_num_rows($checkRoomQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE ROOM NOT FOUND'
    ];
   Goto end;  
}

 mysqli_query($conn, "DELETE FROM room_tab WHERE room_id = '$roomId'") or die(mysqli_error($conn));

    $response = [
        'success' => true,
        'message' => 'ROOM INFO DELETED SUCCESSFULLY'
    ];

 

end:
echo json_encode($response);

?>