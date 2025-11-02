<?php
include_once('../env.php');
include_once('../layouts/functions.php');

$sql = "SELECT * FROM catogries"; 
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinations | Travels Toma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h1 class="fw-bold mb-4">Discover Your Next Adventure with Travel Toma</h1>

    <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
      <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required>
      <input type="date" name="date" class="form-control w-auto">
      <input type="number" name="people" class="form-control w-auto" placeholder="People">
      <button type="submit" class="btn btn-primary px-4">Search</button>
    </form>
  </div>
</section>

<section class="py-5 mt-5 bg-light">
  <div class="container">
      <h2 class="text-center mb-5 fw-bold text-primary">Popular Destinations</h2>
  
    <div class="row g-4">

      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="col-md-4">
            <div class="card destination-card shadow-sm">
              <img src="../uploads/<?= htmlspecialchars($row['imgurl']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
              <div class="card-body text-center">
                <h5><?= htmlspecialchars($row['title']) ?></h5>
                <p><?= htmlspecialchars($row['description']) ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="alert alert-warning text-center">No destinations available right now.</div>
      <?php endif; ?>

    </div>
  </div>
</section>
<br><br>


  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
