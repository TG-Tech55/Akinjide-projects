<?php require_once __DIR__ . '/../../config/connection.php'; ?>

<?php
// decleration of variable
$userId = trim($_POST['userId']);
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$emailAddress = trim($_POST['emailAddress']);
$phone = trim($_POST['phone']);
$roleId = ($_POST['roleId']);
$statusId = trim($_POST['statusId']);

if($userId == ''){
    $response = [
        'success' => false,
        'message' => "FIRST NAME IS REQUIRED. KINDLY FILL IN THE first name to continue",
    ];
    goto end;
}

if($lastName == ''){
    $response = [
        'success' => false,
        'message' => "LAST NAME IS REQUIRED. KINDLY FILL IN THE last name to continue",
    ];
    goto end;
}

if($emailAddress == ''){
    $response = [
        'success' => false,
        'message' => "EMAIL ADDRESS IS REQUIRED. KINDLY FILL IN THE email to continue",
    ];
    goto end;
}

if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){ /// start if 2
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "INVALID EMAIL ADDRESS! Enter a valid email address and try again",
        ]; 
        goto end;
    }

if($phone == ''){
    $response = [
        'success' => false,
        'message' => "PHONE NUMBER IS REQUIRED. KINDLY FILL IN THE phone number to continue",
    ];
    goto end;
}

  
   $emailCheck = mysqli_query($conn,"SELECT * FROM staff_tab WHERE email_address = '$emailAddress' AND user_id != '$userId' LIMIT 1") or die(mysqli_error($conn));
   if (mysqli_num_rows($emailCheck) > 0) {
    $response = [
        "success"  => false,
        "message"  => "Email ALREADY EXIST! this email $emailAddress already used by someone, kindly use another email to continue",
    ];
    goto end;
   }

   mysqli_query($conn, "UPDATE staff_tab SET first_name='$firstName', last_name='$lastName', email_address='$emailAddress', phone='$phone', role_id='$roleId', status_id='$statusId', created_at= NOW() Where user_id  = '$userId'");


  $response = [
    'success' => true,
    'message' => "USER PROFILE SUCCESSFULLY!",
    
];

$getQuery = mysqli_query($conn, "SELECT staff_tab.*, status_tab.status_name FROM staff_tab, status_tab WHERE staff_tab.status_id = status_tab.status_id AND staff_tab.email_address = '$emailAddress'") or die(mysqli_error($conn));
$staffData = mysqli_fetch_assoc($getQuery);


$response = [
    'success' => true,
    'message' => "LOGIN SUCCESSFUL",
    'data' => [
        'staffId' => $staffData['user_id'],
        'firstName' => $staffData['first_name'],
        'lastName' => $staffData['last_name'],
        'emailAddress' => $staffData['email_address'],
        'phoneNumber' => $staffData['phone'],
        'statusId' => $staffData['status_id'],
        'statusName' => $staffData['status_name'],
        'password' => $staffData['password'],
        'roleId' => $staffData['role_id'],
        'createdAt' => $staffData['created_at'],
        'updatedAt' => $staffData['updated_at']
    ]
];


end:
echo json_encode($response);
?>
