<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | Sulit & Bagasan Dental Office</title>
  <link rel="stylesheet" type="text/css" href="styles_contact.css" />
  <style>
    <?php include '../header-footer/header-footer.css' ?>
  </style>
</head>

<body>
  <div class="wrapper">
  <?php include '../header-footer/header.php' ?>
    <div class="title">
      <div class="film"></div>
      <img class="contactImg" src="images/contactImg.png" alt="featured image: inside of the dental office" />
      <div class="contactText">CONTACT US</div>
    </div>
    <div class="APPOINTMENT-FORM-title">
      <p>APPOINTMENT FORM</p>
    </div>
    <div class="APPOINTMENT-FORM-container">
      <form action="">
        <div class="patient-information">Patient Information</div>
        <div class="input-group">
          <label for="Name">NAME</label>
          <input type="text" id="firstName" name="firstName" placeholder="First Name" required />
          <input type="text" id="lastName" name="lastName" placeholder="Last Name" required />
        </div>
        <div class="input-group">
          <label for="phone">PHONE</label>
          <input type="tel" id="phone" name="phone" placeholder="Phone Number" required />
        </div>
        <div class="input-group">
          <label for="email">EMAIL</label>
          <input type="email" id="email" name="email" placeholder="Email Address" required />
        </div>
        <div class="input-group">
          <label for="gender">GENDER</label>
          <select id="gender" name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="input-group">
          <label for="appointmentType">TYPE OF APPOINTMENT</label>
          <select id="appointmentType" name="appointmentType" required>
            <option value="" disabled selected>
              Select Appointment Type
            </option>
            <option value="checkup">Checkup</option>
            <option value="treatment">Treatment</option>
            <option value="consultation">Consultation</option>
          </select>
        </div>
        <div class="input-group">
          <label for="date">DATE</label>
          <input type="date" id="date" name="date" required />
          <label for="time">TIME</label>
          <select id="time" name="time" required>
            <option value="" disabled selected>SELECT TIME</option>
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="evening">Evening</option>
          </select>
        </div>
        <div class="button-group">
          <button type="reset">RESET INFO</button>
          <a href=""><button type="button">NEXT</button></a>
        </div>
      </form>
    </div>
    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.775095013898!2d121.00472617494823!3d14.5548499859261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c96d86c62c73%3A0xe913d861b4f9bb63!2sSulit%20%26%20Bagasan%20Dental%20Office!5e0!3m2!1sen!2sph!4v1701731077552!5m2!1sen!2sph" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="film2">
      <div class="content2">
        <p>WHERE TO FIND US</p>
      </div>
      <div class="content2-row2">
        Location: 2776 Faraday, Makati, 1234 Metro Manila<br />
        Contact No.: 0917 110 3983 / 0999 884 0454<br />
        E-mail: sulitandbagasan@gmail.com
      </div>
    </div>
    <div class="film3">
      <div class="content3">
        <p>WHEN ARE WE AVAILABLE</p>
      </div>
      <div class="content3-row3">
        <p>We are open from Monday to Sunday, 9 AM to 5 PM.</p>
        <p>
          Please call us at 0917 110 3983 / 0999 884 0454 to schedule an
          appointment.
        </p>
      </div>
    </div>
    <?php include '../header-footer/footer.php' ?>
  </div>
</body>

</html>