<!DOCTYPE html>
<html>

<head>
    <title>Step 3</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/appstep3-css.css" />
    <!-- <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="jscript/appstep3-validation.js" defer></script> -->
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


    <div class="prog_bar">
    </div>
    <div class="APPOINTMENT-FORM-container">

        <form action="backend/process-appstep3.php" method="post" id="appstep3" novalidate>
            <h1>Step 3-4:<br> <br>Medical History</h1>

            <div class="input-group">
                <label>DO YOU HAVE ANY FORM OF Diabetes?</label>
                <div class="flex-group">
                    <input type="radio" id="diabetes_1" name="diabetes" value="yes" required>
                    <label for="diabetes_1">YES</label>
                    <input type="radio" id="diabetes_2" name="diabetes" value="no">
                    <label for="diabetes_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>DO YOU HAVE ANY HEART CONDITIONS<br></label>
                <div class="flex-group">
                    <input type="radio" id="heartconditions_1" name="heartconditions" value="yes" required>
                    <label for="heartconditions_1">YES</label>
                    <input type="radio" id="heartconditions_2" name="heartconditions" value="no">
                    <label for="heartconditions_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>ARE YOU HYPERTENSIVE(With high blood pressure)<br></label>
                <div class="flex-group">
                    <input type="radio" id="hypertension_1" name="hypertension" value="yes" required>
                    <label for="hypertension_1">YES</label>
                    <input type="radio" id="hypertension_2" name="hypertension" value="no">
                    <label for="hypertension_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>DO YOU EXPERIENCE AN ALLERGIC REACTION TO ANY OF THE FOLLOWING DRUGS/MEDICATIONS?<br></label>
                <div id="medallergen" style="display: block;">
                    <div class="grid">
                        <label for="medallergen_1">Mefenamic Acid</label>
                        <input type="checkbox" id="medallergen_1" name="medallergen" value="1">
                        <label for="medallergen_2">Ibuprofen</label>
                        <input type="checkbox" id="medallergen_2" name="medallergen" value="2">
                        <label for="medallergen_3">Aspirin</label>
                        <input type="checkbox" id="medallergen_3" name="medallergen" value="3">
                        <label for="medallergen_4">Naproxen Sodium</label>
                        <input type="checkbox" id="medallergen_4" name="medallergen" value="4">
                        <label for="medallergen_5">Paracetamol</label>
                        <input type="checkbox" id="medallergen_5" name="medallergen" value="5">
                        <label for="medallergen_6">Amoxicillin/Other type of Penicillin</label>
                        <input type="checkbox" id="medallergen_6" name="medallergen" value="6">
                        <label for="medallergen_7">Others</label>
                        <input type="checkbox" id="medallergen_7" name="medallergen" value="7">
                        <label for="medallergen_8">None that I know of</label>
                        <input type="checkbox" id="medallergen_8" name="medallergen" value="8" onclick="clearOtherAllergies(this)">

                        <script>
                            function clearOtherAllergies(checkbox) {
                                if (checkbox.checked) {
                                    // Get all the checkboxes with the name "medallergen"
                                    var checkboxes = document.getElementsByName("medallergen");

                                    // Loop through the checkboxes and uncheck the ones that are not "None that I know of"
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        if (checkboxes[i] !== checkbox && checkboxes[i].value !== "8") {
                                            checkboxes[i].checked = false;
                                            checkboxes[i].disabled = true;
                                        }
                                    }
                                } else {
                                    // Enable all the checkboxes when "None that I know of" is not checked
                                    var checkboxes = document.getElementsByName("medallergen");
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        if (checkboxes[i].value !== "8") {
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
                <label>DO YOU TAKE MAINTENANCE MEDICATION?<br></label>
                <div class="flex-group">
                    <input type="radio" id="maintenance_1" name="maintenance" value="yes" required>
                    <label for="maintenance_1">YES</label>
                    <input type="radio" id="maintenance_2" name="maintenance" value="no">
                    <label for="maintenance_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>WHAT IS YOUR USUAL SYSTOLIC PRESSURE (First number in the blood pressure)</label>
                <div>
                    <div>
                        <input type="text" id="systolicpressure" name="systolicpressure">
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label>WHAT IS YOUR USUAL SYSTOLIC PRESSURE (First number in the blood pressure)</label>
                <div>
                    <div>
                        <input type="text" id="diastolicpressure" name="diastolicpressure">
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label for="medicalconditions">DO YOU HAVE ANY OTHER SIGNIFICANT MEDICAL CONDITION?</label>
                <div>
                    <textarea id="medicalconditions" name="medicalconditions" rows="4" cols="50"></textarea>
                </div>
            </div>

            <div class="button-group">
                <button type="button" onclick="goBackToAppStep2()">PREVIOUS</button>
                <script>
                    function goBackToAppStep2() {
                        window.history.back();
                    }
                </script>
                <button type="submit">NEXT</button>
            </div>
        </form>
    </div>

    <footer>
        <?php include "../header-footer/footer.php"; ?>
    </footer>


</body>

</html>