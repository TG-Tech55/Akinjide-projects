<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLRoomQuery = mysqli_query($conn, "SELECT * FROM room_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLRoomQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'ROOM NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLRoomQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "ROOM FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo  json_encode($response);
?>