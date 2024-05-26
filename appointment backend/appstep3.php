<!DOCTYPE html>
<html>
<head>
    <title>Step 3</title>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "appstep3-validation.js" defer></script>
    <style>
        .just-validate-error-label {
          margin-top: 5px;
          margin-left: 10px;
        }
      </style>
</head>
<body>

    
    <h1>Step 3-4:<br>Medical History</h1>
    
    <form action="process-appstep3.php" method="post" id="appstep3" novalidate>
        
        <div>
		<label>DO YOU HAVE ANY FORM OF DIABETES<br></label>
            <div id="diabetes" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="diabetes_1" name="diabetes" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="diabetes_2" name="diabetes" value="no" /> NO <br>
            
                </div>     
            </div>
		</div> 

        <div>
		<label>DO YOU HAVE ANY HEART CONDITIONS<br></label>
            <div id="heartconditions" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="heartconditions_1" name="heartconditions" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="heartconditions_2" name="heartconditions" value="no" /> NO <br>
            
                </div>     
            </div>
		</div> 

        <div>
		<label>ARE YOU HYPERTENSIVE(With high blood pressure)<br></label>
            <div id="hypertension" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="hypertension_1" name="hypertension" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="hypertension_2" name="hypertension" value="no" /> NO <br>
            
                </div>     
            </div>
		</div> 
        
        <div>
            <label>DO YOU EXPERIENCE AN ALLERGIC REACTION TO ANY OF THE FOLLOWING DRUGS/MEDICATIONS?<br></label>
            <div id="medallergen" style = "display: block;">
                <div>
                    <input type="checkbox" id="medallergen_1" name="medallergen" value="1" /> Mefenamic Acid <br>
                    <input type="checkbox" id="medallergen_2" name="medallergen" value="2" /> Ibuprofen <br>
                    <input type="checkbox" id="medallergen_3" name="medallergen" value="3" /> Aspirin <br>
                    <input type="checkbox" id="medallergen_4" name="medallergen" value="4" /> Naproxen Sodium <br>
                    <input type="checkbox" id="medallergen_5" name="medallergen" value="5" /> Paracetamol <br>
                    <input type="checkbox" id="medallergen_6" name="medallergen" value="6" /> Amoxicillin/Other type of Penicillin <br>
                    <input type="checkbox" id="medallergen_7" name="medallergen" value="7" /> Others <br>
                    <input type="checkbox" id="medallergen_8" name="medallergen" value="8" onclick="clearOtherAllergies(this)"/> None that I know of <br>

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

        <div>
		<label>DO YOU TAKE MAINTENANCE MEDICATION?<br></label>
            <div id="maintenance" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="maintenance_1" name="maintenance" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="maintenance_2" name="maintenance" value="no" /> NO <br>
            
                </div>     
            </div>
		</div> 

        <div>
            <label>WHAT IS YOUR USUAL SYSTOLIC PRESSURE (First number in the blood pressure)</label>
                <div>
                    <div>
                        <input type="text" id="systolicpressure" name="systolicpressure">
                    </div>
                </div>
        </div>

        <div>
            <label>WHAT IS YOUR USUAL SYSTOLIC PRESSURE (First number in the blood pressure)</label>
                <div>
                    <div>
                        <input type="text" id="diastolicpressure" name="diastolicpressure">
                    </div>
                </div>
        </div>

        <div style = "display: inline;">
            <label for="medicalconditions">DO YOU HAVE ANY OTHER SIGNIFICANT MEDICAL CONDITION?</label>
                <div>
                <textarea style ="
                font-size: 16px;
                color: #333;
                border: 1px solid #ccc;
                padding: 10px;
                resize: none;
                overflow-y: auto;
                max-height: 2vw;
                min-height: 1vw;
                width: 20%;" id="medicalconditions" name="medicalconditions" rows="4" cols="50"></textarea>
                </div>
        </div>

		

        <div>
        <button type="button" onclick="goBackToAppStep2()">Previous</button>
        <script>function 
        goBackToAppStep2() {
            window.location.href = "appstep2.php";
        }   
        </script>
        <button type="submit">Next</button>
        </div>
    </form>
</body>

</html>








