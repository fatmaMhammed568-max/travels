<?php
include_once('../env.php');
include_once('../layouts/functions.php');

$res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM reserve");
$tripsCount = 0;
if ($res && $row = mysqli_fetch_assoc($res)) $tripsCount = (int)$row['cnt'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Travels Toma</title>
 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="/travels/front/style.css" />
  
</head>
<body>


<nav class="navbar navbar-expand-lg main-navbar fixed-top">
<div class="container">
  <a class="navbar-brand fw-bold" href="index.php">
    <i class="fa-solid fa-plane-departure me-1"></i> Travels Toma
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navMenu">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="packages.php">Packages</a></li>
      <li class="nav-item"><a class="nav-link" href="hotels.php">Hotels</a></li>
      <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
      <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
      <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
      <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
      <li class="nav-item"><a class="nav-link" href="/travels/dashboard/Contacts/create.php">Contact</a></li>
    </ul>
    <a href="/travels/dashboard/users/logout.php" class="btn btn-primary rounded-pill px-4">Logout</a>
  </div>
</div>
</nav>


  <section class="hero d-flex align-items-center justify-content-center text-center">
    <div class="overlay"></div>
    <div class="container position-relative">
      <h1 class="text-white fw-bold mb-4">
        Discover Your Next Adventure with Travels Toma
      </h1>

      <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
        <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required />
        <input type="date" name="date" class="form-control w-auto" required />
        <input type="number" name="people" class="form-control w-auto" placeholder="People" required />
        <button type="submit" class="btn btn-primary px-4">Search</button>
      </form>
    </div>
  </section>


<div class="container py-5" style="margin-top:100px;">
  <div class="row align-items-center mb-5">
    <div class="col-md-6">
      <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">About Travels Toma</h2>
 
      <p>We are a travel company specialized in providing travel packages, flight & hotel bookings, and organizing memorable trips inside and outside Egypt.</p>
      <ul>
        <li><strong>What We Offer:</strong> Flight booking, Hotels, Packages, Travel Insurance, Car Rentals.</li>
        <li><strong>Why Choose Us:</strong> Competitive Prices — 24/7 Customer Support — Customized Packages.</li>
      </ul>
      <div class="mt-3">
        <span class="me-3"><strong>Total Bookings Completed:</strong> <?= $tripsCount ?></span>
      </div>
    </div>
    <div class="col-md-6 text-center">
      <img src="images/2.jpg" alt="About" class="img-fluid" style="max-height:300px;">
    </div>
  </div>


  <div class="row g-3 mb-5">
    <div class="col-md-3">
      <div class="card card-feature p-3 h-100 shadow-sm">
        <h5>Our Mission</h5>
        <p>Deliver safe and enjoyable travel experiences at fair prices.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-feature p-3 h-100 shadow-sm">
        <h5>Our Vision</h5>
        <p>To be the first choice for travelers in the region.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-feature p-3 h-100 shadow-sm">
        <h5>Our Team</h5>
        <p>Professional team with expertise in tourism and travel.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card card-feature p-3 h-100 shadow-sm">
        <h5>Our Advantages</h5>
        <ul class="mb-0">
          <li>24/7 Support</li>
          <li>Flexible Payment Options</li>
          <li>Travel Insurance Service</li>
        </ul>
      </div>
    </div>
  </div>


  <h3 class="mb-4">Meet Our Team</h3>
  <div class="row g-4">
    <div class="col-md-3 text-center">
      <img src="images/1.png" class="rounded-circle mb-2" width="120" height="120" alt="">
      <h6>Dr. Mohamed</h6>
      <small>CEO</small>
    </div>
    <div class="col-md-3 text-center">
      <img src="images/3.png" class="rounded-circle mb-2" width="120" height="120" alt="">
      <h6>Sarah</h6>
      <small>Operations Manager</small>
    </div>
    <div class="col-md-3 text-center">
      <img src="images/4.jpg" class="rounded-circle mb-2" width="120" height="120" alt="">
      <h6>Omar</h6>
      <small>Marketing Head</small>
    </div>
    <div class="col-md-3 text-center">
      <img src="images/5.jpg" class="rounded-circle mb-2" width="120" height="120" alt="">
      <h6>Lina</h6>
      <small>Travel Consultant</small>
    </div>
  </div>

</div>


  <section class="testimonials py-5">
    <div class="container text-center">
      <h2 class="mb-5 fw-bold">What Our Customers Say</h2>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <h6 class="fw-bold">Sarah Ahmed</h6>
            <p class="lead">“Amazing service! My Egypt trip was perfect.”</p>
          </div>
          <div class="carousel-item">
            <h6 class="fw-bold">Omar Khaled</h6>
            <p class="lead">“Beautiful experience and great support team.”</p>
          </div>
          <div class="carousel-item">
            <h6 class="fw-bold">Lina Youssef</h6>
            <p class="lead">“The best travel website I’ve used!”</p>
          </div>
        </div>
      </div>
    </div>
  </section>



<footer class="text-center py-4 mt-5 border-top">
  <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($conn); ?>
