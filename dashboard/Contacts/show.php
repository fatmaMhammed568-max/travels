<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    if ($id > 0) {
        $delete_sql = "DELETE FROM contacts WHERE id=$id";
        
        if (mysqli_query($conn, $delete_sql)) {
            echo "<div class='alert alert-success text-center mt-3' id='successMsg'> Contact deleted successfully.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'> Failed to delete contact.</div>";
        }
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
body { background-color: #f8f9fa; }
h2 { text-align:center; margin-top:40px; color:#0d6efd; }
.table thead { background-color:#0d6efd; color:white; }
.btn { border-radius:25px; padding:5px 15px; }


.btn-edit { background-color:#ffc107; color:#212529; }
.btn-edit:hover { background-color:#ffc107 !important; color:#212529 !important; }

.btn-delete { background-color:#dc3545; color:white; }
.btn-delete:hover { background-color:#dc3545 !important; color:white !important; }

.btn-add { background-color:#198754; color:white; }
.btn-add:hover { background-color:#198754 !important; color:white !important; }

</style>
</head>
<body>

<div class="container">
    <h2>Contact List</h2>

    <div class="text-end my-3">
        <a href="./create.php" class="btn btn-add"> Add New Contact</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center shadow-sm">
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
                                <a class="btn btn-edit btn-sm" href="./edit.php?id=<?= $row['id'] ?>">Edit</a>
                            </td>

                            <td>
                                <a class="btn btn-delete btn-sm" 
                                   href="?delete=<?= $row['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this Contact?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5">No Contacts found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
setTimeout(function(){
  const msg = document.getElementById('successMsg');
  if (msg) msg.style.opacity = "0";
}, 3000);
</script>

</body>
</html>

<?php mysqli_close($conn); ?>
