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
    $del_id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM reserve WHERE id=$del_id");
    header("Location: reserve.php");
    exit;
}


$sql_reserve = "SELECT * FROM reserve ORDER BY check_in DESC";
$result_reserve = mysqli_query($conn, $sql_reserve);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reserve | Travels Toma</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; padding-top: 70px; }
.table-primary { background-color: #0d6efd !important; color: white; }
.btn-rounded { border-radius: 25px; }
</style>
</head>
<body>

<div class="container">

  <div class="card p-4 shadow-sm mt-4">
    <h4 class="mb-3 text-primary">Reserve</h4>

    <div class="text-end mb-3">
      <a href="/travels/front/bookings.php" class="btn btn-success btn-rounded"> Add New Reserve </a>
    </div>

    <div class="table-responsive">
      <table class="table table-striped align-middle shadow-sm">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>Destination</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Guests</th>
            <th>Package</th>
            <th>Status</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>

        <tbody>

          <?php if ($result_reserve && mysqli_num_rows($result_reserve) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result_reserve)): ?>
              
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['destination']) ?></td>
                <td><?= htmlspecialchars($row['check_in']) ?></td>
                <td><?= htmlspecialchars($row['check_out']) ?></td>
                <td><?= htmlspecialchars($row['guests']) ?></td>
                <td><?= htmlspecialchars($row['package_type']) ?></td>
                
                <td>
                  <span class="badge <?= $row['status'] == 'Confirmed' ? 'bg-success' : 'bg-warning' ?>">
                    <?= htmlspecialchars($row['status']) ?>
                  </span>
                </td>

                <td>
                  <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm text-white btn-rounded">
                    Edit
                  </a>
                </td>

                <td>
                  <a href="?delete=<?= $row['id'] ?>"
                     onclick="return confirm('Are you sure you want to delete this reserve?')"
                     class="btn btn-danger btn-sm btn-rounded">
                     Delete
                  </a>
                </td>
              </tr>

            <?php endwhile; ?>

          <?php else: ?>
            <tr>
              <td colspan="9" class="text-center text-muted">No Reserve yet.</td>
            </tr>
          <?php endif; ?>

        </tbody>

      </table>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php mysqli_close($conn); ?>
