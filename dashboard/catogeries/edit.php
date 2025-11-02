
<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

$id = $_GET['id'] ?? null;
$data = [];

if ($id) {
    $select = "SELECT * FROM `catogries` WHERE id=$id";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger text-center'> Category not found</div>";
    }
}

if (isset($_POST['submit_user'])) {
    $title = filterInputs($_POST['title']);
    $description = filterInputs($_POST['description']);

    if (!empty($_FILES['file']['name'])) {
        $file_name = basename($_FILES['file']['name']);
        $tmp_name = $_FILES['file']['tmp_name'];

        $upload_dir = realpath(__DIR__ . '/../../uploads');
        if (!$upload_dir) {
            $upload_dir = __DIR__ . '/../../uploads';
            mkdir($upload_dir, 0777, true);
        }

        $file_path = $upload_dir . '/' . $file_name;

        if (move_uploaded_file($tmp_name, $file_path)) {
            $new_image = $file_name;
        } else {
            echo "<div class='alert alert-warning text-center'> Failed to upload new image</div>";
            $new_image = $data['imgurl'];
        }
    } else {
        $new_image = $data['imgurl'];
    }

    $sql = "UPDATE `catogries` SET 
            `title`='$title', 
            `description`='$description', 
            `imgurl`='$new_image' 
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success text-center'> Data updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Update failed</div>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Category</h2>
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title:</label>
                        <input class="form-control" type="text" name="title" value="<?= $data['title'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control" name="description" required><?= $data['description'] ?? '' ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Image:</label><br>
                        <?php if (!empty($data['imgurl'])): ?>
                            <img src="../../uploads/<?= $data['imgurl'] ?>" width="120" class="mb-2 border rounded">
                        <?php else: ?>
                            <p>No image available</p>
                        <?php endif; ?>
                        <br>
                        <label class="form-label mt-2">Change Image:</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <input type="submit" class="btn btn-info form-control" name="submit_user" value="Save Changes">
                </form>
            </div>
        </div>
    </div>
</body>
</html>