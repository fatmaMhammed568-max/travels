<?php
include_once('../env.php');
include_once('../layouts/functions.php');

$sql = "SELECT * FROM hotel ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotels | Travels Toma</title>
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
      <h1 class="text-white fw-bold mb-4">Discover Your Next Adventure with Travel Toma</h1>

    
      <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
        <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required />
        <input type="date" name="date" class="form-control w-auto" required />
        <input type="number" name="people" class="form-control w-auto" placeholder="People" required />
        <button type="submit" class="btn btn-primary px-4">Search</button>
      </form>
    </div>
  </section>

 

  <section class="hotels py-5 mt-5">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold text-primary">Top Hotels</h2>
      <div class="row g-4">

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-6 col-lg-4">
              <div class="card hotel-card shadow-sm">
             
                <img src="/travels/dashboard/<?= htmlspecialchars($row['imgurl']) ?>" 
     alt="<?= htmlspecialchars($row['title']) ?>" 
     class="card-img-top">

                <div class="card-body text-center">
                  <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                  <p class="card-text text-muted"><?= htmlspecialchars($row['information_hotel']) ?></p>
                  <p class="fw-bold text-success">$<?= htmlspecialchars($row['prisenightday']) ?> / night</p>
                  <a href="details.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary w-100 mt-2">View Details</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="alert alert-warning text-center">No hotels available at the moment.</div>
        <?php endif; ?>

      </div>
    </div>
  </section>

  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
