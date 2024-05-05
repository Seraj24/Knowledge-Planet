document.addEventListener("DOMContentLoaded", function() {
    // Function to send AJAX request with answer value
    function sendAnswer() {
        var answer = document.getElementById("answer")?.value;
        var highest = document.getElementById("highest")?.value;
        var word = document.getElementById("word")?.innerText;
        var nextLevelButton = document.getElementById("nextLevel");
        var checkButton = document.getElementById("checkButton");
        
        var data = "answer=" + encodeURIComponent(answer) + "&word=" + encodeURIComponent(word) + "&highest=" + encodeURIComponent(highest);
        var xhr = new XMLHttpRequest();

        xhr.open("POST", "../../src/game/validate_answer.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var corretAnswerSpan = document.getElementById("correctAnswer");
                    corretAnswerSpan.style.color = "red";
                    document.getElementById("lives").innerText = response.lives;
                    if (response.result) {
                        switch(response.result) {
                            case "Correct!":
                                corretAnswerSpan.style.color = "rgb(80, 180, 80)";
                                response.result = "Great job! You got it right!"
                                if (response.level >= 6) {
                                    nextLevelButton.remove();
                                    document.getElementById("finishButton").style.display = "";
                                    response.result += " You won the game! Great job! Click finish to procced";
                                }
                                else {
                                    nextLevelButton.removeAttribute('disabled');
                                }
                               
                                break;
                            case "Game Failed!":
                                checkButton.remove();
                                nextLevelButton.remove();
                                document.getElementById("restartButton").style.display = "";
                                document.getElementById("cancelButton").style.display = "none";
                                document.getElementById("homeButton").style.display = "";
                                response.result = "Oops! Looks like you've run out of lives. But don't worry, you can do it next time!";
                                break;
                            default:
                            document.getElementById("lives").innerText = response.lives;
                            nextLevelButton.setAttribute('disabled', 'disabled');
                            break;
                            
                        }
                        corretAnswerSpan.innerText = response.result; 
                    }      
                } else {
                    alert("AJAX request failed: " + xhr.status);
                }
            }
        };
        xhr.send(data); 
    }
    document.getElementById("checkButton").addEventListener("click", sendAnswer);
});
