<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLDoctorQuery = mysqli_query($conn, "SELECT * FROM doctor_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLDoctorQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'DOCTOR NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLDoctorQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "DOCTOR FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo  json_encode($response);
?>