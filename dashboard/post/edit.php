
<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

$id = (int)$_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM posts WHERE id=$id");
if (mysqli_num_rows($res) == 0) die("Post not found");
$post = mysqli_fetch_assoc($res);

$msg = '';

if (isset($_POST['update_post'])) {

    $title   = mysqli_real_escape_string($conn, $_POST['title']);
    $author  = mysqli_real_escape_string($conn, $_POST['author']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $image = $post['featured_image'];

    if (!empty($_FILES['featured_image']['name'])) {
        $imgName = time() . "_" . $_FILES['featured_image']['name'];
        $target = "../../dashboard/uploads/" . $imgName;

        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
            $image = $target;
        }
    }

    $sql = "UPDATE posts SET 
                title='$title',
                author='$author',
                content='$content',
                featured_image='$image'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='alert alert-success text-center mt-3' id='successMsg'>Post Updated</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error Updating</div>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Blog Post</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2>Edit Post</h2>
    <?= $msg ?>

    <form method="POST" enctype="multipart/form-data" class="p-4 bg-light shadow rounded">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="<?= $post['title'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input name="author" class="form-control" value="<?= $post['author'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required><?= $post['content'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <?php if ($post['featured_image']) : ?>
                <img src="<?= $post['featured_image'] ?>" width="120">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="featured_image" class="form-control">
        </div>

        <button name="update_post" class="btn btn-primary px-4">Update</button>

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
