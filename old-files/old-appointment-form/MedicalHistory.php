<!DOCTYPE html>
<html lang="eng">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Medical History</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="stylesheet-MedicalHistory.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <style>
      <?php include '../header-footer/header-footer.css' ?></>
    </style>
  </head>
  

    <body>
      <div class="wrapper">
        <header>
          <?php include '../header-footer/header.php' ?>
        </header>
        <br>
        <br>
        <div class="prog_bar">
         <center><img src="images/progress_bar[3-4].jpg" alt="progress bar 3-4" height="15%" width="50%"/></center>

        </div>
        <div class="body">
        <center><form id="MH" action="..." method="post">

        
            <script src="NONE1.js"></script>
            
        
            
            <div class = "title">
             <br>
             <h1> <b>STEP 3- 4:</b></h1>
             <h1> Medical History</h1>
            </div>
            
             

            <div class ="q1">
                <label for = "DiabQ"><h2>DO YOU HAVE ANY FORM OF DIABETES?</h2></label>
                <div class="DiabetesQues" style="size:30%;">
                 <select name="DiabQ" id="DiabQ" required>
              
                    <option value = "none"> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp --------------   &nbsp &nbsp &nbsp </option>
                    <option value = "YES">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp YES</option>
                    <option value = "NO">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbspNO</option>
                  </select>
              </div>
            </div>

        <div class="q2">
            <label for="HconQ"><h2>DO YOU HAVE ANY HEART CONDITIONS?</h2></label>
              <div class="HCQ" style="size:30%;">
                <select name="HconQ" id="HconQ" required>
                  <option value = "none">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp --------------   &nbsp &nbsp &nbsp  </option>
                  <option value = "YES">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp YES</option>
                  <option value = "NO">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbspNO</option>
                </select>
              </div>
               
        </div>
              <div class="q3">
                <br>
                 <label for="HypQ"><h2>ARE YOU HYPERTENSIVE?(With high blood pressure)</h2></label>
                   <div class="HyperTensQ" style="size:30%;">
                      <select name="HypQ" id="HypQ" required>
                        <option value = "none">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp --------------   &nbsp &nbsp &nbsp   </option>
                        <option value = "YES">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp YES</option>
                        <option value = "NO">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbspNO</option>
                     </select>
                   </div>
                </div>
                    
          <div class="q5">
            <br>
            <br>
            <label for= "Medication"><h2>DO YOU EXPERIENCE AN ALLERGIC REACTION TO ANY OF THE FOLLOWING DRUGS/MEDICATIONS?</h2></label>

            <div class="checkbox-label">

            <label class="customizedCheck">
            <ul>
            
                 <li>Mefenamic Acid&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Mefenamic Acid"  required/></li>
                 <br>
                 <li>Ibuprofen&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Ibuprofen"  required/></li>
                 <br>
                 <li>Aspirin&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Aspirin"  required/></li>
                 <br>
                 <li>Naproxen Sodium&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Naproxen Sodium"  required/></li>
                 <br>
                <li>Paracetamol &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Mefenamic Acid" required/></li>
                <br>
                <li> Amoxicilin/ Other types of Penicillin&nbsp &nbsp &nbsp<input type="checkbox" name="Medication" value="Amoxicilin / Other types of Penicillin"  required/></li>
                <br>
                <li> Others &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Medication" value="Others"  required/> </li>
                <br>
                <li>None that I know of &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="checkbox" name="Medication" value="None"  required/></li>
                <br>
            </ul>
          </label>
           </div>
           </div>

            <div class="q6">
              <label for = "MedicationHypertensionQ"><h2>DO YOU TAKE ANY MAINTENANCE MEDICATION TO CONTROL YOUR HYPERTENSION?</h2></label>
              <div class="medHQ"style="size:30%;">
                <select name="medHypertensionQ" id="medHypertensionQ" required>
              
                 <option value = "none">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp --------------   &nbsp &nbsp &nbsp </option>
                 <option value = "YES">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp YES</option>
                 <option value = "NO">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbspNO</option>
                </select>
              </div>
            
            </div>
            
            <div class="q7">
              <label for="MedQ" ><h2>DO YOU TAKE OTHER MAINTENANCE MEDICATION</h2></label>
                  <br>
                <div class="rbLabel">
          
                  <input type="radio" id="MedQ" name="MedQ" value="YES" required />YES &nbsp
                  <input type="radio" id="MedQ" name="MedQ" value="NO" required />NO 
  
                 <br>
                 <br>
               </div>
              </label>
          </div>

          <div class ="q8">
            <label for="SPressure"> <h2>WHAT IS YOUR USUAL SYSTOLIC PRESSURE(First number in the blood pressure)</h2></label>
            <br>
             <input type="text" id="SPressure"name="SPressure" style="width: 60vw; height:1.5vw;" required/>
            <br>

          </div>

          <div class ="q9">
            <label for="DPressure"> <h2>WHAT IS YOUR USUAL DIASTOLIC PRESSURE(Second number in the blood pressure)</h2></label>
            <br>
             <input type="text" id="DPressure"name="DPressure" style="width: 60vw; height:1.5vw;" required/>
            <br>
            
          </div>

          <div class ="q10">
            <label class="Labelq10">
              <label for="SmedCondition"> <h2>DO YOU HAVE ANY OTHER SIGNIFICANT MEDICAL CONDITION?</h2></label>
            </label>

              
            <div class="conq10">
              <br>
               <input type="text" id="SmedCondition"name="SmedCondition" style="width: 60vw; height:1.5vw;" required/>
              <br>
            </div>
          </div>


            

        <div class="buttons"> 
          <button id="b1"onclick= "location.href='ChiefComplaint.php'" type="button"><div class = "buttontext1">PREVIOUS &nbsp </div></button>
          <button id="b2" onclick= "location.href='HealthDeclaration.php'" type="button"><div class="buttontext2">NEXT</div></button>
            
         </div>

        




        </form></center>
        </div>

  
    <footer>
      <?php include '../header-footer/footer.php' ?>

    </footer>

  </body>
</html>
















































        