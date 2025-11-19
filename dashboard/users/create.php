<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}

include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');



$msg = '';

if (isset($_POST['submit_user'])) {

    $name     = mysqli_real_escape_string($conn, filterInputs($_POST['name']));
    $email    = mysqli_real_escape_string($conn, filterInputs($_POST['email']));
    $password = mysqli_real_escape_string($conn, filterInputs($_POST['password']));
    $natid    = mysqli_real_escape_string($conn, filterInputs($_POST['natid']));
    $phone    = mysqli_real_escape_string($conn, filterInputs($_POST['phone']));
    $role     = mysqli_real_escape_string($conn, filterInputs($_POST['role']));

    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $msg = "<div class='alert alert-warning text-center mt-3'>Please fill all fields.</div>";
    } else {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, natid, phone, role)
                VALUES ('$name', '$email', '$hashed', '$natid', '$phone', '$role')";

        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='alert alert-success text-center mt-3'>User added successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger text-center mt-3'>Database error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center text-primary mb-4">Add New User</h2>

  <?= $msg ?>

  <div class="card shadow mx-auto" style="max-width: 600px;">
    <div class="card-body">

      <form method="POST">

        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">National ID</label>
          <input type="text" name="natid" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-select" required>
            <option value="">Choose Role</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            <option value="Customer">Customer</option>
            <option value="Hotel Owner">Hotel Owner</option>
          </select>
        </div>

        <button name="submit_user" class="btn btn-primary w-100">Save User</button>

      </form>
    </div>
  </div>
</div>

</body>
</html>
