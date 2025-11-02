<?php
include_once('../env.php');
include_once('../layouts/functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travels Toma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="/travels/front/style.css" />
</head>
<body>

 
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="index.php">Travels Toma</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="packages.php">Packages</a></li>
          <li class="nav-item"><a class="nav-link" href="hotels.php">Hotels</a></li>
           <li class="nav-item"><a class="nav-link" href="destinations.php">Destinations</a></li>
          <li class="nav-item"><a class="nav-link" href="/travels/dashboard/Contacts/create.php">Contact</a></li>
        </ul>
        <a href="/travels/dashboard/users/logout.php"class="btn btn-primary px-4">Logout</a>
      </div>
    </div>
  </nav>



  <section class="hero d-flex align-items-center justify-content-center text-center">
    <div class="overlay"></div>
    <div class="container position-relative">
      <h1 class="text-white fw-bold mb-4">Discover Your Next Adventure with Travel Toma</h1>

    
      <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
        <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required />
        <input type="date" name="date" class="form-control w-auto" required />
        <input type="number" name="people" class="form-control w-auto" placeholder="People" required />
        <button type="submit" class="btn btn-primary px-4">Search</button>
      </form>
    </div>
  </section>

 
  <section class="packages py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-primary">Popular Packages</h2>
     
      <div class="row g-4">

      
        <div class="col-md-4">
          <div class="card shadow">
            <img src="images/2.jpg" class="card-img-top fixed-img" alt="Package" />
            <div class="card-body">
              <h5 class="card-title">Cairo Tour</h5>
              <p class="card-text text-muted">Enjoy 3 nights in the city of history.</p>
              <p class="fw-bold text-primary">$350 / person</p>
              <a href="bookings.php" class="btn btn-outline-primary w-100">Book Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow">
            <img src="images/3.png" class="card-img-top fixed-img" alt="Package" />
            <div class="card-body">
              <h5 class="card-title">Dubai Getaway</h5>
              <p class="card-text text-muted">Luxury vacation with desert safari.</p>
              <p class="fw-bold text-primary">$500 / person</p>
              <a href="bookings.php" class="btn btn-outline-primary w-100">Book Now</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow">
            <img src="images/4.jpg" class="card-img-top fixed-img" alt="Package" />
            <div class="card-body">
              <h5 class="card-title">Paris Dream</h5>
              <p class="card-text text-muted">5 nights in the city of love.</p>
              <p class="fw-bold text-primary">$700 / person</p>
              <a href="bookings.php" class="btn btn-outline-primary w-100">Book Now</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
<br><br>


  <section class="destinations py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-primary">Top Destinations</h2>
   
      <div class="row g-4">
        <div class="col-md-4"><img src="images/5.jpg" class="img-fluid rounded hover-zoom" alt="Cairo" /></div>
        <div class="col-md-4"><img src="images/6.jpg" class="img-fluid rounded hover-zoom" alt="Dubai" /></div>
        <div class="col-md-4"><img src="images/7.jpeg" class="img-fluid rounded hover-zoom" alt="Paris" /></div>
      </div>
    </div>
  </section>


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


  
  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <button id="toTop" title="Back to Top">↑</button>

<script>
  // زر الصعود لأعلى
  const toTop = document.getElementById("toTop");
  window.onscroll = () => {
    if (window.scrollY > 300) {
      toTop.style.display = "block";
    } else {
      toTop.style.display = "none";
    }
  };
  toTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });

  // تغيير شكل النافبار عند التمرير
  window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });
</script>

</body>
</html>
