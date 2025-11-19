<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

if (isset($_POST['submit_packge'])) {
    if (
        !empty($_POST['name_packge']) &&
        !empty($_POST['information_room']) &&
        !empty($_POST['periods']) &&
        !empty($_POST['accommodation_type']) &&
        !empty($_POST['Transportations']) &&
        !empty($_POST['price_night']) &&
        !empty($_POST['hotel_id'])
    ) {

        $name_packge = mysqli_real_escape_string($conn, filterInputs($_POST['name_packge']));
        $information_room = mysqli_real_escape_string($conn, filterInputs($_POST['information_room']));
        $periods = mysqli_real_escape_string($conn, filterInputs($_POST['periods']));
        $accommodation_type = mysqli_real_escape_string($conn, filterInputs($_POST['accommodation_type']));
        $Transportations = mysqli_real_escape_string($conn, filterInputs($_POST['Transportations']));
        $price_night = (float) filterInputs($_POST['price_night']);
        $hotel_id = (int) filterInputs($_POST['hotel_id']);

        
        $imgurl = null;
        if (!empty($_FILES['imgurl']['name'])) {
            $target_dir = "../../dashboard/uploads/";
            $file_name = time() . '_' . basename($_FILES['imgurl']['name']);
            $target_file = $target_dir . $file_name;
            move_uploaded_file($_FILES['imgurl']['tmp_name'], $target_file);
            $imgurl = $file_name;
        }

        $sql = "INSERT INTO packegs (name_packge, information_room, periods, accommodation_type, Transportations, price_night, hotel_id, imgurl)
                VALUES ('$name_packge', '$information_room', '$periods', '$accommodation_type', '$Transportations', '$price_night', '$hotel_id', '$imgurl')";

        if (mysqli_query($conn, $sql)) {
              echo "<div class='alert alert-success text-center mt-3' id='successMsg'> Package added successfully.</div>";

        } else {
            echo "<div class='alert alert-success text-center mt-3' id='successMsg'> Database insert error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center mt-3'> Please fill all fields.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Package</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center mb-4 text-primary">Add New Package</h2>

  <div class="card shadow mx-auto" style="max-width: 700px;">
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label fw-bold">Name Package:</label>
            <input type="text" name="name_packge" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Image:</label>
            <input type="file" name="imgurl" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Information Room:</label>
            <textarea name="information_room" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Periods:</label>
            <input type="text" name="periods" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Accommodation Type:</label>
            <input type="text" name="accommodation_type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Transportations:</label>
            <input type="text" name="Transportations" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Price (per Night):</label>
            <input type="number" name="price_night" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Hotel:</label>
            <select name="hotel_id" class="form-select" required>
                <option value="">Select Hotel</option>
                <?php
                $hotels = mysqli_query($conn, "SELECT id, title FROM hotel");
                while ($h = mysqli_fetch_assoc($hotels)):
                ?>
                    <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['title']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <input type="submit" class="btn btn-info w-100 fw-bold" name="submit_packge" value="Save Package">
      </form>
    </div>
  </div>
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
