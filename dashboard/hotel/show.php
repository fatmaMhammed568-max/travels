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
    $delete = "DELETE FROM `hotel` WHERE `id`=$id";
    if (mysqli_query($conn, $delete)) {
        echo "<div class='alert alert-success text-center'> Hotel deleted successfully</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Failed to delete hotel</div>";
    }
}

$sql = "SELECT h.*, c.title AS category_name 
        FROM hotel h 
        LEFT JOIN catogries c ON h.catogry_id = c.id";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotels List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        h2 { text-align: center; margin-top: 40px; color: #0d6efd; font-weight: 600; }
        .container { margin-top: 30px; }
        table { border-radius: 15px; overflow: hidden; background: #fff; }
        .table thead { background-color: #0d6efd; color: white; font-weight: 500; }
        .table td img { border-radius: 8px; object-fit: cover; }
        .btn { border-radius: 25px; padding: 5px 15px; }
        .btn-edit { background-color: #ffc107; color: #212529; }
        .btn-edit:hover { background-color: #e0a800; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-delete:hover { background-color: #bb2d3b; }
        .btn-add { background-color: #198754; color: white; border-radius: 30px; }
        .btn-add:hover { background-color: #157347; }
    </style>
</head>
<body>

<div class="container">
    <h2> Hotels List</h2>

    <div class="text-end my-3">
        <a href="./create.php" class="btn btn-add"> Add New Hotel</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image (one to many)</th>
                    <th>Rate</th>
                    <th>Information Packeg</th>
                    <th>Information Hotel</th>
                    <th>Price (Night/Day)</th>
                    <th>Category</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td>
                                <?php if (!empty($row['imgurl'])): ?>
                                    <img src="../<?= htmlspecialchars($row['imgurl']) ?>" width="100" height="70" alt="Hotel Image">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['rate']) ?>/5</td>
                            <td><?= htmlspecialchars($row['infomation_packeg']) ?></td>
                            <td><?= htmlspecialchars($row['information_hotel']) ?></td>
                            <td><?= htmlspecialchars($row['prisenightday']) ?> $</td>
                            <td><?= htmlspecialchars($row['category_name'] ?? 'Unknown') ?></td>
                            <td><a class="btn btn-edit btn-sm" href="./edit.php?id=<?= $row['id'] ?>">Edit</a></td>
                            <td><a class="btn btn-delete btn-sm" href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this hotel?')">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="10" class="text-muted text-center py-3">No hotels available yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

<?php mysqli_close($conn); ?>
