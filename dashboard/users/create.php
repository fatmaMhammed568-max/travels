<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

if (isset($_POST['submit_user'])) {

    $name     = mysqli_real_escape_string($conn, filterInputs($_POST['name'] ?? ''));
    $email    = mysqli_real_escape_string($conn, filterInputs($_POST['email'] ?? ''));
    $password = mysqli_real_escape_string($conn, filterInputs($_POST['password'] ?? ''));
    $natid    = mysqli_real_escape_string($conn, filterInputs($_POST['natid'] ?? ''));
    $phone    = mysqli_real_escape_string($conn, filterInputs($_POST['phone'] ?? ''));
    $role     = mysqli_real_escape_string($conn, filterInputs($_POST['role'] ?? ''));

    if (empty($name) || empty($email) || empty($password) || empty($natid) || empty($phone) || empty($role)) {
        echo "<div class='alert alert-warning text-center mt-3'>Please fill all fields.</div>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
       $sql = "INSERT INTO users (name, email, password, natid, phone, role)
        VALUES ('$name', '$email', '$hashedPassword', '$natid', '$phone', '$role')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center mt-3'>User added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Database error: " . mysqli_error($conn) . "</div>";
        }
    }
}
mysqli_close($conn);
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

    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form method="POST">

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <!-- National ID -->
                <div class="mb-3">
                    <label for="natid" class="form-label fw-bold">National </label>
                    <input type="text" id="natid" name="natid" class="form-control" placeholder="Enter national ID" required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label fw-bold">User Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                        <option value="Customer">Customer</option>
                        <option value="Hotel Owner">Hotel Owner</option>
                    </select>
                </div>

                <button class="btn btn-primary w-100 fw-bold" name="submit_user">Save User</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
