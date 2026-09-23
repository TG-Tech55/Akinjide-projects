<?php require_once '../config/connection.php'; ?>

<?php
// decleration of variable
$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$address = $_POST['address'];
$statusId =1;

if($firstName == ''){
    $response = [
        'success' => false,
        'message' => "FISRT NAME IS REQUIRED. KINDLY FILL IN THE first name to continue",
    ];
    goto end;
}

if($lastName == ''){
    $response = [
        'success' => false,
        'message' => "LAST NAME IS REQUIRED. KINDLY FILL IN THE first name to continue",
    ];
    goto end;
}

if($address == ''){
    $response = [
        'success' => false,
        'message' => "ADDRESS IS REQUIRED. KINDLY FILL IN THE first name to continue",
    ];
    goto end;
}

$userId ='USER' . date("ymdhis");

$response =[
    'success' => true,
    'message' => "USER REGISTRATION SUCCESSFULLY!",
    'data' => [
        'userId' => $userId,
        'firstName' => $lastName,
        'address' => $address,
    ]
];

end:
echo json_encode($response);
?>
