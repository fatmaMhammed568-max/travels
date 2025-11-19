<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../env.php');
include_once('../layouts/functions.php');
$packages_res = mysqli_query($conn, "SELECT * FROM packegs ORDER BY id DESC LIMIT 6");
$post_res = mysqli_query($conn, "SELECT * FROM posts ORDER BY published_at DESC LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travels Toma</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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

 

<section class="packages py-5">
<div class="container">
   <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">Popular Packages</h2>
      <div class="row g-4">

<div class="row g-4">
<?php if($packages_res && mysqli_num_rows($packages_res)>0): ?>
  <?php while($pkg = mysqli_fetch_assoc($packages_res)): ?>
    <div class="col-md-4">
      <div class="card shadow h-100 rounded-4 overflow-hidden">
        <img src="/travels/dashboard/uploads/<?= htmlspecialchars($pkg['imgurl'] ?? 'no-image.jpg') ?>" class="card-img-top" style="height:250px; object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title text-primary fw-bold"><?= htmlspecialchars($pkg['name_packge']) ?></h5>
          <p class="text-muted"><?= htmlspecialchars($pkg['information_room']) ?></p>
          <p class="fw-bold text-primary">Price: <?= htmlspecialchars($pkg['price_night']) ?> EGP / night</p>
          <a href="bookings.php?packag_id=<?= $pkg['id'] ?>" class="btn btn-outline-primary w-100">Book Now</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php else: ?>
  <p class="text-center text-muted">No packages available right now.</p>
<?php endif; ?>
</div>
</div>
</section>


<section class="blog py-5 bg-light">
<div class="container">
   <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">Latest Blog Posts</h2>
     
      <div class="row g-4">

<div class="row">
<?php if ($post_res && mysqli_num_rows($post_res) > 0): ?>
  <?php while($post = mysqli_fetch_assoc($post_res)): ?>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
        <?php if (!empty($post['featured_image'])): ?>
          <img src="<?= str_replace('../../', '/travels/', $post['featured_image']) ?>" class="card-img-top" style="height:200px; object-fit:cover;">
        <?php else: ?>
          <img src="/travels/dashboard/uploads/no-image.jpg" class="card-img-top" style="height:200px; object-fit:cover;">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title fw-bold"><?= htmlspecialchars($post['title']) ?></h5>
          <p class="text-muted small"><?= substr(strip_tags($post['content']), 0, 120)."..." ?></p>
          <a href="about.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-primary">Read More</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
<?php else: ?>
  <p class="text-center text-muted">No blog posts yet.</p>
<?php endif; ?>
</div>
</div>
</section>
  <section class="destinations py-5 bg-light">
    <div class="container">
       <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">Top Destinations</h2>

   
      <div class="row g-4">
        <div class="col-md-4"><img src="images/5.jpg" class="img-fluid rounded hover-zoom" alt="Cairo" /></div>
        <div class="col-md-4"><img src="images/6.jpg" class="img-fluid rounded hover-zoom" alt="Dubai" /></div>
        <div class="col-md-4"><img src="images/7.jpeg" class="img-fluid rounded hover-zoom" alt="Paris" /></div>
      </div>
    </div>
  </section>



  
  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <button id="toTop" title="Back to Top">↑</button>

<script>
  
  const toTop = document.getElementById("toTop");
  window.onscroll = () => {
    if (window.scrollY > 300) {
      toTop.style.display = "block";
    } else {
      toTop.style.display = "none";
    }
  };
  toTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });

  
  window.addEventListener("scroll", function() {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 50);
  });
</script>

</body>
</html>
