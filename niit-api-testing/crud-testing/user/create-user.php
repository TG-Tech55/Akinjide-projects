<?php require_once __DIR__ . '/../../config/connection.php'; ?>

<?php
// decleration of variable

$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$emailAddress = trim($_POST['emailAddress']);
$phone = trim($_POST['phone']);
$password = md5($_POST['password']);
$statusId = 'A';

if($firstName == ''){
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
        'message' => "EMAIL ADDRESS IS REQUIRED. KINDLY FILL IN THE first name to continue",
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

if($password == ''){
    $response = [
        'success' => false,
        'message' => "PASSWORD IS REQUIRED. KINDLY FILL IN THE first name to continue",
    ];
    goto end;
}
  
   $emailCheck = mysqli_query($conn,"SELECT * FROM user_tab WHERE email_address  = '$emailAddress'") or die(mysqli_error($conn));
   if (mysqli_num_rows($emailCheck) > 0) {
    $response = [
        "success"  => false,
        "message"  => "USER ALREADY EXIST! KINDLY proceed to sign in or forgot your password",
    ];
     goto end;
   }
  
$userId ='USER' . date("ymdhis");

mysqli_query($conn,"INSERT INTO `user_tab`
    (`user_id`,`first_name`,`last_name`, `email_address`, `phone`, `status_id`, `password`, `created_at`, `updated_at`) VALUES
    ('$userId', '$firstName', '$lastName', '$emailAddress', '$phone', '$statusId', '$password', NOW(), NOW())")or die (mysqli_error($conn));

$getQuery = mysqli_query($conn, "SELECT user_tab.*, status_tab.status_name FROM user_tab, status_tab WHERE user_tab.status_id = status_tab.status_id AND user_tab.email_address = '$emailAddress'") or die(mysqli_error($conn));
$userData = mysqli_fetch_assoc($getQuery);


$response = [
    'success' => true,
    'message' => "LOGIN SUCCESSFUL",
    'data' => [
        'userId' => $userData['user_id'],
        'firstName' => $userData['first_name'],
        'lastName' => $userData['last_name'],
        'emailAddress' => $userData['email_address'],
        'phoneNumber' => $userData['phone'],
        'statusId' => $userData['status_id'],
        'statusName' => $userData['status_name'],
        'password' => $userData['password'],
        'createdAt' => $userData['created_at'],
        'updatedAt' => $userData['updated_at']
    ]
];


end:
echo json_encode($response);
?>
