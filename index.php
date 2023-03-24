<?php
// Multiple answer protection
session_start();
// Output messages
$response = '';
// Check if the form was submitted
if (isset($_POST['dane'], $_POST['klasa'], $_POST['sroda'], $_POST['czwartek'], $_POST['piatek'])) {
    // Process form data 
    // Get the max number of people per activity amd database crenedrials
    include 'assets/maxactivity.inc.php';
    include_once 'assets/dbh.inc.php';
    $date = date("Y-m-d H-i-s");
    // Assign POST variables
    $dane = mysqli_real_escape_string($conn, $_POST['dane']);
    $klasa = mysqli_real_escape_string($conn, $_POST['klasa']);
    $sroda = mysqli_real_escape_string($conn, $_POST['sroda']);
    $czwartek = mysqli_real_escape_string($conn, $_POST['czwartek']);
    $piatek = mysqli_real_escape_string($conn, $_POST['piatek']);
    // Get the database entries for the selected activities
    $querySr = mysqli_query($conn, "SELECT * FROM rekolekcje WHERE sroda='$sroda';");
    $queryCzw = mysqli_query($conn, "SELECT * FROM rekolekcje WHERE czwartek='$czwartek';");
    $queryPt = mysqli_query($conn, "SELECT * FROM rekolekcje WHERE piatek='$piatek';");
    $queryDane = mysqli_query($conn, "SELECT dane FROM rekolekcje WHERE dane='$dane';");
    $queryKlasa = mysqli_query($conn, "SELECT klasa FROM rekolekcje WHERE klasa='$klasa';");
    // Check if the number of rows
    $CheckSr = mysqli_num_rows($querySr);
    $CheckCzw = mysqli_num_rows($queryCzw);
    $CheckPt= mysqli_num_rows($queryPt);
    $CheckDane= mysqli_num_rows($queryDane);
    // Set count variables to prevent Undefined variable error
    $countSr = 1;
    $countCzw = 1;
    $countPt = 1;

    // Get the current number of people in a activity
    if ($CheckSr > 0) {
        while ($row = mysqli_fetch_assoc($querySr)) {
        $countSr += 1;
        }
    }
    if ($CheckCzw > 0) {
        while ($row = mysqli_fetch_assoc($queryCzw)) {
        $countCzw += 1;
        }
    }
    if ($CheckPt > 0) {
        while ($row = mysqli_fetch_assoc($queryPt)) {
        $countPt += 1;
        }
    }
    // Check if its full
    if ($countSr > $maxSroda[$sroda]) {
        $response = '<h3>Za późno!</h3><p>Wybrane środowe zajęcie jest pełne, wybierz inne!</a>';
    }
    if ($countCzw > $maxCzwartek[$czwartek]) {
        $response = '<h3>Za późno!</h3><p>Wybrane czwartkowe zajęcie jest pełne, wybierz inne!</a>';
    }
    if ($countPt > $maxPiatek[$piatek]) {
        $response = '<h3>Za późno!</h3><p>Wybrane piątkowe zajęcie jest pełne, wybierz inne!</a>';
    }

    // Send data to database and setup multiple answer protection
    if (empty($response) && !isset($_SESSION['submited'])) {
        // Duplicate name updater

        if ($CheckDane > 0) {
            if ($queryDane = $dane && $queryKlasa = $klasa) {
                mysqli_query($conn, "UPDATE rekolekcje SET sroda='$sroda', czwartek='$czwartek', piatek='$piatek', data='$date' WHERE dane='$dane';");
            } else {
                mysqli_query($conn, "INSERT INTO rekolekcje (dane, klasa, sroda, czwartek, piatek, data) VALUES ('$dane', '$klasa', '$sroda', '$czwartek', '$piatek', '$date');");
            }
        } else {
            mysqli_query($conn, "INSERT INTO rekolekcje (dane, klasa, sroda, czwartek, piatek, data) VALUES ('$dane', '$klasa', '$sroda', '$czwartek', '$piatek', '$date');");
        }
            
        $response = '<h3>Dziękujemy!</h3><p>Twoje opcje zostały poprawie zapisane.</p>';
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['submited'] = true;
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
                            <input type="radio" name="sroda" id="sroda1" value="sr1" required>
                            <b style="color:blue;">Religijne&nbsp;-&nbsp;</b>Rozpoczęcie rekolekcji - nauka rekolekcyjna w Katedrze
                        </label>
                        <label for="sroda2">
                            <input type="radio" name="sroda" id="sroda2" value="sr2" required>
                            Warsztaty medialne - Radio Em
                        </label>
                        <label for="sroda3">
                            <input type="radio" name="sroda" id="sroda3" value="sr3" required>
                            Relacje chrześcijańsko-żydowskie w Polsce – wykład
                        </label>
                        <label for="sroda4">
                            <input type="radio" name="sroda" id="sroda4" value="sr4" required>
                            Warsztaty taneczne
                        </label>
                        <label for="sroda5">
                            <input type="radio" name="sroda" id="sroda5" value="sr5" required>
                            Rozgrywki sportowe – sala gimnastyczna i sala fitness
                        </label>
                        <label for="sroda6">
                            <input type="radio" name="sroda" id="sroda6" value="sr6" required>
                            Warsztaty dziennikarskie
                        </label>
                        <label for="sroda7">
                            <input type="radio" name="sroda" id="sroda7" value="sr7" required>
                            Wyjście historyczne - Śląskie Centrum Wolności i Solidarności
                        </label>
                        <label for="sroda8">
                            <input type="radio" name="sroda" id="sroda8" value="sr8" required>
                            Stowarzyszenie Młodych Twórców – spotkanie
                        </label>
                        <label for="sroda10">
                            <input type="radio" name="sroda" id="sroda10" value="sr10" required>
                            Wyjście do kina Rialto – grupa filmowa
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
                            <input type="radio" name="czwartek" id="czwartek1" value="czw1" required>
                            <b style="color:blue;">Religijne&nbsp;-&nbsp;</b>Warsztaty medialne - Radio Em
                        </label>
                        <label for="czwartek2">
                            <input type="radio" name="czwartek" id="czwartek2" value="czw2" required>
                            <b style="color:blue;">Religijne&nbsp;-&nbsp;</b>Potop biblijny a mit o Gilgameszu – wykład akademicki
                        </label>
                        <label for="czwartek3">
                            <input type="radio" name="czwartek" id="czwartek3" value="czw3" required>
                            <b style="color:blue;">Religijne&nbsp;-&nbsp;</b>Panteon Górnośląski - zwiedzanie
                        </label>
                        <label for="czwartek4">
                            <input type="radio" name="czwartek" id="czwartek4" value="czw4" required>
                            Uniwersytet Ekonomicznym - wykład promocyjny
                        </label>
                        <label for="czwartek5">
                            <input type="radio" name="czwartek" id="czwartek5" value="czw5" required>
                            Wielka 4 thrashmetalu – radiowęzeł zaprasza
                        </label>
                        <label for="czwartek6">
                            <input type="radio" name="czwartek" id="czwartek6" value="czw6" required>
                            Rozgrywki sportowe – sala gimnastyczna i sala fitness
                        </label>
                        <label for="czwarte7">
                            <input type="radio" name="czwartek" id="czwartek7" value="czw7" required>
                            Stowarzyszenie Młodych Twórców – spotkanie
                        </label>
                        <label for="czwartek8">
                            <input type="radio" name="czwartek" id="czwartek8" value="czw8" required>
                            Afganistan – spotkanie z weteranem wojny
                        </label>
                    </div>
                </div>
                <div class="buttons">
                    <a href="#" class="btn alt" data-set-step="1">Wstecz</a>
                    <a href="#" class="btn" data-set-step="3">Dalej</a>
                </div>
            </div>

            <!-- page 3 -->
            <div class="step-content" data-step="3">
                <div class="fields">
                    <p>Na jaki wykład chciałbyś pójść w Piątek?</p>
                    <div class="group">
                        <label for="piatek1">
                            <input type="radio" name="piatek" id="piatek1" value="pt1" required>
                            <b style="color:blue;">Religijne&nbsp;-&nbsp;</b>Droga Krzyżowa i okazja do spowiedzi - krypta katedry
                        </label>
                        <label for="piatek2">
                            <input type="radio" name="piatek" id="piatek2" value="pt2" required>
                            Dowody na istnienie Boga – wykład akademicki
                        </label>
                        <label for="piatek3">
                            <input type="radio" name="piatek" id="piatek3" value="pt3" required>
                            Panteon Górnośląski - zwiedzanie
                        </label>
                        <label for="piatek4">
                            <input type="radio" name="piatek" id="piatek4" value="pt4" required>
                            Komandosi Powstania Styczniowego – wykład historyczny
                        </label>
                        <label for="piatek5">
                            <input type="radio" name="piatek" id="piatek5" value="pt5" required>
                            Rozgrywki sportowe – sala gimnastyczna i sala fitness
                        </label>
                        <label for="piatek6">
                            <input type="radio" name="piatek" id="piatek6" value="pt6" required>
                            System informacji geograficznej – warsztaty
                        </label>
                        <label for="piatek7">
                            <input type="radio" name="piatek" id="piatek7" value="pt7" required>
                            Wyjście historyczne - Śląskie Centrum Wolności i Solidarności
                        </label>
                        <label for="piatek8">
                            <input type="radio" name="piatek" id="piatek8" value="pt8" required>
                            Stowarzyszenie Młodych Twórców – spotkanie
                        </label>
                        <label for="piatek9">
                            <input type="radio" name="piatek" id="piatek9" value="pt9" required>
                            Prelekcja o bezpieczeństwie – policja
                        </label>
                    </div>
                </div>
                <div class="buttons">
                    <a href="#" class="btn alt" data-set-step="2">Wstecz</a>
                    <a href="#" class="btn" data-set-step="4">Dalej</a>
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
                    <a href="#" class="btn alt" data-set-step="3">Wstecz</a>
                    <input type="submit" class="btn" name="submit" value="Zatwierdź">
                </div>
            </div>

            <!-- page 5 -->
            <div class="step-content" data-step="5">
                <?php if (isset($_SESSION['submited'])) { $response = '<h3>Dziękujemy!</h3><p>Twoje opcje zostały poprawie zapisane.</p>'; } ?>
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
        <?php if (!empty($_POST) || isset($_SESSION['submited'])): ?>
        setStep(5);
        <?php endif; ?>
        </script>
    </body>
</html>