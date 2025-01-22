<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bakisena</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="images/Bakisenalogo.png">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <!-- <a class="navbar-brand" href="index.html">SUT<span>Swift</span></a> -->
      <a class="navbar-brand" href="index.php" class="logo">
        <img src="images\Bakisena.png" alt="Logo" style="height: 85px;">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="pricing.php" class="nav-link">Prices</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
          <li class="nav-item"><a href="Login.html" class="nav-link">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text justify-content-start align-items-center">
        <div class="col-lg-6 col-md-6 ftco-animate d-flex align-items-end">
          <div class="text">
            <h1 class="mb-4">Now <span>It's easy for you</span> <span>find a parking spot</span></h1>
            <p style="font-size: 18px;">Our Smart Parking System ensures you find the best parking spots quickly and efficiently. No more circling around looking for space!</p>
            <a href="https://youtu.be/WNwm9j9Cb7M?feature=shared" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="icon-wrap popup-vimeo d-flex align-items-center mt-4">
              <div class="icon d-flex align-items-center justify-content-center">
                <span class="ion-ios-play"></span>
              </div>
              <div class="heading-title ml-5">
                <span>Easy steps for finding a parking spot</span>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col"></div>
        <div class="col-lg-4 col-md-6 mt-0 mt-md-5 d-flex">
          <form action="#" class="request-form ftco-animate">
            <h2>Find Your Parking</h2>
            <div class="form-group">
              <label for="" class="label">Pick-up location</label>
              <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
            </div>
            <div class="form-group">
              <label for="" class="label">Drop-off location</label>
              <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
            </div>
            <div class="d-flex">
              <div class="form-group mr-2">
                <label for="" class="label">Pick-up date</label>
                <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
              </div>
              <div class="form-group ml-2">
                <label for="" class="label">Drop-off date</label>
                <input type="text" class="form-control" id="book_off_date" placeholder="Date">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="label">Pick-up time</label>
              <input type="text" class="form-control" id="time_pick" placeholder="Time">
            </div>
            <div class="form-group">
              <input type="submit" value="Search Parking" class="btn btn-primary py-3 px-4">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="search-wrap-1 ftco-animate mb-5">
            <form action="#" class="search-property-1">
              <div class="row">
                <div class="col-lg align-items-end">
                  <div class="form-group">
                    <label for="#">Select Parking Type</label>
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="" class="form-control">
                          <option value="">Select Parking Type</option>
                          <option value="">Indoor</option>
                          <option value="">Outdoor</option>
                          <option value="">Covered</option>
                          <option value="">Uncovered</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg align-items-end">
                  <div class="form-group">
                    <label for="#">Select Zone</label>
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="" class="form-control">
                          <option value="">Select Zone</option>
                          <option value="">Zone A</option>
                          <option value="">Zone B</option>
                          <option value="">Zone C</option>
                          <option value="">Zone D</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg align-items-end">
                  <div class="form-group">
                    <label for="#">Select Duration</label>
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="" class="form-control">
                          <option value="">Select Duration</option>
                          <option value="">1 Hour</option>
                          <option value="">2 Hours</option>
                          <option value="">3 Hours</option>
                          <option value="">4 Hours</option>
                          <option value="">Full Day</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg align-items-end">
                  <div class="form-group">
                    <label for="#">Select Payment</label>
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="" class="form-control">
                          <option value="">Select Payment</option>
                          <option value="">Credit Card</option>
                          <option value="">Fawry</option>
                          <option value="">Vodafone Cash</option>
                          <option value="">Insta Pay</option>
                          <option value="">Cash</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg align-self-end">
                  <div class="form-group">
                    <div class="form-field">
                      <input type="submit" value="Search" class="form-control btn btn-primary">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section services-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Our Services</span>
          <h2 class="mb-2">Our Services</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-customer-support"></span></div>
                <h3 class="heading mb-0 pl-3">24/7 Parking Support</h3>
              </div>
              <p>Our support team is available round the clock to assist you with any parking-related issues.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-route"></span></div>
                <h3 class="heading mb-0 pl-3">Multiple Locations</h3>
              </div>
              <p>Find parking spots in multiple locations across the city with ease.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-online-booking"></span></div>
                <h3 class="heading mb-0 pl-3">Online Reservation</h3>
              </div>
              <p>Reserve your parking spot online and avoid last-minute hassles.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
              <div class="d-flex mb-3 align-items-center">
                <div class="icon"><span class="flaticon-rent"></span></div>
                <h3 class="heading mb-0 pl-3">Secure Parking</h3>
              </div>
              <p>Our parking spots are secure and monitored 24/7 for your safety.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container-fluid px-4">
      <div class="row justify-content-center">
        <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">What we offer</span>
          <h2 class="mb-2">Choose Your Parking Spot</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url(images/car-1.jpg);">
              <div class="price-wrap d-flex">
                <span class="rate">30 Egp</span>
                <p class="from-day">
                  <span>From</span>
                  <span>/Hour</span>
                </p>
              </div>
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0"><a href="#">Indoor Parking</a></h2>
              <span>Secure and Covered</span>
              <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-black btn-outline-black mr-1">Book now</a> <a href="#" class="btn btn-black btn-outline-black ml-1">Details</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url(images/car-2.jpg);">
              <div class="price-wrap d-flex">
                <span class="rate">20 EGP</span>
                <p class="from-day">
                  <span>From</span>
                  <span>/Hour</span>
                </p>
              </div>
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0"><a href="#">Outdoor Parking</a></h2>
              <span>Open and Convenient</span>
              <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-black btn-outline-black mr-1">Book now</a> <a href="#" class="btn btn-black btn-outline-black ml-1">Details</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url(images/car-3.jpg);">
              <div class="price-wrap d-flex">
                <span class="rate">40 EPG</span>
                <p class="from-day">
                  <span>From</span>
                  <span>/Hour</span>
                </p>
              </div>
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0"><a href="#">Covered Parking</a></h2>
              <span>Protected from Weather</span>
              <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-black btn-outline-black mr-1">Book now</a> <a href="#" class="btn btn-black btn-outline-black ml-1">Details</a></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="car-wrap ftco-animate">
            <div class="img d-flex align-items-end" style="background-image: url(images/car-4.jpg);">
              <div class="price-wrap d-flex">
                <span class="rate">15 EGP</span>
                <p class="from-day">
                  <span>From</span>
                  <span>/Hour</span>
                </p>
              </div>
            </div>
            <div class="text p-4 text-center">
              <h2 class="mb-0"><a href="#">Uncovered Parking</a></h2>
              <span>Economical and Accessible</span>
              <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-black btn-outline-black mr-1">Book now</a> <a href="#" class="btn btn-black btn-outline-black ml-1">Details</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section services-section img" style="background-image: url(images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          <span class="subheading">Work flow</span>
          <h2 class="mb-3">How it works</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
              <h3>Choose Location</h3>
              <p>Select your desired parking location from our multiple options.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-select"></span></div>
              <h3>Select Spot</h3>
              <p>Choose the parking spot that best suits your needs.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
              <h3>Book & Pay</h3>
              <p>Reserve your spot and make a secure payment online.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services services-2">
            <div class="media-body py-md-4 text-center">
              <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-review"></span></div>
              <h3>Enjoy Parking</h3>
              <p>Park your vehicle with ease and enjoy your time.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section testimony-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Testimonial</span>
          <h2 class="mb-3">Developers Team</h2>
        </div>
      </div>
      <div class="row ftco-animate">
        <div class="col-md-12">
          <div class="carousel-testimony owl-carousel ftco-owl">
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">As the Project Manager, I ensure our team delivers high-quality projects on time and within budget.</p>
                  <p class="name">Mohaned Ehab</p>
                  <span class="position">Project Manager</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img mb-4" style="background-image: url(images/person_2.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">As a Frontend Developer, I focus on creating seamless and user-friendly interfaces for our clients.</p>
                  <p class="name">Mohamed Ahmed</p>
                  <span class="position">Frontend Developer</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">As a Data Analyst, I transform raw data into actionable insights to drive decision-making.</p>
                  <p class="name">Mohamed Tarek</p>
                  <span class="position">Data Analyst</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img mb-4" style="background-image: url(images/person_4.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">As a Backend Developer, I build robust and scalable systems that power our websites and applications.</p>
                  <p class="name">Mohamed Ashraf</p>
                  <span class="position">Backend Developer</span>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="testimony-wrap text-center py-4 pb-5">
                <div class="user-img mb-4" style="background-image: url(images/person_5.jpg)">
                </div>
                <div class="text pt-4">
                  <p class="mb-4">As a Content Strategist, I craft engaging content that resonates with our audience and drives engagement.</p>
                  <p class="name">Najwa El Sayed</p>
                  <span class="position">Content Strategist</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <p class="text-center mt-4">We are the developers of this website.</p>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
        </div>
        <div class="col-md-6 wrap-about py-md-5 ftco-animate">
          <div class="heading-section mb-5 pl-md-5">
            <span class="subheading">About us</span>
            <h2 class="mb-4">Choose A Perfect Parking Spot</h2>

            <p>Our Smart Parking System ensures you find the best parking spots quickly and efficiently. No more circling around looking for space!</p>
            <p>With our advanced technology, you can reserve your parking spot online, ensuring a hassle-free experience. Our system is designed to provide you with the best parking options available.</p>
            <p><a href="#" class="btn btn-primary">Search Parking</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Blog</span>
          <h2>Recent Blog</h2>
        </div>
      </div>
      <div class="row d-flex">
        <div class="col-md-4 d-flex ftco-animate">
          <div class="blog-entry justify-content-end">
            <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
            </a>
            <div class="text pt-4">
              <div class="meta mb-3">
                <div><a href="#">July. 24, 2019</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <h3 class="heading mt-2"><a href="#">Why Smart Parking is Key for Urban Growth</a></h3>
              <p>Our Smart Parking System ensures you find the best parking spots quickly and efficiently.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex ftco-animate">
          <div class="blog-entry justify-content-end">
            <a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
            </a>
            <div class="text pt-4">
              <div class="meta mb-3">
                <div><a href="#">July. 24, 2019</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <h3 class="heading mt-2"><a href="#">The Future of Parking: Smart Solutions</a></h3>
              <p>Discover how our Smart Parking System is revolutionizing urban parking.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex ftco-animate">
          <div class="blog-entry">
            <a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
            </a>
            <div class="text pt-4">
              <div class="meta mb-3">
                <div><a href="#">July. 24, 2019</a></div>
                <div><a href="#">Admin</a></div>
                <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
              </div>
              <h3 class="heading mt-2"><a href="#">How Smart Parking Saves Time and Money</a></h3>
              <p>Learn how our system can help you save time and money with efficient parking solutions.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About Smart Parking</h2>
            <p>Our Smart Parking System ensures you find the best parking spots quickly and efficiently. No more circling around looking for space!</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Information</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Services</a></li>
              <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
              <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
              <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Customer Support</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">FAQ</a></li>
              <li><a href="#" class="py-2 d-block">Payment Option</a></li>
              <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
              <li><a href="#" class="py-2 d-block">How it works</a></li>
              <li><a href="#" class="py-2 d-block">Contact Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">6PM4+7C, Cairo Governorate Desert, Al-Sharqia Governorate 7060010</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">>+2 010 70919637</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">hesham.sakr@sut.edu.eg</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="index.php" target="_blank">Bakisena</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
</body>

</html>