<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLPatientQuery = mysqli_query($conn, "SELECT * FROM patient_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLPatientQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'PATIENT NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLPatientQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "PATIENT FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo  json_encode($response);
?>