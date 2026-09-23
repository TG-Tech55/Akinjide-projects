<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php

$departmentId = trim($_POST['department_Id']);

$checkDepartmentQuery = mysqli_query($conn, "SELECT * FROM department_tab WHERE department_id = '$departmentId'") or die(mysqli_error($conn));
if (mysqli_num_rows($checkDepartmentQuery) == 0) {
    $response = [
        'success' => false,
        'message' => 'THE DEPARTMENT NOT FOUND'
    ];
   Goto end;  
}

 mysqli_query($conn, "DELETE FROM department_tab WHERE department_id = '$departmentId'") or die(mysqli_error($conn));

    $response = [
        'success' => true,
        'message' => 'DEPARTMENT INFO DELETED SUCCESSFULLY'
    ];

 

end:
echo json_encode($response);

?>