
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("<div class='alert alert-danger text-center mt-3'>Invalid Reserve ID.</div>");
}

$res = mysqli_query($conn, "SELECT * FROM reserve WHERE id=$id");

if (!$res || mysqli_num_rows($res) == 0) {
    die("<div class='alert alert-success text-center mt-3' id='successMsg'>Reserve not found.</div>");
}

$data = mysqli_fetch_assoc($res);

if (isset($_POST['update_reserve'])) {

    $destination = trim($_POST['destination']);
    $check_in    = trim($_POST['check_in']);
    $check_out   = trim($_POST['check_out']);
    $guests      = trim($_POST['guests']);
    $package     = trim($_POST['package_type']);
    $status      = trim($_POST['status']);

    $sql = "UPDATE reserve 
            SET destination='$destination',
                check_in='$check_in',
                check_out='$check_out',
                guests='$guests',
                package_type='$package',
                status='$status'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $success = "Reserve updated successfully.";
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Reserve</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h3 class="text-primary mb-4">Edit Reserve</h3>

    <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" class="shadow p-4 rounded bg-white">

        <label class="fw-bold mb-1">Destination</label>
        <input name="destination" class="form-control mb-3" value="<?= $data['destination'] ?>">

        <label class="fw-bold mb-1">Check-in</label>
        <input type="date" name="check_in" class="form-control mb-3" value="<?= $data['check_in'] ?>">

        <label class="fw-bold mb-1">Check-out</label>
        <input type="date" name="check_out" class="form-control mb-3" value="<?= $data['check_out'] ?>">

        <label class="fw-bold mb-1">Guests</label>
        <input type="number" name="guests" class="form-control mb-3" value="<?= $data['guests'] ?>">

        <label class="fw-bold mb-1">Package</label>
        <input name="package_type" class="form-control mb-3" value="<?= $data['package_type'] ?>">

        <label class="fw-bold mb-1">Status</label>
        <select name="status" class="form-control mb-3">
            <option <?= $data['status']=='Pending' ? 'selected':'' ?>>Pending</option>
            <option <?= $data['status']=='Confirmed' ? 'selected':'' ?>>Confirmed</option>
            <option <?= $data['status']=='Cancelled' ? 'selected':'' ?>>Cancelled</option>
        </select>

        <button class="btn btn-primary w-100" name="update_reserve">Update Reserve</button>

    </form>

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

<?php mysqli_close($conn); ?>
