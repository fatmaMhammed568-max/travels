<?php

session_start();

if (!isset($_SESSION['user']) ) {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../env.php');
include_once('../layouts/functions.php');

$id = intval($_GET['id'] ?? 0);

$sql = "SELECT p.*, h.title AS hotel_name 
        FROM packegs p 
        LEFT JOIN hotel h ON p.hotel_id = h.id 
        WHERE p.id = $id LIMIT 1";

$result = mysqli_query($conn, $sql);
$package = mysqli_fetch_assoc($result);

$imgurl = htmlspecialchars($package['imgurl'] ?? 'default.jpg');
$name_packge = htmlspecialchars($package['name_packge'] ?? 'Booking Details');
$destination = htmlspecialchars($package['destination'] ?? 'Not specified');
$information_room = htmlspecialchars($package['information_room'] ?? 'N/A');
$periods = htmlspecialchars($package['periods'] ?? 'N/A');
$accommodation_type = htmlspecialchars($package['accommodation_type'] ?? 'Standard');
$transportations = htmlspecialchars($package['Transportations'] ?? 'Not specified');
$price_night = htmlspecialchars($package['price_night'] ?? 'N/A');
$hotel_name = htmlspecialchars($package['hotel_name'] ?? 'N/A');
$status = htmlspecialchars($package['status'] ?? 'Available'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $name_packge ?> | Travels Toma</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/travels/front/style.css" />
  <style>
    .booking-card img { height: 300px; object-fit: cover; border-radius: 8px; }
    .booking-card .card { border-radius: 12px; }
    .badge-status { font-size: 0.9rem; }
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
        <li class="nav-item"><a class="nav-link" href="about.php">About </a></li>
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
      <h1 class="text-white fw-bold mb-4">Discover Your Next Adventure with Travel Toma</h1>

    
      <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
        <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required />
        <input type="date" name="date" class="form-control w-auto" required />
        <input type="number" name="people" class="form-control w-auto" placeholder="People" required />
        <button type="submit" class="btn btn-primary px-4">Search</button>
      </form>
    </div>
  </section>

<div class="container booking-card" style="margin-top: 120px;">
  <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">Details</h2>
  <?php if ($package): ?>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <img src="/travels/dashboard/uploads/<?= $imgurl ?>" class="card-img-top" alt="<?= $name_packge ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm p-4">
          <h3 class="card-title mb-3 text-primary"><?= $name_packge ?></h3>
          <p><strong>Booking:</strong> #TRV<?= str_pad($package['id'], 5, '0', STR_PAD_LEFT) ?></p>
          <p><strong>Destination:</strong> <?= $destination ?></p>
          <p><strong>Room Info:</strong> <?= $information_room ?></p>
          <p><strong>Period:</strong> <?= $periods ?></p>
          <p><strong>Accommodation Type:</strong> <?= $accommodation_type ?></p>
          <p><strong>Transportations:</strong> <?= $transportations ?></p>
          <p><strong>Price per Night:</strong> $<?= $price_night ?></p>
          <p><strong>Hotel Name:</strong> <?= $hotel_name ?></p>
          <p><strong>Status:</strong> <span class="badge bg-success badge-status"><?= $status ?></span></p>
          <a href="/travels/front/bookings.php?id=<?= $package['id'] ?>" class="btn btn-primary mt-3 w-100">Book Now</a>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center mt-5">No booking found for this package.</div>
  <?php endif; ?>
</div>

<footer class="text-center py-4 mt-5">
  <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
