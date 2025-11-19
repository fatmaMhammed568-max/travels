<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
session_start();

$msg = '';

if (isset($_POST['register_user'])) {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $natid    = trim($_POST['natid']);
    $phone    = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $role     = 'User'; // ثابت للمستخدم العادي

    if (empty($name) || empty($email) || empty($password)) {
        $msg = "<div class='alert alert-warning text-center'>Please fill all required fields</div>";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger text-center'>Invalid email format</div>";
    } 
    else {

        // هل الايميل مستخدم قبل كده؟
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' LIMIT 1");

        if (mysqli_num_rows($check) > 0) {
            $msg = "<div class='alert alert-danger text-center'>
                Email already registered. 
                <a href='login.php' class='fw-bold text-primary'>Login</a>
              </div>";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = "
                INSERT INTO users (name, email, password, natid, phone, role)
                VALUES ('$name', '$email', '$hashedPassword', '$natid', '$phone', '$role')
            ";

            if (mysqli_query($conn, $insert)) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $msg = "<div class='alert alert-danger text-center'>Registration failed</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Travels Toma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="bg-white p-4 shadow rounded w-25">
  <h3 class="text-center text-primary mb-4 fw-bold">Create Account</h3>
  <?= $msg ?>
  <form method="POST">

    <div class="mb-3">
      <label>Name</label>
      <input name="name" type="text" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>National ID</label>
      <input name="natid" type="text" class="form-control">
    </div>

    <div class="mb-3">
      <label>Phone</label>
      <input name="phone" type="text" class="form-control">
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>

    <button type="submit" name="register_user" class="btn btn-success w-100">Register</button>
  </form>

  <p class="text-center mt-3 mb-0">
    Already have an account? 
    <a href="login.php" class="fw-bold text-primary text-decoration-none">Login</a>
  </p>
</div>

</body>
</html>
