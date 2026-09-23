<?php require_once __DIR__ . '/../../config/connection.php'; ?>

<?php

$staffId = trim($_POST['staffId']);

$checkUserQuery = mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id = '$staffId'") or die(mysqli_error($conn));
if (mysqli_num_rows($checkUserQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE STAFF NOT FOUND'
    ];
   Goto end;  
}

 mysqli_query($conn, "DELETE FROM staff_tab WHERE staff_id = '$staffId'") or die(mysqli_error($conn));

    $response = [
        'success' => true,
        'message' => 'STAFF INFO DELETED SUCCESSFULLY'
    ];

 

end:
echo json_encode($response);

?>