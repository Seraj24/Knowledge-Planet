<?php
require '../../public/templates/header.php';
require_once '../../Player.php';
require_once 'Session.php';

SessionUtility::startSession();

$player = SessionUtility::getPlayerObject();

$header = new Header("Knowledge Planet - Records");
$header->render();

class History {
    private $global;
    public function __construct($global=true) {
        $this->global = $global;
    }

    public function render() {
        global $player;
        ?>

        <div class="container">
            <?php
            require '../../db/Database.php';

            echo $this->global ? "<h2>Global Records</h2>" : "<h2>Personal Records</h2>";
            
            try {
                // Create a Database object
                $database = new Database();

                // Connect to the database
                $database->connectToMySQL("localhost", "root", "");
                $database->selectDatabase("php_game");

                $excute = "
                    SELECT p.registrationOrder 
                    FROM player p
                    WHERE p.username = '" . $player->getUsername() . "';
                    ";
                $result = $database->executeQuery($excute);
                $registerationOrder = null;

                if ($result === false) {
                    throw new Exception("Query execution failed.");
                }

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $registerationOrder = $row['registrationOrder'];
                } else {
                    throw new Exception("User not found");
                }

                // Execute the query to fetch history data
                if (!$this->global) {
                    $query = "
                            SELECT *
                            FROM history 
                            WHERE registrationOrder  = '$registerationOrder';
                            ";
                }
                else {
                    $query = "
                            SELECT *
                            FROM history;
                            ";
                }
                $result = $database->executeQuery($query);

                // Check if there are any rows returned
                if ($result->num_rows > 0) {
                    $roundNumber = 0;
                    // Output the history data in a table
                    echo "<table class='history-table'>";
                    $allTableTh = $this->global ?  "<th>ID</th><th>First Name</th><th>Last Name</th>" : "<th>Round</th>";
                    echo "<tr>" . $allTableTh . "<th>Score Time</th><th>Result</th><th>Lives Used</th></tr>";
                    // Fetch each row and display it in the table
                    while ($row = $result->fetch_assoc()) {
                        $roundNumber++;
                        echo "<tr>";
                        if ($this->global) {
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['firstName'] . "</td>";
                            echo "<td>" . $row['lastName'] . "</td>";
                        }
                        else {
                            echo "<td>" . $roundNumber . "</td>";
                        }
                        echo "<td>" . $row['scoreTime'] . "</td>";
                        echo "<td>" . $row['result'] . "</td>";
                        echo "<td>" . $row['livesUsed'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    // If no history data is found, display a message
                    echo "<p>No history available.</p>";
                }

                // Close the database connection
                $database->closeMySql();
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
            if ($this->global) {
            ?>
            <h2>View your personal rounds</h2>
            <br>
            <form action="PlayerHistory.php">
                <button type="submit" id="signInButton" name="signInButton" value="SEND">Personal History</button>
            </form>
            <?php
            }
            else {
            ?>
            <h2>View global rounds</h2>
            <br>
            <form action="GlobalHistory.php">
                <button type="submit" id="signInButton" name="signInButton" value="SEND">Global History</button>
            </form>
            <?php
            }
            ?>
            <form method="post" action="../../src/home/Main.php">
                <!-- Button to return to the home page -->
                <br><br>
                <button type="submit" id="signInButton" name="signInButton" value="SEND">Home Page</button>
            </form>
            </div>
        <?php

    }
}
require '../../public/templates/footer.html';
