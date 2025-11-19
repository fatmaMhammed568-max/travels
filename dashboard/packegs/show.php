<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');


if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    
    $getImg = mysqli_query($conn, "SELECT imgurl FROM packegs WHERE id = $id");
    $imgData = mysqli_fetch_assoc($getImg);

    $delete = "DELETE FROM packegs WHERE id = $id";
    if (mysqli_query($conn, $delete)) {
        
        if (!empty($imgData['imgurl']) && file_exists("../../dashboard/uploads/" . $imgData['imgurl'])) {
            unlink("../../dashboard/uploads/" . $imgData['imgurl']);
        }
        echo "<div class='alert alert-success text-center mt-3' id='successMsg'>Package deleted successfully</div>";
    } else {
        echo "<div class='alert alert-success text-center mt-3' id='successMsg'>Failed to delete package</div>";
    }
}

$sql = "SELECT p.*, h.title AS hotel_name 
        FROM packegs p 
        LEFT JOIN hotel h ON p.hotel_id = h.id
        ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Packages List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center text-primary mb-4">Packages List</h2>

  <div class="text-end mb-3">
      <a href="./create.php" class="btn btn-success fw-bold">+ Add New Package</a>
  </div>

  <table class="table table-bordered text-center align-middle shadow-sm">
      <thead class="table-primary">
          <tr>
              <th>#</th>
              <th>Image</th>
              <th>Name</th>
              <th>Information</th>
              <th>Periods</th>
              <th>Accommodation</th>
              <th>Transportations</th>
              <th>Price / Night</th>
              <th>Hotel</th>
              <th colspan="2">Actions</th>
          </tr>
      </thead>
      <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                  <td><?= $row['id'] ?></td>

                
                  <td>
                    <?php if (!empty($row['imgurl']) && file_exists("../../dashboard/uploads/" . $row['imgurl'])): ?>
                        <img src="../../dashboard/uploads/<?= htmlspecialchars($row['imgurl']) ?>" alt="Package Image" width="100" height="70" class="rounded shadow-sm">
                    <?php else: ?>
                        <img src="../../dashboard/uploads/no-image.jpg" alt="No image" width="100" height="70" class="rounded shadow-sm">
                    <?php endif; ?>
                  </td>

                  <td><?= htmlspecialchars($row['name_packge']) ?></td>
                  <td><?= htmlspecialchars($row['information_room']) ?></td>
                  <td><?= htmlspecialchars($row['periods']) ?></td>
                  <td><?= htmlspecialchars($row['accommodation_type']) ?></td>
                  <td><?= htmlspecialchars($row['Transportations']) ?></td>
                  <td><?= htmlspecialchars($row['price_night']) ?> EGP</td>
                  <td><?= htmlspecialchars($row['hotel_name'] ?? 'Not Assigned') ?></td>

                  <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm fw-bold">Edit</a>
                  </td>
                  <td>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="btn btn-danger btn-sm fw-bold">Delete</a>
                  </td>
              </tr>
          <?php endwhile; ?>
      <?php else: ?>
          <tr>
              <td colspan="11" class="text-muted text-center">No packages available yet.</td>
          </tr>
      <?php endif; ?>
      </tbody>
  </table>
</div>
<script>
  // الرسالة تختفي بعد 3 ثواني
  setTimeout(function() {
    const msg = document.getElementById('successMsg');
    if (msg) {
      msg.style.transition = "0.5s";
      msg.style.opacity = "0";
    }
  }, 3000);
</script>
</body>
</html>
