<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$id = $_GET['id'] ?? null;
$user = [];

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
    }
}

if (isset($_POST['submit_user'])) {
    $name     = filterInputs($_POST['name']);
    $email    = filterInputs($_POST['email']);
    $natid    = filterInputs($_POST['natid']);
    $phone    = filterInputs($_POST['phone']);
    $role     = filterInputs($_POST['role']);
    $password = $_POST['password'];

    $updatePassword = "";
    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $updatePassword = ", password='$hashed'";
    }

    $sql = "UPDATE users SET 
            name='$name', email='$email', natid='$natid', phone='$phone', role='$role' $updatePassword
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center mt-3' id='successMsg'>User updated successfully.</div>";
    } else {
        echo "<div class='alert alert-success text-center mt-3' id='successMsg'>Failed to update user.<br>" . mysqli_error($conn) . "</div>";
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Edit User</h2>
    <form method="POST" class="shadow p-4 rounded bg-white">

   
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
        </div>

       
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

      
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" id="password" name="password" class="form-control" 
                   placeholder="Leave blank to keep current password">
        </div>

    
        <div class="mb-3">
            <label for="natid" class="form-label fw-bold">National </label>
            <input type="text" id="natid" name="natid" class="form-control" 
                   value="<?= htmlspecialchars($user['natid'] ?? '') ?>" required>
        </div>

       
        <div class="mb-3">
            <label for="phone" class="form-label fw-bold">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" 
                   value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label fw-bold">Role</label>
            <select id="role" name="role" class="form-select" required>
                <option value="Admin" <?= ($user['role'] ?? '') == 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option value="User" <?= ($user['role'] ?? '') == 'User' ? 'selected' : '' ?>>User</option>
                <option value="Customer" <?= ($user['role'] ?? '') == 'Customer' ? 'selected' : '' ?>>Customer</option>
                <option value="Hotel Owner" <?= ($user['role'] ?? '') == 'Hotel Owner' ? 'selected' : '' ?>>Hotel Owner</option>
            </select>
        </div>

        <button class="btn btn-info w-100 fw-bold" name="submit_user">Update User</button>
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
