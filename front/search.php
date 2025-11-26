<?php
session_start();

if (!isset($_SESSION['user']) ) {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../env.php');
include_once('../layouts/functions.php');

$destination = $_GET['destination'] ?? '';
$date = $_GET['date'] ?? ''; 
$people = $_GET['people'] ?? '';

if ($destination && $date && $people) {

    $query = "SELECT * FROM packegs 
              WHERE destination LIKE '%$destination%'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container mt-5'>
                <h3 class='mb-4 text-center text-success'>Search Results:</h3>
                <div class='row g-4'>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='col-md-4'>
              <div class='card shadow-sm border-0'>
                <img src='{$row['imgurl']}' class='card-img-top' alt='{$row['name_packge']}' style='height:220px; object-fit:cover;'>
                <div class='card-body'>
                  <h5 class='card-title text-primary'>{$row['name_packge']}</h5>
                  <p class='card-text'><strong>Destination:</strong> {$row['destination']}</p>
                  <p class='card-text'><strong>Accommodation Type:</strong> {$row['accommodation_type']}</p>
                  <p class='card-text'><strong>Transportations:</strong> {$row['Transportations']}</p>
                  <p class='card-text'><strong>Duration:</strong> {$row['periods']}</p>
                  <p class='card-text'><strong>Price per Night:</strong> {$row['price_night']} EGP</p>
                  <a href='bookings.php?packag_id={$row['id']}' class='btn btn-primary w-100'>Book Now</a>
                </div>
              </div>
            </div>";
        }

        echo "</div></div>";
    } else {
        echo "<div class='alert alert-warning text-center mt-5'>No results found for your search.</div>";
    }

} else {
    echo "<div class='alert alert-danger text-center mt-5'>Please enter all required search fields.</div>";
}
?>
