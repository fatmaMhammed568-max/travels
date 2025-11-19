<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../env.php');
include_once('../layouts/functions.php');

$faqs = [
  ['q'=>'How do I book?', 'a'=>'Go to the booking page, choose your destination, and pay online or select pay on arrival.'],
  ['q'=>'Payment methods?', 'a'=>'Credit cards, Fawry, Bank transfer, or cash at branch.'],
  ['q'=>'Can I cancel my booking?', 'a'=>'Yes, subject to terms which may vary by package — check the cancellation policy for each package.'],
  ['q'=>'Are the prices including taxes?', 'a'=>'Prices are usually shown before taxes; they will be clarified during payment.']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ - Travels Toma</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/travels/front/style.css">

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
      <h1 class="text-white fw-bold mb-4">Discover Your Next Adventure with Travel Toma</h1>

    
      <form action="search.php" method="GET" class="search-form p-3 bg-white rounded shadow-lg d-flex flex-wrap justify-content-center gap-3">
        <input type="text" name="destination" class="form-control w-auto" placeholder="Destination" required />
        <input type="date" name="date" class="form-control w-auto" required />
        <input type="number" name="people" class="form-control w-auto" placeholder="People" required />
        <button type="submit" class="btn btn-primary px-4">Search</button>
      </form>
    </div>
  </section>

 


<div class="container py-5">
  
      <div class="row g-4">
 <h2 class="text-center mb-5 fw-bold text-primary" style="color:#0d6efd !important; text-align:center;">FAQs - Your Questions Answered</h2>
     
  <div class="accordion" id="faqAccordion">
    <?php foreach($faqs as $i=>$f): ?>
      <div class="accordion-item mb-2">
        <h2 class="accordion-header" id="heading<?= $i ?>">
          <button class="accordion-button <?= $i? 'collapsed':'' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>">
            <i class="bi bi-question-circle"></i> <?= htmlspecialchars($f['q']) ?>
          </button>
        </h2>
        <div id="collapse<?= $i ?>" class="accordion-collapse collapse <?= $i? '':'show' ?>" data-bs-parent="#faqAccordion">
          <div class="accordion-body"><?= htmlspecialchars($f['a']) ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


 <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

  document.querySelectorAll('.accordion-collapse').forEach(item => {
    item.addEventListener('show.bs.collapse', e => {
      e.target.style.transition = 'height 0.35s ease';
    });
  });
</script>

</body>
</html>
<?php mysqli_close($conn); ?>
