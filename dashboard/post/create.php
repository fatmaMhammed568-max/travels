
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
    header("Location: /travels/dashboard/users/login.php");
    exit;
}
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../index.php');

$msg = '';

if (isset($_POST['create_post'])) {

    $title   = mysqli_real_escape_string($conn, $_POST['title']);
    $author  = mysqli_real_escape_string($conn, $_POST['author']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

   
$image = null;

if (!empty($_FILES['featured_image']['name'])) {

    $imgName = time() . "_" . $_FILES['featured_image']['name'];

   
    $save_path = __DIR__ . "/../uploads/" . $imgName;

    
    $image_url = "/travels/dashboard/uploads/" . $imgName;

    if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $save_path)) {
        $image = $image_url;
    }
}


    $sql = "INSERT INTO posts (title, author, content, featured_image) 
            VALUES ('$title', '$author', '$content', '$image')";

    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='alert alert-success text-center mt-3' id='successMsg'>Post Created Successfully!</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Blog Post</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2>Create New Blog Post</h2>
    <?= $msg ?>

    <form method="POST" enctype="multipart/form-data" class="p-4 bg-light shadow rounded">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input name="author" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="featured_image" class="form-control">
        </div>

        <button name="create_post" class="btn btn-primary px-4">Create</button>

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
