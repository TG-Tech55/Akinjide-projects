<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
//DECLERATION OF VARIABLE 
$fetchALLDepartmentQuery = mysqli_query($conn, "SELECT * FROM department_tab") or die(mysqli_error($conn));

if (mysqli_num_rows($fetchALLDepartmentQuery) == 0) {
  $response = [
    'success' => false,
    'message' => 'DEPARTMENT NOT FOUND'
  ];
  goto end;
}

while ($fetchdata = mysqli_fetch_all($fetchALLDepartmentQuery, MYSQLI_ASSOC)) {
  $response = [
    'success' => true,
    'mesagge' => "DEPARTMENT FETCH SUCCESSFULLY",
    'date' => $fetchdata

  ];
}

end:
echo  json_encode($response);
?>