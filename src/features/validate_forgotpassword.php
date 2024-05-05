<?php
$response = array();
//Validate first name
if (empty($_POST['firstName'])) {
    $response['firstNameError'] = 'First name is required';
} 

//Validate last name
if (empty($_POST['lastName'])) {
    $response['lastNameError'] = 'Last name is required';
} 

//Validate username
if (empty($_POST['username'])) {
    $response['usernameError'] = 'Username is required';
}

//Validate password
if (empty($_POST['password'])) {
    $response['passwordError'] = 'Password is required';
}
else if (strlen($_POST['password']) < 8) {
    $response['passwordError'] = 'Password must be at least 8 characters';
}

// Validate confirm password
if (empty($_POST['confirm_password'])) {
    $response['confirm_passwordError'] = 'Confirm password is required';
} else if ($_POST['password'] !== $_POST['confirm_password']) {
    $response['confirm_passwordError'] = 'Passwords do not match';
}

if (empty($response)) {
    $response['success'] = true; //Validation successful
}


header('Content-Type: application/json');
echo json_encode($response);
?>