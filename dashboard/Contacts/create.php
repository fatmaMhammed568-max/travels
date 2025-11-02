<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');


if (isset($_POST['submit_user'])) {

    $name   = mysqli_real_escape_string($conn, filterInputs($_POST['name'] ?? ''));
    $email  = mysqli_real_escape_string($conn, filterInputs($_POST['email'] ?? ''));
    $message  = mysqli_real_escape_string($conn, filterInputs($_POST['message'] ?? ''));



    if (empty($name) || empty($email) || empty($message) ) {
        echo "<div class='alert alert-warning text-center mt-3'> Please fill all fields.</div>";
    } else {
      
        $sql = "INSERT INTO `contacts` (`name`, `email`, `message`) 
                VALUES ('$name', '$email', '$message')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center mt-3'> User added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center mt-3'> Database error: " . mysqli_error($conn) . "</div>";
        }
    }
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Contact</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/travels/front/style.css" />
</head>
<body>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold text-primary" href="/travels/front/index.php">Travels Toma</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="/travels/front/index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/travels/front/packages.php">Packages</a></li>
          <li class="nav-item"><a class="nav-link" href="/travels/front/hotels.php">Hotels</a></li>
           <li class="nav-item"><a class="nav-link" href="/travels/front/destinations.php">Destinations</a></li>
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

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Add New Contact</h2>

    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Message:</label>
                    <textarea class='form-control' name='message' placeholder='Enter Message' required></textarea>
                </div>

                <button class="btn btn-primary w-100 fw-bold" name="submit_user" type="submit">Save Contact</button>
            </form>
        </div>
    </div>
</div>

  <footer class="text-center py-4">
    <p class="mb-0">&copy; 2025 Travels Toma | All Rights Reserved</p>
  </footer>
  
</body>
</html>
