<?php require_once __DIR__ . '/../../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLUserQuery = mysqli_query($conn, "SELECT * FROM staff_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLUserQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'STAFF NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLUserQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "STAFF FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo json_encode($response);
?>