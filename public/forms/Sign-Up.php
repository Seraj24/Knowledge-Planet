<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Sign Up");
$header->render();
?>

<div class="container">
    <form id="signupForm" method="post" action="../../src/features/signup_process.php">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" placeholder="Enter your first name..." >
        <span id="firstNameError" style="color: red;"></span> 
        <br><br>
        
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" placeholder="Enter your last name...">
        <span id="lastNameError" style="color: red;"></span> 
        <br><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username...">
        <span id="usernameError" style="color: red;"></span> 
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password...">
        <span id="passwordError" style="color: red;"></span> 
        <br><br>    
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password...">
        <span id="confirm_passwordError" style="color: red;"></span> 
        <br><br>       
        
        <button type="submit" id="submitButton" name="submitButton" disabled>Register</button>

    </form>
    <form method="post" action="../../src/features/redirect.php">
        <h3>Already have an account? Login by clicking the button below</h3>
        <button type="submit" value="SEND" name="signInButton">Sign In</button>
    </form>
</div>
<script type="module" src="../assets/js/signup_validate.js"></script>
<?php
require '../templates/footer.html';
?>
