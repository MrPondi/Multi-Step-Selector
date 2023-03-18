<?php
// Output messages
$response = '';
// Check if the form was submitted
if (isset($_POST['dane'], $_POST['klasa'], $_POST['sroda'], $_POST['czwartek'], $_POST['piatek'])) {
    // Process form data 
    // Assign POST variables
    $dane = $_POST['dane'];
    $klasa = $_POST['klasa'];
    $sroda = $_POST['sroda'];
    $czwartek = $_POST['czwartek'];
    $piatek = $_POST['piatek'];
    // Get the database credentials
    include_once 'assets/dbh.inc.php';
    $sql = "INSERT INTO rekolekcje (dane, klasa, sroda, czwartek, piatek) VALUES ('$dane', '$klasa', '$sroda', '$czwartek', '$piatek');";
    // Try to send the data
    if (mysqli_query($conn, $sql)) {
        // Success
        $response = '<h3>Dziękujemy!</h3><p>Twoje opcje zostały poprawie zapisane.</p>';		
    } else {
        // Fail
        $response = '<h3>Error!</h3><p>Wystąpił nieoczekiwany problem, Skonsultuj się z administratorem!</a>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <title>Zapisy na Rekolekcje</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body>
        <form class="survey-form" method="post" action="">		
            <h1><i class="far fa-list-alt"></i>Zapisy na Rekolekcje</h1>
            <div class="steps">
                <div class="step current"></div>
                <div class="step"></div>
                <div class="step"></div>
                <div class="step"></div>
                <div class="step"></div>
            </div>
            <!-- page 1 -->
            <div class="step-content current" data-step="1">
                <div class="fields">
                    <p>Na jaki wykład chciałbyś pójść w Środę?</p>
                    <div class="group">
                        <label for="sroda1">
                            <input type="radio" name="sroda" id="sroda1" value="wyklad 1">
                            wyklad 1
                        </label>
                        <label for="sroda2">
                            <input type="radio" name="sroda" id="sroda2" value="wyklad 2">
                            wyklad 2
                        </label>
                        <label for="sroda3">
                            <input type="radio" name="sroda" id="sroda3" value="wyklad 3">
                            wyklad 3
                        </label>		
                        <label for="sroda4">
                            <input type="radio" name="sroda" id="sroda4" value="wyklad 4">
                            wyklad 4
                        </label>		
                        <label for="sroda5">
                            <input type="radio" name="sroda" id="sroda5" value="wyklad 5">
                            wyklad 5
                        </label>			
                        <label for="sroda6">
                            <input type="radio" name="sroda" id="sroda6" value="wyklad 6">
                            wyklad 6
                        </label>			
                    </div>					
                </div>
                <div class="buttons">
                    <a href="#" class="btn" data-set-step="2">Dalej</a>
                </div>
            </div>

            <!-- page 2 -->
            <div class="step-content" data-step="2">
                <div class="fields">
                    <p>Na jaki wykład chciałbyś pójść w Czwartek?</p>
                    <div class="group">
                        <label for="czwartek1">
                            <input type="radio" name="czwartek" id="czwartek1" value="wyklad 1">
                            wyklad 1
                        </label>
                        <label for="czwartek2">
                            <input type="radio" name="czwartek" id="czwartek2" value="wyklad 2">
                            wyklad 2
                        </label>
                        <label for="czwartek3">
                            <input type="radio" name="czwartek" id="czwartek3" value="wyklad 3">
                            wyklad 3
                        </label>		
                        <label for="czwartek4">
                            <input type="radio" name="czwartek" id="czwartek4" value="wyklad 4">
                            wyklad 4
                        </label>		
                        <label for="czwartek5">
                            <input type="radio" name="czwartek" id="czwartek5" value="wyklad 5">
                            wyklad 5
                        </label>			
                        <label for="czwartek6">
                            <input type="radio" name="czwartek" id="czwartek6" value="wyklad 6">
                            wyklad 6
                        </label>			
                    </div>
                </div>
                <div class="buttons">
                    <a href="#" class="btn" data-set-step="3">Dalej</a>
                    <a href="#" class="btn alt" data-set-step="1">Wstecz</a>
                </div>
            </div>

            <!-- page 3 -->
            <div class="step-content" data-step="3">
                <div class="fields">
                    <p>Na jaki wykład chciałbyś pójść w Piątek?</p>
                    <div class="group">
                        <label for="piatek1">
                            <input type="radio" name="piatek" id="piatek1" value="wyklad 1">
                            wyklad 1
                        </label>
                        <label for="piatek2">
                            <input type="radio" name="piatek" id="piatek2" value="wyklad 2">
                            wyklad 2
                        </label>
                        <label for="piatek3">
                            <input type="radio" name="piatek" id="piatek3" value="wyklad 3">
                            wyklad 3
                        </label>		
                        <label for="piatek4">
                            <input type="radio" name="piatek" id="piatek4" value="wyklad 4">
                            wyklad 4
                        </label>		
                        <label for="piatek5">
                            <input type="radio" name="piatek" id="piatek5" value="wyklad 5">
                            wyklad 5
                        </label>			
                        <label for="piatek6">
                            <input type="radio" name="piatek" id="piatek6" value="wyklad 6">
                            wyklad 6
                        </label>			
                    </div>
                </div>
                <div class="buttons">
                    <a href="#" class="btn" data-set-step="4">Dalej</a>
                    <a href="#" class="btn alt" data-set-step="2">Wstecz</a>
                </div>
            </div>
            
            <!-- page 4 -->
            <div class="step-content" data-step="4">
                <div class="fields">
                    <label for="dane">Twoje imię i nazwisko</label>
                    <div class="field">
                        <i class="fas fa-user"></i>
                        <input id="dane" type="text" name="dane" placeholder="Twoje imię i nazwisko" maxlength= "128" required>
                    </div>
                    <label for="klasa">Twoja klasa</label>
                    <div class="field klasa">
                        <i class="fas fa-school"></i>
                        <input id="klasa" type="text" name="klasa" placeholder="Twoja klasa (np 1a)" maxlength= "2" size="1" required>
                    </div>
                </div>
                <div class="buttons">
                    <input type="submit" class="btn" name="submit" value="Zatwierdź">
                    <a href="#" class="btn alt" data-set-step="3">Wstecz</a>
                </div>
            </div>

            <!-- page 5 -->
            <div class="step-content" data-step="5">
                <div class="result"><?=$response?></div>
            </div>
        </form>
        <script>
        const setStep = step => {
            document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
            document.querySelector("[data-step='" + step + "']").style.display = "block";
            document.querySelectorAll(".steps .step").forEach((element, index) => {
                index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
                index == step-1 ? element.classList.add("current") : element.classList.remove("current");
            });
        };
        document.querySelectorAll("[data-set-step]").forEach(element => {
            element.onclick = event => {
                event.preventDefault();
                setStep(parseInt(element.dataset.setStep));
            };
        });
        <?php if (!empty($_POST)): ?>
        setStep(5);
        <?php endif; ?>
        </script>
    </body>
</html>