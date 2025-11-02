<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

$Contact = [];

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM contacts ");
    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
    }
}

if (isset($_POST['submit_user'])) {
    $name = filterInputs($_POST['name']);
   $email = (int) filterInputs($_POST['email'] ?? 0);

    $message = filterInputs($_POST['message']);
  

    $sql = "UPDATE contacts 
            SET name='$name', email='$email', message='$message' "
            ;

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'> User updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Failed to update Contacts.<br>" . mysqli_error($conn) . "</div>";
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
            <input type="text" name="name" class="form-control" placeholder='Enter name'
                   value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email:</label>
            <input type="text" name="email" class="form-control" placeholder='Enter email'
                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Message:</label>
            <textarea class='form-control' name='message' placeholder='Enter message' value="<?= htmlspecialchars($user['message'] ?? '') ?>" 
            required></textarea>
                   
        </div>

        <button class="btn btn-info w-100 fw-bold" name="submit_user">Update Contact</button>
    </form>
</div>
</body>
</html>