<!DOCTYPE html>
<html>
<head>
    <title>Step 4</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/appstep4-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="appstep4-validation.js" defer></script>
    <style>
        .just-validate-error-label {
          margin-top: 5px;
          margin-left: 10px;
        }

        <?php include "../header-footer/header-footer.css"; ?>
    </style>
</head>
<body>

    <header>
        <?php include "../header-footer/header.php"; ?>
    </header>

    <div class="prog_bar" style="text-align: center;">
        <img src="images/whitebg-progress_bar[4-4].jpg" alt="progress bar 4-4" height="15%" width="50%"/>
    </div>

    <div class="APPOINTMENT-FORM-container">
        <form action="process-appstep4.php" method="post" id="appstep4" novalidate>
            <h1>Step 4-4:<br> <br>Medical History</h1>
            <div class="input-group">
    <label>COVID-19 VACCINATION STATUS<br></label>
    <div id="covid" style="display: block;">
        <div style="display: flex;">
            <input type="radio" id="covid_1" name="covid" value="Vaccinated" />
            <label class="radio-label" for="covid_1">Vaccinated</label> <br>
            <input type="radio" style="margin-left: 0.5%;" id="covid_2" name="covid" value="Not Vaccinated" />
            <label class="radio-label" for="covid_2">Not Vaccinated</label><br>
        </div>
    </div>
</div>
            <div class="input-group">
            <label>At the moment, do you experience any of the following symptoms?<br></label>
            <div id="symptoms" style = "display: block;">
                <div>
                    <input type="checkbox" id="symptoms_1" name="symptoms" value="1" /> Fever <br>
                    <input type="checkbox" id="symptoms_2" name="symptoms" value="2" /> Colds <br>
                    <input type="checkbox" id="symptoms_3" name="symptoms" value="3" /> Cough <br>
                    <input type="checkbox" id="symptoms_4" name="symptoms" value="4" /> Sore Throat <br>
                    <input type="checkbox" id="symptoms_5" name="symptoms" value="5" /> Headache <br>
                    <input type="checkbox" id="symptoms_6" name="symptoms" value="6" /> Diarrhea <br>
                    <input type="checkbox" id="symptoms_7" name="symptoms" value="7" onclick="clearOtherSymptoms(this)"/> None <br>
                    
                    <script>
                    function clearOtherSymptoms(checkbox) {
                    if (checkbox.checked) {
                        // Get all the checkboxes with the name "medallergen"
                        var checkboxes = document.getElementsByName("symptoms");

                        // Loop through the checkboxes and uncheck the ones that are not "None that I know of"
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i] !== checkbox && checkboxes[i].value !== "7") {
                                checkboxes[i].checked = false;
                                checkboxes[i].disabled = true;
                            }
                        }
                    } else {
                        // Enable all the checkboxes when "None that I know of" is not checked
                        var checkboxes = document.getElementsByName("symptoms");
                        for (var i = 0; i < checkboxes.length; i++) {
                            if (checkboxes[i].value !== "7") {
                                checkboxes[i].disabled = false;
                            }
                        }
                    }
                    }
                    </script>
                </div>
            </div>
        </div>

        <div class="input-group">
            <label>DECLARATION: By completing and submitting this form, you consent to share<br>
             this health information with Sulit & Bagasan Dental Office. <br><br>
             The information I have given herein is true, correct, and complete.<br>
              I understand that failure to answer any question or any falsified responses may<br>
              have serious consequences. (Article 171 and 172 of the Revised Penal Code<br>
               of the Philippines.)<br></label>
            <div id="agree" style = "display: block;">
                <div>
                    <input type="checkbox" id="agree_1" name="agree" value="1" /> AGREE <br>
                    
                </div>
            </div>
        </div>
		

        <div class="button-group">
        <button type="button" onclick="goBackToAppStep3()">PREVIOUS</button>
        <script>function 
        goBackToAppStep3() {
            window.history.back(); 
        }   
        </script>
        <button type="submit">NEXT</button>
        </div>
    </form>

    </div>

</div> 

    <footer> 
        <?php include "../header-footer/footer.php"; ?>  
    </footer>
</body>
</html>