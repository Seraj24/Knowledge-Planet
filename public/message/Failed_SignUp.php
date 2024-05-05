<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Sign Up Failed");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/redirect.php">
        <h2 style="color: rgb(192, 40, 17);">Sign Up Failed! Please re-enter your information</h2>
        <br><br>
        <button type="submit" id="signUpButton" name="signUpButton" value="SEND">Try Again</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
