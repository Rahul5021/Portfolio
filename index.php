<?php
include 'include\config.php';
$sql_user = "SELECT * FROM `user` where `user`.`id` = 1";
$result_user = mysqli_query($conn, $sql_user);
$data_user = mysqli_fetch_assoc($result_user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
    <?= $data_user['name'] ?> -
    <?= $data_user['job'] ?>
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Personal
  * Updated: Jan 27 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/personal-free-resume-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script>
    function downloadCV() {
      // Replace 'your_cv_url.pdf' with the actual URL of your CV PDF file
      var cvUrl = 'RESUME General.pdf';

      // Create an anchor element
      var link = document.createElement('a');
      link.href = cvUrl;

      // Set the download attribute to force download
      link.download = 'rahul_agrawal_cv.pdf';

      // Append the anchor to the body
      document.body.appendChild(link);

      // Trigger the click event
      link.click();

      // Cleanup
      document.body.removeChild(link);
    }
  </script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <h1>
        <a href="index.php" class="mr-auto">
          <img src="assets/img/favicon.png" alt="" class="logo-img img-fluid">
          <?= $data_user['name'] ?>
        </a>
      </h1>

      <h2>I'm a passionate <span>
          <?= $data_user['job'] ?>
        </span> from
        <?= $data_user['country'] ?>
      </h2>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link active" href="#header">Home</a></li>
          <li><a class="nav-link" href="#resume">Resume</a></li>
          <li><a class="nav-link" href="#about">About</a></li>
          <li><a class="nav-link" href="#contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php
      $sql_social = "SELECT * FROM `social-media`";
      $result_social = mysqli_query($conn, $sql_social);
      ?>

      <div class="social-links">
        <?php
        if ($result_social->num_rows > 0) {
          while ($data_social = mysqli_fetch_array($result_social)) {
            ?>
            <a href="<?= $data_social['url'] ?>" class="<?= $data_social['name'] ?>" target="blank"><i
                class="bi <?= $data_social['bootstrap_icon'] ?>"></i></a>
            <?php
          }
        } else {
          echo "No Social Media";
        }
        ?>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <!-- ======= About Me ======= -->
    <div class="about-me container">

      <div class="section-title">
        <h2>About</h2>
        <p>Learn more about me</p>
      </div>

      <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
          <img src="assets/img/me.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
          <h3>
            <?= $data_user['job'] ?>
          </h3>
          <p class="fst-italic">
            <?= $data_user['slogan'] ?>
          </p>
          <div class="row">
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>
                    <?php
                    echo date('d M Y', strtotime($data_user['birthday']))
                      ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong> <span>
                    <?= $data_user['website'] ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>
                    <?= $data_user['phone'] ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>
                    <?= $data_user['city'] ?>,
                    <?= $data_user['country'] ?>
                  </span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>
                    <?= $data_user['age'] ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>
                    <?= $data_user['degree'] ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>
                    <?= $data_user['email'] ?>
                  </span></li>
                <li><i class="bi bi-chevron-right"></i> <strong>Freelance:</strong> <span>
                    <?= $data_user['freelance'] ?>
                  </span></li>
              </ul>
            </div>
          </div>
          <p>
            <?= $data_user['objective'] ?>
          </p>
        </div>
      </div>

    </div><!-- End About Me -->

    <!-- ======= Skills ======= -->
    <div class="interests container">

      <div class="section-title">
        <h2>Skills</h2>
      </div>
      <?php
      $sql_skils = "SELECT * FROM `skills`";
      $result_skills = mysqli_query($conn, $sql_skils);
      ?>
      <div class="row">
        <?php
        if ($result_skills->num_rows > 0) {
          while ($data_skill = mysqli_fetch_array($result_skills)) {
            ?>
            <div class="col-lg-3 col-md-4">
              <div class="icon-box">
                <i class="<?= $data_skill['bootstrap_icon_name'] ?>"
                  style="color: <?= $data_skill['icon_color_hex'] ?>;"></i>
                <h3>
                  <?= $data_skill['skill_name'] ?>
                </h3>
              </div>
            </div>
            <?php
          }
        } else {
          echo "Coming Soon....";
        }
        ?>
      </div>

    </div>
    <!-- End Skills -->

  </section>
  <!-- End About Section  -->

  <!-- ======= Resume Section ======= -->
  <section id="resume" class="resume">
    <div class="container">

      <div class="section-title">
        <h2>Resume</h2>
        <p>Check My Resume</p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <h3 class="resume-title">Summary</h3>
          <div class="resume-item pb-0">
            <h4>
              <?= $data_user['name'] ?>
            </h4>
            <p><em>
                <?= $data_user['objective'] ?>
              </em>
            </p>
            <p>
            <ul>
              <li>
                <?= $data_user["city"] ?>
              </li>
              <li>
                <?= $data_user["phone"] ?>
              </li>
              <li>
                <?= $data_user["email"] ?>
              </li>
            </ul>
            </p>
          </div>
          <?php
          $sql_academics = "SELECT * FROM `academics`";
          $result_academics = mysqli_query($conn, $sql_academics);

          ?>
          <h3 class="resume-title">Education</h3>
          <?php
          if ($result_academics->num_rows > 0) {
            while ($data_academics = mysqli_fetch_array($result_academics)) {
              ?>
              <div class="resume-item">
                <h4>
                  <?= $data_academics['degree_name'] ?>
                </h4>
                <h5>
                  <?= $data_academics['start_year'] ?> -
                  <?php
                  if ($data_academics['end_year'] == 0) {
                    echo "Running";
                  } else {
                    echo $data_academics['end_year'];
                  }
                  ?>
                </h5>
                <p><em>
                    <?= $data_academics['college_name'] ?>,
                    <?= $data_academics['college_city'] ?>
                  </em></p>
                <p><em>
                    <?= $data_academics['university'] ?>
                  </em></p>
                <!-- <p>
                  <?= $data_academics['objective'] ?>
                </p> -->
              </div>
              <?php
            }
          }
          ?>
          <?php
          $sql_certifications = "SELECT * FROM `certifications`";
          $result_certifications = mysqli_query($conn, $sql_certifications);
          ?>
          <div class="resume-title">Certifications</div>
          <?php
          if ($result_certifications->num_rows > 0) {
            while ($data_certification = mysqli_fetch_array($result_certifications)) { ?>
              <div class="resume-item">
                <h4>
                  <?= $data_certification["name"] ?>
                </h4>
                <h5>
                  <?= $data_certification["completion_year"] ?>
                </h5>
                <em>
                  <?= $data_certification['institution'] ?>,
                  <?= $data_certification['duration'] ?> (
                  <?= $data_certification['learning_mode'] ?>)
                </em>
                <!-- <ul>
                <?php
                $description_lines = explode("\n", $data_certification['description']);
                foreach ($description_lines as $line) {
                  $line = trim($line);
                  if (!empty($line)) {
                    ?>
                    <li><?= $line ?></li>
                    <?php
                  }
                }
                ?>
              </ul> -->
              </div>
              <?php
            }
          }
          ?>
        </div>
        <div class="col-lg-6">
          <?php
          $sql_projects = 'SELECT * FROM `projects`';
          $result_projects = mysqli_query($conn, $sql_projects);
          ?>
          <h3 class="resume-title">Projects</h3>
          <?php
          if ($result_projects->num_rows > 0) {
            while ($data_project = mysqli_fetch_array($result_projects)) {
              ?>
              <div class="resume-item">
                <h4>
                  <?= $data_project['title'] ?>
                </h4>
                <h5>
                  <?php
                  if ($data_project['year'] == 0) {
                    echo "Running";
                  } else {
                    echo $data_project['year'];
                  }
                  ?>
                </h5> <em>
                  <?= $data_project['type'] ?>
                </em>
                <p><em><a href="<?= $data_project['url'] ?>" target="blank">Visit Here...</a></em></p>
                <p>
                <ul>
                  <?php
                  $description_lines = explode("\n", $data_project['description']);
                  foreach ($description_lines as $line) {
                    $line = trim($line);
                    if (!empty($line)) {
                      ?>
                      <li>
                        <?= $line ?>
                      </li>
                      <?php
                    }
                  }
                  ?>
                </ul>
                </p>
              </div>
              <?php
            }
          }
          ?>
          <?php
          $sql_profession = 'SELECT * FROM `profession`';
          $result_profession = mysqli_query($conn, $sql_profession);
          ?>
          <h3 class="resume-title">Professional Experiences</h3>
          <?php
          if ($result_profession->num_rows > 0) {
            while ($data_profession = mysqli_fetch_array($result_profession)) {
              ?>
              <div class="resume-item">
                <h4>
                  <?= $data_profession['position'] ?>
                  <?= $data_profession['job_title'] ?>
                </h4>
                <h5>
                  <?= $data_profession['start_year'] ?> -
                  <?php
                  if ($data_profession['end_year'] == 0) {
                    echo "Running";
                  } else {
                    echo $data_profession['end_year'];
                  }
                  ?>
                </h5>
                <p><em>
                    <?= $data_profession['company_name'] ?>,
                    <?= $data_profession['address'] ?>
                  </em></p>
                <p>
                <ul>
                  <?php
                  $description_lines = explode("\n", $data_profession['job_description']);
                  foreach ($description_lines as $line) {
                    $line = trim($line);
                    if (!empty($line)) {
                      ?>
                      <li>
                        <?= $line ?>
                      </li>
                      <?php
                    }
                  }
                  ?>
                </ul>
                </p>
              </div>
              <?php
            }
          }
          ?>
        </div>

      </div>
      <div class="text-center mt-3"><button type="submit" name="send_message" onclick="downloadCV()"><i
            class="bi bi-download"></i>Download
          Resume</button></div>
    </div>
  </section><!-- End Resume Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Contact Me</p>
      </div>

      <div class="row mt-2">

        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-map"></i>
            <h3>My Address</h3>
            <p>
              <?= $data_user['city'] ?> -
              <?= $data_user['ward'] ?>,
              <?= $data_user['tole'] ?>,
              <?= $data_user['district'] ?>,
              <?= $data_user['zip_code'] ?>
              (
              <?= $data_user['country'] ?>)
            </p>
          </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-share-alt"></i>
            <h3>Social Profiles</h3>
            <?php
            $sql_social_contact = "SELECT * FROM `social-media`";
            $result_social_contact = mysqli_query($conn, $sql_social);
            ?>
            <div class="social-links">
              <?php
              if ($result_social_contact->num_rows > 0) {
                while ($data_social_contact = mysqli_fetch_array($result_social_contact)) {
                  ?>
                  <a href="<?= $data_social_contact['url'] ?>" class="<?= $data_social_contact['name'] ?>" target="blank"><i
                      class="bi <?= $data_social_contact['bootstrap_icon'] ?>"></i></a>
                  <?php
                }
              } else {
                echo "No Social Media";
              }
              ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-envelope"></i>
            <h3>Email Me</h3>
            <p>
              <?= $data_user['email'] ?>
            </p>
          </div>
        </div>
        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Call Me</h3>
            <p>
              <?= $data_user['phone'] ?>
            </p>
          </div>
        </div>
      </div>
      <?php
      if (isset($_POST['send_message'])) {
        echo "SERVER STARTED";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $contact = "INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";
        $result = mysqli_query($conn, $contact);
        if (!$result)
          die("Error in SQL query");
      }
      ?>
      <form action="#" method="post" class="contact-form mt-4">
        <div class="row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
        </div>
        <div class="text-center mt-3"><button type="submit" name="send_message">Send Message</button></div>
      </form>

    </div>
  </section><!-- End Contact Section -->

  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/personal-free-resume-bootstrap-template/ -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>