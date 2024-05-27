<!DOCTYPE html>
<html lang="eng">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chief Complaint</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="stylesheet-ChiefComplaint.css" />
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
         <center><img src="images/progress_bar[2-4].jpg" alt="progress bar 2-4" height="15%" width="50%"/></center>

        </div>

        <center><form id="CC">

          
         
          <div class = "title">
            <br>
            <h1> <b>STEP 2- 4:</b></h1>
            <h1> Chief Complaint</h1>
           </div>

             <div class ="q1">
              <label for="chiefComplaint"> <h2>CHIEF COMPLAINT</h2></label>
                <br>
                  <input type="text" id="chiefComplaint"name="chiefComplaint" style="width: 60vw; height:1.5vw;" required/>
                <br>
                <br>
             </div>
              <div class="q2">
                 <label for="ccDeets"><h2>PROVIDE DETAILS OF CHIEF COMPLAINT (HISTORY OF PAIN, ETC.)</h2></label>
                <br>
                 <input type="text" id="ccDeets"name="ccDeets" style="width: 60vw; height:1.5vw;" required/>
             </div>
               <div class="q3">
                 <br>
                 <label for="QPain"><h2>ARE YOU EXPERIENCING DENTAL PAIN?</h2></label>
                 <br>
              <div class="rbLabel">
                <input type="radio" id="QPain" name="QPain" value="YES" />YES &nbsp
                <input type="radio" id="QPain" name="QPain" value="NO" />NO
              </div>
            </div>
            <div class="q4">
              <label for="PLevel"><h2>WHAT IS YOUR PAIN LEVEL? 0 (NO PAIN) TO 10 (EXTREMELY PAINFUL)</h2></label>
                <br>
                 <input type="text" id="PLevel" name="PLevel" class="Pain-lvl" style="width: 60vw; height:1.5vw;" maxlength="2" required/>
                 <script src="painlevel.js"></script>
                </div>

          <div class="q5">
              <br>
              <br>
      
               <label for="DTrauma"><h2>HAVE YOU EXPERIENCED DENTAL TRAUMA? (Injury to the mouth, teeth, or, other structures) </h2></label>
                  <div class="rbLabel">
                      <input type="radio" id="DTrauma" name="DTrauma" value="YES" required/>YES &nbsp 
                      <input type="radio" id="DTrauma" name="DTrauma" value="NO" required />NO
                      <br>
                     <br>
                    </div>

            </div>
            <div class="q6">
               <label for="QUnconBleeding" required><h2>HAVE YOU NOTICED ANY UNCONTROLLED BLEEDING FROM THE SOFT TISSUES OF YOUR MOUTH? </h2></label>
            
                 <br>
                  <div class="rbLabel">
                     <input type="radio" id="QUnconBleeding" name="QUnconBleeding" value="YES" required/>YES &nbsp 
                     <input type="radio" id="QUnconBleeding" name="QUnconBleeding" value="NO" required />NO
                      <br>
                      <br>
                    </div>
            </div>

            
            

        <div class="buttons" >
           <button id="b1"onclick= "location.href='contact-us.php'" type="button"><div class = "buttontext1">PREVIOUS &nbsp </div></button>
           <button id="b2" onclick= "location.href='MedicalHistory.php'" type="button" ><div class="buttontext2">NEXT</div></button>
           <script src="CCnextButton.js"></script>
         
          </div>








        </form></center>





        <footer> 
            <?php include '../header-footer/footer.php' ?>  
        </footer>
      </div>
    </body>
  </html>
