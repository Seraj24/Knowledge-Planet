<?php
require '../../public/templates/header.php';
require '../../Player.php';
$header = new Header("Knowledge Planet - Sign Up Failed");
$header->render();
?>
<div class="container">
        <section class="story">
            <h2>Story</h2>
            <p>Welcome to our world of fun and games! We're all about bringing joy and learning together. Dive into our adventures and let your imagination run wild!</p>
        </section>
        <section class="mission">
            <h2>Mission</h2>
            <p>At Knowledge Planet, we believe that play is powerful. Our goal is to inspire creativity and learning through exciting games and activities.</p>
        </section>
        <section class="team">
            <h2>Meet the Team</h2>
            <div class="team-member">
                <h3>Seraj Alomari</h3>
            </div>
        </section>
    </div>
<?php
require '../../public/templates/footer.html';
?>
