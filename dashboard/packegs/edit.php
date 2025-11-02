<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger text-center mt-3'> No package selected for editing.</div>";
    exit;
}

$id = (int) $_GET['id']; 
$query = "SELECT * FROM packegs WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div class='alert alert-warning text-center mt-3'> This package was not found in the database.</div>";
    exit;
}

// جلب كل الفنادق لعرضها في select
$hotels = mysqli_query($conn, "SELECT id, title FROM hotel");

if (isset($_POST['update_packge'])) {
    $name_packge = filterInputs($_POST['name_packge']);
    $information_room = filterInputs($_POST['information_room']);
    $periods = filterInputs($_POST['periods']);
    $accommodation_type = filterInputs($_POST['accommodation_type']);
    $Transportations = filterInputs($_POST['Transportations']);
    $price_night = (float) filterInputs($_POST['price_night']);
    $hotel_id = (int) $_POST['hotel_id'];

    // معالجة الصورة
    $imgurl = $data['imgurl']; // الصورة القديمة الافتراضية
    if (!empty($_FILES['imgurl']['name'])) {
        $targetDir = "../../dashboard/uploads/";
        $fileName = time() . '_' . basename($_FILES['imgurl']['name']);
        $targetFile = $targetDir . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['imgurl']['tmp_name'], $targetFile)) {
                // حذف الصورة القديمة إن وجدت
                if (!empty($data['imgurl']) && file_exists($targetDir . $data['imgurl'])) {
                    unlink($targetDir . $data['imgurl']);
                }
                $imgurl = $fileName;
            }
        } else {
            echo "<div class='alert alert-warning text-center mt-3'> Invalid image type. Only JPG, PNG, GIF allowed.</div>";
        }
    }

    // تحديث البيانات
    $sql = "UPDATE packegs SET 
            name_packge='$name_packge',
            information_room='$information_room',
            periods='$periods',
            accommodation_type='$accommodation_type',
            Transportations='$Transportations',
            price_night='$price_night',
            hotel_id='$hotel_id',
            imgurl='$imgurl'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center mt-3'> Package updated successfully.</div>";
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'show.php';
                }, 1500);
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'> Update failed. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Package</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center text-primary"> Edit Package</h2>

  <form method="POST" enctype="multipart/form-data" class="shadow p-4 bg-white rounded mt-4">
      <div class="mb-3">
          <label class="form-label fw-bold">Name Package:</label>
          <input type="text" name="name_packge" value="<?= htmlspecialchars($data['name_packge']) ?>" class="form-control" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Information Room:</label>
          <textarea name="information_room" class="form-control" required><?= htmlspecialchars($data['information_room']) ?></textarea>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Periods:</label>
          <input type="text" name="periods" value="<?= htmlspecialchars($data['periods']) ?>" class="form-control" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Accommodation Type:</label>
          <input type="text" name="accommodation_type" value="<?= htmlspecialchars($data['accommodation_type']) ?>" class="form-control" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Transportations:</label>
          <input type="text" name="Transportations" value="<?= htmlspecialchars($data['Transportations']) ?>" class="form-control" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Price (per Night):</label>
          <input type="number" name="price_night" step="0.01" value="<?= htmlspecialchars($data['price_night']) ?>" class="form-control" required>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Hotel:</label>
          <select name="hotel_id" class="form-select" required>
              <option value="">Select Hotel</option>
              <?php while ($h = mysqli_fetch_assoc($hotels)): ?>
                  <option value="<?= $h['id'] ?>" <?= ($h['id'] == $data['hotel_id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($h['title']) ?>
                  </option>
              <?php endwhile; ?>
          </select>
      </div>

      <div class="mb-3">
          <label class="form-label fw-bold">Package Image:</label><br>
          <?php if (!empty($data['imgurl'])): ?>
              <img src="../../dashboard/uploads/<?= htmlspecialchars($data['imgurl']) ?>" alt="Package Image" class="img-thumbnail mb-2" width="200">
          <?php endif; ?>
          <input type="file" name="imgurl" class="form-control">
      </div>

      <input type="submit" name="update_packge" value="Update Package" class="btn btn-info w-100 fw-bold">
  </form>
</div>
</body>
</html>
