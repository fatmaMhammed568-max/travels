
<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

$sql = "SELECT * FROM `catogries`";
$result = mysqli_query($conn, $sql);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `catogries` WHERE id=$id");
    echo "<div class='alert alert-success text-center'> Category deleted successfully</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2 class="text-center mt-5">Categories List</h2>
    <div class="container mt-5">
        <div class="card mt-5" style="margin: 0 10rem;">
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-info">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td><img src="../../uploads/<?= $row['imgurl'] ?>" width="80"></td>
                                    <td><a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-info">Edit</a></td>
                                    <td><a href="?delete=<?= $row['id'] ?>" class="btn btn-danger">Delete</a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php mysqli_close($conn); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>