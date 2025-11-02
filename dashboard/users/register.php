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
    $role     = 'user';

  
    if (empty($name) || empty($email) || empty($password)) {
        $msg = "<div class='alert alert-warning text-center'>Please fill all required fields</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<div class='alert alert-danger text-center'>Invalid email format</div>";
    } elseif (!empty($natid) && !preg_match('/^[0-9]{14}$/', $natid)) {
        $msg = "<div class='alert alert-danger text-center'>National ID must be 14 digits</div>";
    } elseif (!empty($phone) && !preg_match('/^[0-9]{10,15}$/', $phone)) {
        $msg = "<div class='alert alert-danger text-center'>Invalid phone number</div>";
    } else {
     
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

     
        $check_sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $msg = "<div class='alert alert-danger text-center'>
                        Email already registered. 
                        <a href='login.php' class='text-primary fw-bold'>Login here</a>
                    </div>";
        } else {
           
            $insert_sql = "
                INSERT INTO users (name, email, password, natid, phone, role)
                VALUES ('$name', '$email', '$hashedPassword', '$natid', '$phone', '$role')
            ";
            if (mysqli_query($conn, $insert_sql)) {
                header("Location: login.php?registered=1");
                exit;
            } else {
                $msg = "<div class='alert alert-danger text-center'>Registration failed! Please try again.</div>";
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
  <style>
    body { background-color:#f8f9fa; font-family:'Poppins',sans-serif; }
    .register-box {
      background:white; padding:40px; border-radius:20px;
      box-shadow:0 4px 15px rgba(0,0,0,0.1);
      width: 400px;
    }
    .btn-success { border-radius:30px; font-weight:600; }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

  <div class="register-box">
    <h3 class="text-center mb-4 text-primary fw-bold">Create Account</h3>
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
        <label>National </label>
        <input name="natid" type="text" class="form-control" maxlength="14">
      </div>
      <div class="mb-3">
        <label>Phone</label>
        <input name="phone" type="text" class="form-control" maxlength="15">
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required minlength="6">
      </div>
      <button type="submit" name="register_user" class="btn btn-success w-100">Register</button>
    </form>
    <p class="text-center mt-3 mb-0">
      Already have an account? 
      <a href="./login.php" class="text-decoration-none text-primary fw-semibold">Login</a>
    </p>
  </div>

</body>
</html>
