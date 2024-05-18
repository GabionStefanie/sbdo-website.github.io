<!DOCTYPE html>
<html lang="eng">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Check-up Services</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" type="text/css" href="stylesheet-services1.css" />
  <style>
    <?php include '../header-footer/header-footer.css' ?>
  </style>
</head>

<body>
  <div class="wrapper">
    <?php include '../header-footer/header.php' ?>
    <div class="servicesBG">
      <img class="servicesImg" src="images/Services_Banner.png" alt="dentist checking patient's teeth" />
      <div class="servicesText">OUR SERVICES</div>
    </div>

    <div class="flex-row1">
      <div class="service-box">
        <img class="icon" src="images/CHECK-UP.png" alt="check up logo: tooth with magnifying glass" />

        <div class="service-content">
          <h1 class="service-name">CHECK-UP</h1>
          <ul class="service-list">
            <li class="list-text">General Check-up</li>
            <p class="text">
              A general check-up is part of a checkup of your teeth and gums.
              It allows your dentist to see if you have any dental problems
              and helps you keep your teeth and gums healthy and maintains
              your oral health.
            </p>
            <li class="list-text">Panoramic X-ray</li>
            <p class="text">
              A panoramic radiograph is a panoramic scanning dental X-ray of
              the upper and lower jaw. It shows a two-dimensional view of a
              half-circle from ear to ear. Panoramic dental x-ray uses a very
              small dose of ionizing radiation to capture the entire mouth in
              one image. It is commonly performed by dentists and oral
              surgeons in everyday practice and may be used to plan treatment
              for dentures, braces, extractions and implants.
            </p>
            <li class="list-text">Periapical X-ray</li>
            <p class="text">
              A Periapical X-ray shows your entire tooth, from the crown to
              the root tip. This type of X-ray helps your dentist detect
              decay, gum disease, bone loss and any other abnormalities of
              your tooth or surrounding bone. It is a very commonly used
              diagnostic measure. This can be used for any tooth in the mouth
              and it is mostly used to determine the depth of the decay and if
              the tooth needs endodontic therapy, if there are any periapical
              changes, impacted teeth, cysts and more.
            </p>
          </ul>
        </div>
      </div>
    </div>

    <div class="flex-row2">
      <a href="../services-page/services.php" class="learn_more_link"> RETURN TO LIST </a>

      <a href="services2.php" class="learn_more_link"> NEXT SERVICE </a>
    </div>
    <?php include '../header-footer/footer.php' ?>
  </div>
</body>

</html>