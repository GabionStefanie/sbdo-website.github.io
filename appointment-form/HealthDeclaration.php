<!DOCTYPE html>
<html lang="eng">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chief Complaint</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="HealthDeclaration.css" />
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
         <center><img src="images/progress_bar[4-4].jpg" alt="progress bar 2-4" height="15%" width="50%"/></center>

        </div>

        <center><form>

          
         
          <div class = "title">
            <br>
            <h1> <b>STEP 4- 4:</b></h1>
            <h1> Health Declaration</h1>
           </div>

             <div class ="q1">
              <label for="CovidVaccine"><h2>COVID-19 VACCINE STATUS </h2></label>  
              <div class="CVSQ"style="size:30%;">
                <select name="VaccineStatus" id="VaccineStatus" required>
              
                 <option value = "none">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp --------------   &nbsp &nbsp &nbsp </option>
                 <option value = "VACCINATED">&nbsp &nbsp &nbsp &nbsp VACCINATED</option>
                 <option value = "UNVACCINATED">&nbsp &nbsp &nbsp UNVACCINATED</option>
                </select>
              </div>
             </div>
              <div class="q2">
                 <label for="SymptomsQ"><h2>At the moment, do you experience any of the following symptoms? </h2></label>
                <br>
                <div class="checkbox-label">

                    <label class="customizedCheck">
                    <ul>
                    
                         <li>Fever&nbsp&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Symptoms" value="FEVER"  style="width:1.5vw; height:1.5vw;" /></li>
                         <br>
                         <li>Colds &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <input type="checkbox" name="Symptoms" value="COLDS"  style="width:1.5vw; height:1.5vw;"/></li>
                         <br>
                         <li>Cough&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <input type="checkbox" name="Symptoms" value="COUGH"  style="width:1.5vw; height:1.5vw;"/></li>
                         <br>
                         <li>Sore Throat &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Symptoms" value="SORE THROAT" style="width:1.5vw; height:1.5vw;"/></li>
                         <br>
                         <li>Headache&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Symptoms" value="HEADACHE"  style="width:1.5vw; height:1.5vw;"/></li>
                        <br>
                         <li>Diarrhea&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="checkbox" name="Symptoms" value="DIARRHEA" style="width:1.5vw; height:1.5vw;"/></li>
                        <br>
                         <li>None&nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type="checkbox" name="Symptoms" value="NONE"  style="width:1.5vw; height:1.5vw;"/> </li>
                        <br>
                       
                    </ul>
                  </label>
                   </div>
             </div>
               <div class="q3">
                 <br>
                <h2> DECLARATION: By completing and submitting this form, you consent to share this health information with Sulit & Bagasan Dental Office.
                 <br>
                 <br>
                 <br>
                The information I have given herein is true, correct, and complete. I 
                understand that failure to answer any question or any falsified responses may 
                have serious consequences. (Article 171 and 172 of the Revised Penal Code of 
                the Philippines.)</h2>
            </div>
            <div class="q4">

             <div class="Agq">
              <label for="Agree"></label>
              <ul>
                <li>  AGREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp                   <input type="checkbox" name="AGREEMENT" value="AGREE" style="width:1.5vw; height:1.5vw;"></li> 
                <br>
               </ul>
            </div>
            </div>
            

            
            

        <div class="buttons" >
           <button id="b1"onclick= "location.href='MedicalHistory.php'" type="button"><div class = "buttontext1">PREVIOUS &nbsp </div></button>
           <button id="b2" onclick= "location.href='appointments-end-html.php'" type="button"><div class="buttontext2">NEXT</div></button>
         </div>






        </form></center>





        <footer> 
            <?php include '../header-footer/footer.php' ?>  
        </footer>
      </div>
    </body>
  </html>
