<?php
include_once('../env.php');
include_once('../layouts/functions.php');

$user_id = NULL;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $checkin = mysqli_real_escape_string($conn, $_POST['checkin']);
    $checkout = mysqli_real_escape_string($conn, $_POST['checkout']);
    $guests = (int)$_POST['guests'];
    $package_id = (int)$_POST['package']; 

    if (!empty($destination) && !empty($checkin) && !empty($checkout) && $package_id > 0) {

        $sql = "INSERT INTO reserve (user_id, packag_id, destination, check_in, check_out, guests, status)
                VALUES (NULL, '$package_id', '$destination', '$checkin', '$checkout', '$guests', 'Pending')";

        if (mysqli_query($conn, $sql)) {
            $message = "<div class='alert alert-success text-center'>Booking successful!</div>";
        } else {
            $message = "<div class='alert alert-danger text-center'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $message = "<div class='alert alert-warning text-center'>Please fill all required fields and select a valid package.</div>";
    }
}


$result = mysqli_query($conn, "SELECT r.*, p.name_packge 
                               FROM reserve r 
                               LEFT JOIN packegs p ON r.packag_id = p.id 
                               ORDER BY r.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookings | Travels Toma</title>
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

<div class="container" style="margin-top: 100px;">
  <h2 class="text-center mb-5 fw-bold text-primary">Make a Booking</h2>
  

<?php if(isset($message)) echo $message; ?>
<script>
   
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if(alert) alert.remove();
    }, 3000); 
</script>

  <div class="booking-form mb-5">
    <form method="POST">
      <div class="row g-3">
        <div class="col-md-4">
          <label for="destination" class="form-label">Destination</label>
          <input type="text" class="form-control" id="destination" name="destination" required placeholder="e.g. Paris, Dubai">
        </div>
        <div class="col-md-4">
          <label for="checkin" class="form-label">Check-in Date</label>
          <input type="date" class="form-control" id="checkin" name="checkin" required>
        </div>
        <div class="col-md-4">
          <label for="checkout" class="form-label">Check-out Date</label>
          <input type="date" class="form-control" id="checkout" name="checkout" required>
        </div>
        <div class="col-md-4">
          <label for="guests" class="form-label">Guests</label>
          <input type="number" class="form-control" id="guests" name="guests" min="1" value="1" required>
        </div>
        <div class="col-md-4">
          <label for="package" class="form-label">Package</label>
          <select id="package" name="package" class="form-select" required>
            <option value="">Choose...</option>
            <?php
            $packages = mysqli_query($conn, "SELECT id, name_packge FROM packegs");
            while($pkg = mysqli_fetch_assoc($packages)) {
                echo "<option value='".$pkg['id']."'>".$pkg['name_packge']."</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100">Book Now</button>
        </div>
      </div>
    </form>
  </div>

</div>

  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>
