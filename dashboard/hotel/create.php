<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$uploadsDir = __DIR__ . '/../uploads';
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

$errors = [];
$success = false;

if (isset($_POST['submit_hotel'])) {
    $required = ['title', 'rate', 'infomation_packeg', 'information_hotel', 'prisenightday', 'price_type', 'catogry_id'];
    foreach ($required as $r) {
        if (empty($_POST[$r]) && $_POST[$r] !== '0') {
            $errors[] = "Field '$r' is required.";
        }
    }

    if (empty($errors)) {
        $title = mysqli_real_escape_string($conn, filterInputs($_POST['title']));
        $rate = (int) filterInputs($_POST['rate']);
        $infomation_packeg = mysqli_real_escape_string($conn, filterInputs($_POST['infomation_packeg']));
        $information_hotel = mysqli_real_escape_string($conn, filterInputs($_POST['information_hotel']));
        $prisenightday = (int) filterInputs($_POST['prisenightday']); 
        $price_type = mysqli_real_escape_string($conn, filterInputs($_POST['price_type']));
        $catogry_id = (int) filterInputs($_POST['catogry_id']);

        $imgurl = '';
        if (!empty($_FILES['file']['name'])) {
            $file = $_FILES['file'];
            $allowed = ['image/jpeg', 'image/jpg', 'image/png'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            if (!in_array($mime, $allowed)) {
                $errors[] = "Unsupported image type. Only jpg, jpeg, png allowed.";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $errors[] = "Image too large (Max 2MB).";
            } else {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $newName = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $destinationRelative = 'uploads/' . $newName;
                $destinationFull = $uploadsDir . '/' . $newName;

                if (move_uploaded_file($file['tmp_name'], $destinationFull)) {
                    $imgurl = $destinationRelative;
                } else {
                    $errors[] = "Failed to upload image.";
                }
            }
        }

       if (empty($errors)) {

    $sql = "INSERT INTO `hotel` 
        (`title`, `imgurl`, `rate`, `infomation_packeg`, `information_hotel`, `prisenightday`, `price_type`, `catogry_id`)
        VALUES (
            '$title',
            '$imgurl',
            '$rate',
            '$infomation_packeg',
            '$information_hotel',
            '$prisenightday',
            '$price_type',
            '$catogry_id'
        )";

    if (mysqli_query($conn, $sql)) {
        $success = true;
    } else {
        $errors[] = "Database Error: " . mysqli_error($conn);
    }

                    echo "<div class='alert alert-success text-center mt-3' id='successMsg'>Data saved successfully.</div>";

                } else {
                    echo "<div class='alert alert-danger text-center'> Database insert error: " . mysqli_error($conn) . "</div>";
                }

            } else {
                echo "<div class='alert alert-warning text-center'> Failed to upload image.</div>";
            }
        }
    

    


$cats = [];
$resCats = $conn->query("SELECT id, title FROM catogries");
if ($resCats && $resCats->num_rows > 0) {
    while ($r = $resCats->fetch_assoc()) $cats[] = $r;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Add New Hotel</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form enctype="multipart/form-data" method="POST" class="shadow p-4 rounded bg-white">
        <div class="mb-3">
            <label class="form-label fw-bold">Title:</label>
            <input class="form-control" name="title" type="text" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Image (one to many):</label>
            <input type="file" name="file" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Rate (1 to 5):</label>
            <input class="form-control" name="rate" type="number" min="1" max="5" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Information Hotel:</label>
            <textarea class="form-control" name="information_hotel" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Infomation Packeg:</label>
            <textarea class="form-control" name="infomation_packeg" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Price:</label>
            <div class="input-group">
                <input class="form-control" name="prisenightday" type="number" step="1" min="0" placeholder="أدخل السعر" required>
                <select class="form-select" name="price_type" required>
                    <option value="Night">Night</option>
                    <option value="Day">Day</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Category:</label>
            <select name="catogry_id" class="form-control" required>
                <option value="">Select Category</option>
                <?php foreach($cats as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" class="btn btn-primary w-100" name="submit_hotel" value="Save Hotel">
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
