<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');


if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    if (mysqli_query($conn, "DELETE FROM contacts ")) {
        echo "<div class='alert alert-success text-center'> User deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Failed to delete user.</div>";
    }
}


$result = mysqli_query($conn, "SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
h2 { text-align:center; margin-top:40px; color:#0d6efd; font-weight:600; }
.table thead { background-color:#0d6efd; color:white; }
.btn { border-radius:25px; padding:5px 15px; }
.btn-edit { background-color:#ffc107; color:#212529; }
.btn-edit:hover { background-color:#e0a800; }
.btn-delete { background-color:#dc3545; color:white; }
.btn-delete:hover { background-color:#bb2d3b; }
.btn-add { background-color:#198754; color:white; border-radius:30px; }
.btn-add:hover { background-color:#157347; }
</style>
</head>
<body>
<div class="container">
    <h2>Contact List</h2>

    <div class="text-end my-3">
        <a href="./create.php" class="btn btn-add"> Add New Contact</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle shadow-sm">
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                           
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                            <td>
                                <a class="btn btn-edit btn-sm" href="./edit.php?id="> Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-delete btn-sm" href="?delete=" onclick="return confirm('Are you sure you want to delete this Contact?')"> Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-muted text-center py-3">No Contacts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<?php mysqli_close($conn); ?>