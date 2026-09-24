<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLRoleQuery = mysqli_query($conn, "SELECT * FROM role_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLRoleQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'ROLE NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLRoleQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "ROLE FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo  json_encode($response);
?>