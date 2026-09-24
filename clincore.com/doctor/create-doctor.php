<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$name = trim($_POST['name']);
$emailAddress = trim($_POST['emailAddress']);
$phone = trim($_POST['phone']);
$password = $_POST['password'];
$specialist = trim($_POST['specialist']);
$departmentId = trim($_POST['departmentId']);
$statusId = trim($_POST['statusId']);




if ($name == '') {
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

if ($statusId == '') {
    $response = [
        'success' => false,
        'message' => "STATUS ID IS REQUIRED, Kindly fill in the describtion to continue"
    ];
    goto end;
}

$emailcheck = mysqli_query($conn, "SELECT * FROM doctor_tab WHERE email_address = '$emailAddress'") or die(mysqli_error($conn));
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
    ( `doctor_id`, `doctor_name`, `email_address`, `phone`,`specialist`, `status_id`, `password`, `department_id`, `created_at`, `updated_at`) VALUES
    ('$doctorId', '$name','$emailAddress', '$phone','$specialist', '$statusId', '$hashPassword', '$departmentId', NOW(), NOW())") or die(mysqli_error($conn));

$createDoctorQuery = mysqli_query($conn, "SELECT doctor_tab.*, department_tab.department_name, status_tab.status_name FROM doctor_tab, department_tab, status_tab WHERE doctor_tab.department_id = department_tab.department_id AND doctor_tab.status_id = status_tab.status_id AND doctor_tab.email_address = '$emailAddress'") or die(mysqli_error($conn));
$doctorData = mysqli_fetch_assoc($createDoctorQuery);

$response = [
    'success' => true,
    'message' => "DOCTOR CREATED SUCCESSFUL",
    'data' => ['doctorId' => $doctorData['doctor_id'],
        'name' => $doctorData['doctor_name'],
        'emailAddress' => $doctorData['email_address'],
        'phone' => $doctorData['phone'],
        'statusId' => $doctorData['status_id'],
        'statusName' => $doctorData['status_name'],
        'password' => $doctorData['password'],
        'createdAt' => $doctorData['created_at'],
        'updatedAt' => $doctorData['updated_at']

    ]
];

end:
echo json_encode($response);
?>