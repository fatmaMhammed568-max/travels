<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("<div class='alert alert-danger text-center mt-3'>Invalid Contact ID.</div>");
}

$res = mysqli_query($conn, "SELECT * FROM contacts WHERE id=$id");
if (!$res || mysqli_num_rows($res) == 0) {
    die("<div class='alert alert-danger text-center mt-3'>Contact not found.</div>");
}

$user = mysqli_fetch_assoc($res);

if (isset($_POST['submit_user'])) {

    $name = filterInputs($_POST['name']);
    $email = filterInputs($_POST['email']);
    $message = filterInputs($_POST['message']);

    $sql = "UPDATE contacts 
            SET name='$name', email='$email', message='$message'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center mt-3' id='successMsg'>Contact updated successfully.</div>";
        
        $user['name'] = $name;
        $user['email'] = $email;
        $user['message'] = $message;
    } else {
        echo "<div class='alert alert-danger text-center'> Error updating Contact: " . mysqli_error($conn) . "</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Contact</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Edit Contact</h2>

    <form method="POST" class="shadow p-4 rounded bg-white">

        <div class="mb-3">
            <label class="form-label fw-bold">Name:</label>
            <input type="text" name="name" class="form-control"
                value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email:</label>
            <input type="email" name="email" class="form-control"
                value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Message:</label>
            <textarea class="form-control" name="message" required><?= htmlspecialchars($user['message']) ?></textarea>
        </div>

        <button class="btn btn-info w-100 fw-bold" name="submit_user">Update Contact</button>
    </form>
</div>

<script>
setTimeout(function(){
  const msg = document.getElementById('successMsg');
  if (msg) msg.style.opacity = "0";
}, 3000);
</script>

</body>
</html>
