<!DOCTYPE html>
<html>
<head>
    <title>Step 2</title>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src = "appstep2-validation.js" defer></script>
    <style>
        .just-validate-error-label {
          margin-top: 5px;
          margin-left: 10px;
        }
      </style>
</head>
<body>

    
    <h1>Step 2-4:<br>Chief Complaint</h1>
    
    <form action="process-appstep2.php" method="post" id="appstep2" novalidate>
        
        <div style = "display: inline;">
            <label for="complaint">CHIEF COMPLAINT</label>
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
                width: 20%;" id="complaint" name="complaint" rows="4" cols="50"></textarea>
                </div>
        </div>

        <div style = "display: inline;">
            <label for="details">PROVIDE DETAILS OF CHIEF COMPLAINT (HISTORY OF PAIN,ETC.)</label>
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
                width: 20%;" id="details" name="details" rows="4" cols="50"></textarea>
                </div>
        </div>
		
		<div>
		<label>ARE YOU EXPERIENCING DENTAL PAIN?<br></label>
            <div id="dentalpain" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="dentalpain_1" name="dentalpain" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="dentalpain_2" name="dentalpain" value="no" /> NO <br>
            
                </div>     
            </div>
		</div> 
        
        <div>
         <label>WHAT IS YOUR PAIN LEVEL? (0 (NO PAIN) TO  10(EXTREMELY PAINFUL))</label>
            <div>
            <select id ="painlevel" name="painlevel">
                <option value="" disabled selected>Select an option</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            </div>
        </div>

        <div>
		<label>HAVE YOU EXPERIENCED DENTAL TRAUMA? (Injury to the mouth, teeth, or, other structures)<br></label>
            <div id="dentaltrauma" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="dentaltrauma_1" name="dentaltrauma" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="dentaltrauma_2" name="dentaltrauma" value="no" /> NO <br>
                </div>
            </div>
		</div> 

        <div>
		<label>HAVE YOU NOTICED ANY UNCONTROLLED BLEEDING FROM THE SOFT TISSUES OF YOUR MOUTH?<br></label>
            <div id="bleedingtissues" style = "display: block;">
                <div style = "display: flex;">
					<input type="radio" id="bleedingtissues_1" name="bleedingtissues" value="yes" /> YES <br>
					<input type="radio" style = "margin-left: 0.5%;" id="bleedingtissues_2" name="bleedingtissues" value="no" /> NO <br>
                </div>
            </div>
		</div> 

        <div>
        <button type="button" onclick="goBackToAppStep1()">Previous</button>
        <script>function 
        goBackToAppStep1() {
            window.location.href = "appstep1.php";
        }   
        </script>
        <button type="submit">Next</button>
        </div>
    </form>
</body>
</html>








