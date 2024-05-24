<!DOCTYPE html>
<html>
<head>
    <title>Step 2</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="appstep2-css.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="appstep2-validation.js" defer></script>
    <style>
        .just-validate-error-label {
            margin-top: 5px;
            margin-left: 10px;
        }
    
        <?php include "../header-footer/header-footer.css"; ?>
        

    </style>
    
    
</head>
<body>

    <div class="wrapper">
        <header>
        <?php include "../header-footer/header.php"; ?>
      </header>
    </div>

    <div class="prog_bar">
         <center><img src="images/whitebg-progress_bar[2-4].jpg" alt="progress bar 2-4" height="15%" width="50%"/></center>
    </div>

    <div class="APPOINTMENT-FORM-container">
        <form action="process-appstep2.php" method="post" id="appstep2" novalidate>
            <h1>Step 2-4: </h1>
            <div class="chief-complaint-title">Chief Complaint</div>
            <div class="input-group">
                <label for="complaint">CHIEF COMPLAINT</label>
                <div>
                    <textarea id="complaint" name="complaint" rows="4" cols="50" placeholder="Provide details of the chief complaint (history of pain, etc.)" required></textarea>
                </div>
            </div>

            <div class="input-group">
                <label for="details">PROVIDE DETAILS OF CHIEF COMPLAINT</label>
                <div>
                    <textarea id="details" name="details" rows="4" cols="50" placeholder="Provide details of the chief complaint (history of pain, etc.)" required></textarea>
                </div>
            </div>

            <div class="input-group">
                <label>ARE YOU EXPERIENCING DENTAL PAIN?</label>
                <div class="flex-group">
                    <input type="radio" id="dentalpain_1" name="dentalpain" value="yes" required>
                    <label for="dentalpain_1">YES</label>
                    <input type="radio" id="dentalpain_2" name="dentalpain" value="no">
                    <label for="dentalpain_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>WHAT IS YOUR PAIN LEVEL? (0 (NO PAIN) TO 10 (EXTREMELY PAINFUL))</label>
                <div>
                    <select id="painlevel" name="painlevel" required>
                        <option value="" disabled selected>Select an option</option>
                        <?php
                        for ($i = 0; $i <= 10; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label>HAVE YOU EXPERIENCED DENTAL TRAUMA? (Injury to the mouth, teeth, or other structures)</label>
                <div class="flex-group">
                    <input type="radio" id="dentaltrauma_1" name="dentaltrauma" value="yes" required>
                    <label for="dentaltrauma_1">YES</label>
                    <input type="radio" id="dentaltrauma_2" name="dentaltrauma" value="no">
                    <label for="dentaltrauma_2">NO</label>
                </div>
            </div>

            <div class="input-group">
                <label>HAVE YOU NOTICED ANY UNCONTROLLED BLEEDING FROM THE SOFT TISSUES OF YOUR MOUTH?</label>
                <div class="flex-group">
                    <input type="radio" id="bleedingtissues_1" name="bleedingtissues" value="yes" required>
                    <label for="bleedingtissues_1">YES</label>
                    <input type="radio" id="bleedingtissues_2" name="bleedingtissues" value="no">
                    <label for="bleedingtissues_2">NO</label>
                </div>
            </div>

            <div class="button-group">
                <button type="button" onclick="goBackToAppStep1()">PREVIOUS</button>
                <button type="submit">NEXT</button>
            </div>
        </form>
    </div>

    <footer> 
            <?php include "../header-footer/footer.php"; ?>  
    </footer>

    <script>
        function goBackToAppStep1() {
            window.history.back(); 
        }
    </script>

</body>
</html>
