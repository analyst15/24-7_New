<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Favicons -->
    <link href="../assets/img/images/favicon_.png" rel="icon">
    <!--<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  

  <script>
    // Auto-fill country code and city
    window.onload = function () {
      fetch("https://ipapi.co/json/")
        .then(response => response.json())
        .then(data => {
          if (data) {
            if (data.country_calling_code) {
              document.getElementById("country_code").value = data.country_calling_code;
            }
            if (data.city) {
              document.getElementById("city").value = data.city;
            }
            if (data.country_code) {
              document.getElementById("country").value = data.country_code; // e.g. "KE"
            }

          }
        })
        .catch(error => console.warn("Geo IP failed:", error));
    };
  </script>
</head>
<body class="bg-light">

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container-fluid">

            <div class="row justify-content-center align-items-center">
                <div class="col-xl-11 d-flex align-items-center justify-content-between">
                    <a href="index.html" class="logo"><img src="../assets/img/images/Logo.png" alt=""
                            class="img-fluid"></a>


                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a class="nav-link scrollto active" href="https://24-7.co.ke/">Home</a></li>
                            <li class="dropdown"><a href="#" style="color: #34479D"><span>About</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="../Our-Team/">Our Team</a></li>
                                    <li><a href="../Our-Culture/">Our Culture</a></li>
                                    <li><a href="../Partners/">Partners</a></li>
                                    <li><a href="../CSR/">CSR</a></li>
                                    <li><a href="../Awards/">Awards</a></li>
                                    <li><a href="../Sustainability/">Sustainability</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" style="color: #34479D"><span>Services</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="../Projects/">Projects</a></li>
                                    <li><a href="../360Dept/">360 Dept</a></li>
                                    <li><a href="../Interactive/">24:7 Interactive</a></li>
                                    <li class="dropdown"><a href="#"><span>Live</span> <i
                                                class="bi bi-chevron-right"></i></a>
                                        <ul>
                                            <li><a href="../Live-Streaming/">Live Streaming</a></li>
                                            <li><a href="../Web-Casting/">Web Casting</a></li>
                                            <li><a href="../Webinar/">Webinar</a></li>
                                            <li><a href="../Video-Conference/">Video Conferencing</a></li>
                                            <li><a href="../Single-Point/">Single Point</a></li>
                                            <li><a href="../Multi-Point/">Multi Point</a></li>
                                            <li><a href="../Virtual-Conference/">Virtual Conference</a></li>
                                            <li><a href="../Radio/">Radio</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" style="color: #34479D"><span>Investment</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="../Investment/">Investment Opportunities</a></li>
                                    <li><a href="../Target-Sectors/">Target Sectors</a></li>
                                    <li><a href="../Experiential-Real-Estate/">Why Experiential Real Estates?</a></li>
                                    <li><a href="../Group-Investment-Advisory/">Group Investments Advisory</a></li>
                                    <li><a href="../Partnership/">Let's Work Together</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" style="color: #34479D"><span>Xperiences</span> <i
                                        class="bi bi-chevron-down"></i></a>
                                <ul>
                                    <li><a href="../Digital-Membership/">Digital Membership</a></li>
                                    <li><a href="../Grow-Your-Business/">Grow Your Business</a></li>
                                </ul>
                            </li>
                            <li><a class="nav-link scrollto" href="../Outreach/" style="color: #34479D">Outreach</a>
                            </li>
                        </ul>
                        <i class="bi bi-list mobile-nav-toggle" style="color: rgb(181,23,29);"></i>
                    </nav><!-- .navbar -->
                </div>
            </div>

        </div>
    </header>
            <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Checkout</h2>
                <ol>
                    <li><a href="https://24-7.co.ke/">Home</a></li>
                    <li>Checkout</li>
                </ol>
            </div>

        </div>
    </section>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <h2 class="mb-4 text-center">Checkout</h2>

      <form action="process_payment.php" method="post" class="card p-4 shadow-sm bg-white">

        <!-- Select Item -->
        <div class="mb-3">
          <label for="amount" class="form-label">Select Item</label>
          <select name="amount" id="amount" class="form-select" required>
            <optgroup label="Tickets (KES)">
              <option value="10000">Group of 5 Ticket - KES 10,000</option>
              <option value="50000">Corporate Ticket - KES 50,000</option>
              <option value="100000">Exhibition/Vendor - KES 100,000</option>
              <option value="200000">Brand Activation - KES 200,000</option>
            </optgroup>
            <optgroup label="Sponsorships (USD)">
              <option value="100000">Title Sponsorship - $100,000</option>
              <option value="50000">Presenting Sponsorship - $50,000</option>
              <option value="40000">Partnering Sponsorship - $40,000</option>
              <option value="30000">Associate Sponsorship - $30,000</option>
              <option value="20000">Supporting Sponsorship - $20,000</option>
            </optgroup>
          </select>
        </div>

        <!-- Name -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
          </div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <!-- Country -->
        <div class="mb-3">
          <label for="country" class="form-label">Country</label>
          <input type="text" name="country" id="country" class="form-control" required>
        </div>

        <!-- Country Code + Phone -->
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="country_code" class="form-label">Country Code</label>
            <input type="text" name="country_code" id="country_code" class="form-control" placeholder="+254" required>
          </div>
          <div class="col-md-8 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" id="phone" class="form-control" required>
          </div>
        </div>

        <!-- City -->
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" id="city" class="form-control" required>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="zip_code" class="form-label">Zip / Postal Code</label>
            <input type="zip_code" name="zip_code" id="zip_code" class="form-control" required>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">Proceed to Payment</button>

      </form>
    </div>
  </div>
</div>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>
                            <div>
                                <a href="https://24-7.co.ke/"><img src="..//assets/img/images/Logo.png" alt=""></a>
                            </div>
                        </h3>
                        <p>We Are 24-7 Group</p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="../Our-Culture/">Our Culture</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="../Partners/">Partners</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="../Projects/">Projects</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="../Awards/">Awards</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="../CSR/">CSR</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Let's Connect</h4>
                        <p>
                            P.O Box 105323-00101 <br>
                            Nairobi , Kenya<br>
                            <strong>Phone:</strong> +254 720 385 177<br>
                            <strong>Email:</strong> events@24-7.co.ke<br>
                        </p>

                        <div class="social-links">
                            <a href="https://twitter.com/team24_7Ent" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="https://web.facebook.com/247Exp/?ref=page_internal" class="facebook"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/24_7group/" class="instagram"><i
                                    class="bi bi-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCnb-FSm6RNqJaSqqZhIf4xw" class="instagram"><i
                                    class="bi bi-youtube"></i></a>
                            <a href="https://www.linkedin.com/company/24-7group/?viewAsMember=true" class="linkedin"><i
                                    class="bi bi-linkedin"></i></a>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-newsletter">
                        <h4>Our Newsletter</h4>
                        <p>Subscribe To Our Newsletter</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>24:7 Group</strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!--
                Designed by <a href="https://alexokeyoportfolio.netlify.app/">Alex</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>


</body>
</html>
