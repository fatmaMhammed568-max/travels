
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$res = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Posts</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2>Blog Posts</h2>

    <a href="create_post.php" class="btn btn-success mb-3"> Add New</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_assoc($res)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>

                <td>
                    <?php if ($row['featured_image']) : ?>
                        <img src="<?= $row['featured_image'] ?>" width="80">
                    <?php endif; ?>
                </td>

                <td><?= $row['title'] ?></td>
                <td><?= $row['author'] ?></td>
                <td><?= $row['published_at'] ?></td>

                <td>
                     <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm fw-bold">Edit</a>
                   <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this package?')" class="btn btn-danger btn-sm fw-bold">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>

    </table>

</div>

</body>
</html>
