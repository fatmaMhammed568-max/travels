<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location:/travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$id = $_GET['id'] ?? 0;
$data = [];

if ($id) {
    $select = "SELECT * FROM `hotel` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        die("<div class='alert alert-danger text-center mt-5'>Hotel not found</div>");
    }
}


$categories = mysqli_query($conn, "SELECT * FROM catogries");

if (isset($_POST['submit_hotel'])) {
    $title = filterInputs($_POST['title']);
    $rate = filterInputs($_POST['rate']);
    $information_hotel = filterInputs($_POST['information_hotel']);
    $infomation_packeg = filterInputs($_POST['infomation_packeg']);
    $prisenightday = filterInputs($_POST['prisenightday']);
    $catogry_id = (int)$_POST['catogry_id'];

    $check_cat = mysqli_query($conn, "SELECT id FROM catogries WHERE id=$catogry_id");
    if (mysqli_num_rows($check_cat) === 0) {
        $error_msg = "Selected category does not exist!";
    } else {
        $imgurl = $_POST['old_image'];
        if (!empty($_FILES['file']['name'])) {
            $imgurl = 'uploads/' . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], '../' . $imgurl);
        }

        $sql = "UPDATE hotel SET 
            title='$title',
            rate='$rate',
            information_hotel='$information_hotel',
            infomation_packeg='$infomation_packeg',
            prisenightday='$prisenightday',
            catogry_id=$catogry_id,
            imgurl='$imgurl'
            WHERE id=$id";

        if (mysqli_query($conn, $sql)) {
              echo "<div class='alert alert-success text-center mt-3' id='successMsg'> Data updated successfully</div>";

        
    } else {
        echo "<div class='alert alert-danger text-center'> Update failed</div>";
    }
}
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>Edit Hotel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Edit Hotel</h2>

    <?php if(isset($success_msg)) echo "<div class='alert alert-success'>$success_msg</div>"; ?>
    <?php if(isset($error_msg)) echo "<div class='alert alert-danger'>$error_msg</div>"; ?>

    <div class="card shadow-lg p-4">
        <form enctype="multipart/form-data" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Hotel Name:</label>
                <input class="form-control" name="title" value="<?= htmlspecialchars($data['title']) ?>" type="text" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Current Image:</label><br>
                <img src="../<?= htmlspecialchars($data['imgurl']) ?>" width="120" height="80" alt="">
                <input type="hidden" name="old_image" value="<?= htmlspecialchars($data['imgurl']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Change Image:</label>
                <input type="file" name="file" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Rate:</label>
                <input class="form-control" name="rate" type="number" value="<?= htmlspecialchars($data['rate']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Hotel Information:</label>
                <textarea class="form-control" name="information_hotel"><?= htmlspecialchars($data['information_hotel']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Package Information:</label>
                <textarea class="form-control" name="infomation_packeg"><?= htmlspecialchars($data['infomation_packeg']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Price (Night/Day):</label>
                <input class="form-control" name="prisenightday" type="number" step="0.01" value="<?= htmlspecialchars($data['prisenightday']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Category:</label>
                <select name="catogry_id" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $data['catogry_id']) ? "selected" : "" ?>>
                            <?= htmlspecialchars($cat['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" class="btn btn-info form-control fw-bold" name="submit_hotel" value="Update Hotel">
        </form>
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

<?php mysqli_close($conn); ?>
