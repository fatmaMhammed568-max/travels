<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
session_start();

$msg = '';


if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    $msg = "<div class='alert alert-success text-center'>Account created successfully! Please login.</div>";
}

if (isset($_POST['login_user'])) { 
    $email = mysqli_real_escape_string($conn, filterInputs($_POST['email']));
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $msg = "<div class='alert alert-warning text-center'>Please fill all fields</div>";
    } else {
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

       
            if (password_verify($password, $user['password']) || $password == $user['password']) {
                $_SESSION['user'] = $user;
                header("Location: ../../front/index.php"); 
                exit;
            } else {
                $msg = "<div class='alert alert-success text-center mt-3' id='successMsg'>Incorrect password</div>";
            }
        } else {
            $msg = "<div class='alert alert-success text-center mt-3' id='successMsg'>User not found</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Travels Toma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
  <div class="bg-white p-5 rounded shadow w-25">
    <h3 class="text-center mb-4 text-primary">Login</h3>
    <?= $msg ?>
    <form method="POST">
      <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
      </div>
      <button type="submit" name="login_user" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-3">
        <p>ليس لديك حساب؟ 
          <a href="register.php" class="text-primary fw-bold" style="text-decoration:none;">
            أنشئ حسابًا الآن
          </a>
        </p>
      </div>
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
