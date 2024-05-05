<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Sign Up Success");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/redirect.php">
        <h2 style="color: rgb(15, 186, 15);">Account Created Successfully!</h2>
        <br><br>
        <h2>Continue to Sign In Page</h2>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Sign In</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
