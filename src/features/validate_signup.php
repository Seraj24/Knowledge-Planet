<?php
require '../../db/Database.php';
require_once 'Validator.php';

$response = array();

// Function to validate input and return error message if any
function validateInput($inputName, $validatorFunction) {
    if (isset($_POST[$inputName])) {
        return $validatorFunction($_POST[$inputName]);
    }
    return null;
}

// Validate username
$usernameError = validateInput('username', 'SignUpValidator::validateUsername');
// Make sure to not init response until there is an actual error
if ($usernameError !== null) {
    $response['usernameError'] = $usernameError;
}

// Validate first name
$firstNameError = validateInput('firstName', 'SignUpValidator::validateFirstName');
// Make sure to not init response until there is an actual error
if ($firstNameError !== null) {
    $response['firstNameError'] = $firstNameError;
}

// Validate last name
$lastNameError = validateInput('lastName', 'SignUpValidator::validateLastName');
// Make sure to not init response until there is an actual error
if ($lastNameError !== null) {
    $response['lastNameError'] = $lastNameError;
}

// Validate password
$passwordError = validateInput('password', 'SignUpValidator::validatePassword');
// Make sure to not init response until there is an actual error
if ($passwordError !== null) {
    $response['passwordError'] = $passwordError;
}

// Validate confirm password
$confirmPasswordError = validateInput('confirm_password', function($value) {
    return SignUpValidator::validateConfirmPassword($_POST['password'], $value);
});
// Make sure to not init response until there is an actual error
if ($confirmPasswordError !== null) {
    $response['confirm_passwordError'] = $confirmPasswordError;
}

// Check if there are no validation errors and the whole form validated
if (empty($response) && isset($_POST['validateAll'])) {
    $response['success'] = true; // Validation successful
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>
