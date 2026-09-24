<?php require_once __DIR__ . '/../config/connection.php'; ?>

<?php
// DECLERATION OF VARIABLE

$name = trim($_POST['name']);
$emailAddress = trim($_POST['emailAddress']);
$password = $_POST['password'];
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);
$treatment = trim($_POST['treatment']);
$doctorId = trim($_POST['doctor_id']);
$roomId = trim($_POST['room_Id']);
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


if ($password == '') {
    $response = [
        'success' => false,
        'message' => "PASSWORD IS REQUIRED, Kindly fill in the password to continue"
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


if ($address == '') {
    $response = [
        'success' => false,
        'message' => "ADDRESS IS REQUIRED, Kindly fill in the address to continue"
    ];
    goto end;
}

if ($treatment == '') {
    $response = [
        'success' => false,
        'message' => "TREATMENT IS REQUIRED, Kindly fill in the treatment to continue"
    ];
    goto end;
}

if ($doctorId == '') {
    $response = [
        'success' => false,
        'message' => "DOCTOR ID IS REQUIRED, Kindly fill in the Doctor id to continue"
    ];
    goto end;
}

if ($roomId == '') {

    $response = [
        'success' => false,
        'message' => "ROOM ID IS REQUIRED, Kindly fill in the room id to continue"
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



$emailcheck = mysqli_query($conn, "SELECT * FROM patient_tab WHERE email_address = '$emailAddress'") or die(mysqli_error($conn));
if (mysqli_num_rows($emailcheck) > 0) {
    $response = [
        "success" => false,
        "message" => "EMAIL ALREADY EXIST kindly proceed to sign in or forget password"
    ];
    goto end;
}

$patientId = 'PATIENT' . date("Ymdhis");
$hashPassword = md5($password);

mysqli_query($conn, "INSERT INTO `doctor_tab`
    ( `patient_id`, `patient_name`, `email_address`,`password`, `phone`, `address`,`treatment`, `doctor_id`, `room_id`, `password`, `status_id`, `created_at`, `updated_at`) VALUES
    ('$patientId', '$name','$emailAddress', '$password', '$phone', '$address', '$treatment', '$doctorId', '$roomId', '$hashPassword', '$statusId', NOW(), NOW())") or die(mysqli_error($conn));

$createPatientQuery = mysqli_query($conn, "SELECT patient_tab.*, room_tab.room_name, status_tab.status_name FROM patient_tab, room_tab, status_tab WHERE patient_tab.room_id = room_tab.room_id AND patient_tab.status_id = status_tab.status_id AND patient_tab.patient_id = '$patientId'") or die(mysqli_error($conn));
$patientData = mysqli_fetch_assoc($createPatientQuery);

$response = [
    'success' => true,
    'message' => "STAFF CREATED SUCCESSFUL",
    'data' => [
        'patientId' => $patientData['patient_id'],
        'name' => $patientData['name'],
        'emailAddress' => $patientData['email_address'],
        'phone' => $patientData['phone'],
        'address' => $patientData['address'],
        'statusId' => $patientData['status_id'],
        'statusName' => $patientData['status_name'],
        'password' => $patientData['password'],
        'treatment' => $patientData['treatment'],
        'doctorId' => $patientData['doctor_id'],
        'rooId' => $patientData['room_id'],
        'roomName' => $patientData['room_name'],
        'createdAt' => $patientData['created_at'],
        'updatedAt' => $patientData['updated_at']
    ]
];

end:
echo json_encode($response);
?>