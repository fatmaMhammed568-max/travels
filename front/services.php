<?php

session_start();
if (!isset($_SESSION['user']) ) {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../env.php');
include_once('../layouts/functions.php');


$services = [
  ['icon'=>'fa-plane', 'title'=>'Flight Booking', 'desc'=>'We provide domestic and international flights at competitive prices.', 'link'=>'bookings.php'],
  ['icon'=>'fa-hotel', 'title'=>'Hotel Booking', 'desc'=>'Accommodation for all types and budgets.', 'link'=>'hotels.php'],
  ['icon'=>'fa-suitcase-rolling', 'title'=>'Travel Packages', 'desc'=>'Complete packages for a comfortable vacation.', 'link'=>'packages.php'],
  ['icon'=>'fa-shield-alt', 'title'=>'Travel Insurance', 'desc'=>'Medical coverage for safe travel.', 'link'=>'/travels/dashboard/Contacts/create.php'],
  ['icon'=>'fa-car', 'title'=>'Car Rentals', 'desc'=>'Competitive offers for rental cars.', 'link'=>'/travels/dashboard/Contacts/create.php'],
  ['icon'=>'fa-map-marked-alt', 'title'=>'Tourist Tours', 'desc'=>'Exclusive local tours and experiences.', 'link'=>'/travels/dashboard/Contacts/create.php']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Services - Travels Toma</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="/travels/front/style.css">
<style>
  .service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
  }
  .service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  .service-icon {
    font-size: 2.5rem;
    color: #0d6efd;
    margin-bottom: 1rem;
  }
  @media (max-width: 768px) {
    .hero h1 { font-size: 1.8rem; }
    .search-form { flex-direction: column; gap: 1rem !important; }
  }
</style>
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

<div class="container" style="margin-top:100px;">
  <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">Our Services</h2>

  <div class="row g-4">
    <?php foreach($services as $s): ?>
      <div class="col-md-4">
        <div class="card p-4 service-card h-100 text-center border-0 shadow-sm">
          <i class="fa <?= $s['icon'] ?> service-icon"></i>
          <h5 class="fw-bold"><?= htmlspecialchars($s['title']) ?></h5>
          <p class="text-muted"><?= htmlspecialchars($s['desc']) ?></p>
         <a href="<?= $s['link'] ?>" class="btn btn-outline-primary mt-2 w-100">Learn More</a>

        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


<footer class="text-center py-4 mt-5 border-top">
  <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
