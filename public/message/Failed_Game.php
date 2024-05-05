<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Level");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/home/Main.php">
        <h2 style="color: rgb(192, 40, 17);">Invalid or Unknown Level</h2>
        <br><br>
        <p>Go back to home page</p>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Home Page</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
