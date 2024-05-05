/*
This file uses the modulo js file form_validate.js and assigns Forgot password form fileds id's and pass the path used to send ajax requests
*/

import { ValidateForm } from './form_validate.js';

function validateForgotPasswordForm() {
    document.addEventListener('DOMContentLoaded', function() {
        var fields = ['firstName', 'lastName', 'username', 'password', 'confirm_password'];
        var path = '../../src/features/validate_forgotpassword.php';
        var validator = new ValidateForm(fields, path);
        validator.initialize();
    });
}

validateForgotPasswordForm();