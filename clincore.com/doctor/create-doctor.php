<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$Name = trim($_POST['Name']);
$emailAddress = trim($_POST['emailAddress']);
$phone = trim($_POST['phone']);
$password = $_POST['password'];
$specialist = trim($_POST['specialist']);
$departmentId = trim($_POST['department_Id']);
$statusId = 'A';




if ($Name == '') {
    $response = [
        'success' => false,
        'message' => "FULL NAME IS REQUIRED, Kindly fill in the full name to continue"
    ];
    goto end;
}

if ($emailAddress == '') {
    $response = [
        'success' => false,
        'message' => "EMAIL ADDRESS NAME IS REQUIRED, Kindly fill in the email address to continue"
    ];
    goto end;
}

if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
    $response = [
        'response' => 102,
        'success' => false,
        'message' => "INVALID EMAIL ADDRESS! Enter a valid email address and try again",
    ];
    goto end;
}

if ($phone == '') {
    $response = [
        'success' => false,
        'message' => "PHONE NUMBER IS REQUIRED, Kindly fill in the phone number to continue"
    ];
    goto end;
}


if ($password == '') {
    $response = [
        'success' => false,
        'message' => "PASSWORD IS REQUIRED, Kindly fill in the password to continue"
    ];
    goto end;
}

if ($specialist == '') {
    $response = [
        'success' => false,
        'message' => "SPECIALIST IS REQUIRED, Kindly fill in the specialist to continue"
    ];
    goto end;
}

if ($departmentId == '') {
    $response = [
        'success' => false,
        'message' => "DEPARTMENT ID IS REQUIRED, Kindly fill in the DEPARTMENT ID to continue"
    ];
    goto end;
}

$emailcheck = mysqli_query($conn, "SELECT * FROM staff_tab WHERE email_address = '$emailAddress'") or die(mysqli_error($conn));
if (mysqli_num_rows($emailcheck) > 0) {
    $response = [
        "success" => false,
        "message" => "EMAIL ALREADY EXIST kindly proceed to sign in or forget password"
    ];
    goto end;
}

$doctorId = 'DOCTOR' . date("Ymdhis");
$hashPassword=md5($password);

mysqli_query($conn, "INSERT INTO `doctor_tab`
    ( `doctor_id`, `doctor_name`, `email_address`, `phone`,`spacialist`, `status_id`, `password`, `department_id`, `created_at`, `updated_at`) VALUES
    ('$doctorId', '$Name','$emailAddress', '$phone','$specialist', '$statusId', '$hashPassword', '$departmentId', NOW(), NOW())") or die(mysqli_error($conn));

$createDoctorQuery = mysqli_query($conn, "SELECT doctor_tab.*, department_tab.department_name, status_tab.status_name FROM doctor_tab, department_tab, status_tab WHERE doctor_tab.department_id = department_tab.department_id AND doctor_tab.status_id = status_tab.status_id AND doctor_tab.email_address = '$emailAddress'") or die(mysqli_error($conn));
$doctorData = mysqli_fetch_assoc($createDoctorQuery);

$response = [
    'success' => true,
    'message' => "DOCTOR CREATED SUCCESSFUL",
    'data' => [
        'doctorId' => $doctorData['doctor_id'],
        'firstName' => $doctorData['first_name'],
        'lastName' => $doctorData['last_name'],
        'emailAddress' => $doctorData['email_address'],
        'phone' => $doctorData['phone'],
        'statusId' => $doctorData['status_id'],
        'statusName' => $doctorData['status_name'],
        'password' => $doctorData['password'],
        'roleId' => $doctorData['role_id'],
        'roleName' => $doctorData['role_name'],
        'createdAt' => $doctorData['created_at'],
        'updatedAt' => $doctorData['updated_at']
    ]
];

end:
echo json_encode($response);
?>