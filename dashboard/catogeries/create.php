<?php
include_once('../../env.php');
include_once('../../layouts/functions.php');
include_once('../../layouts/navbar.php');

if (isset($_POST['submit_user'])) {

    if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_FILES['file']['name'])) {
        
        $title = mysqli_real_escape_string($conn, filterInputs($_POST['title']));
        $description = mysqli_real_escape_string($conn, filterInputs($_POST['description']));

      
        $file_name = basename($_FILES['file']['name']);
        $tmp_name = $_FILES['file']['tmp_name'];
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            echo "<div class='alert alert-warning text-center'> Only JPG, JPEG, PNG, WEBP allowed.</div>";
        } else {
            $upload_dir = realpath(__DIR__ . '/../../uploads');
            if (!$upload_dir) {
                $upload_dir = __DIR__ . '/../../uploads';
                mkdir($upload_dir, 0777, true);
            }

          
            $new_name = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $file_path = $upload_dir . '/' . $new_name;

         
            if (move_uploaded_file($tmp_name, $file_path)) {

            
                $sql = "INSERT INTO `catogries`(`title`, `imgurl`, `description`) 
                        VALUES ('$title', '$new_name', '$description')";

                if (mysqli_query($conn, $sql)) {
                    echo "<div class='alert alert-success text-center'> Data saved successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'> Database insert error: " . mysqli_error($conn) . "</div>";
                }

            } else {
                echo "<div class='alert alert-warning text-center'> Failed to upload image.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-warning text-center'> Please fill all fields.</div>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
    <title>Add New Category</title>
</head>
<body>
    <div class='container mt-5'>
        <h2 class='text-center mb-4 text-primary'>Add New Category</h2>
        <div class='card mx-auto shadow' style='max-width: 600px;'>
            <div class='card-body'>
                <form enctype='multipart/form-data' method='POST'>
                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Title:</label>
                        <input class='form-control' name='title' type='text' placeholder='Enter title' required>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Description:</label>
                        <textarea class='form-control' name='description' placeholder='Enter description' required></textarea>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label fw-bold'>Image:</label>
                        <input type='file' class='form-control' name='file' accept='image/*' required>
                    </div>
                    <input type='submit' class='btn btn-info form-control fw-bold' name='submit_user' value='Save'>
                </form>
            </div>
        </div>
    </div>
    

</body>
</html>


