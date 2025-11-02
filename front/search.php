<?php
include_once('../env.php');
include_once('../layouts/functions.php');

$destination = $_GET['destination'] ?? '';
$date = $_GET['date'] ?? ''; 
$people = $_GET['people'] ?? '';


if ($destination && $date && $people) {

   
    $query = "SELECT * FROM packegs 
              WHERE destination LIKE '%$destination%'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container mt-5'>
                <h3 class='mb-4 text-center text-success'>نتائج البحث:</h3>
                <div class='row g-4'>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='col-md-4'>
              <div class='card shadow-sm border-0'>
                <img src='{$row['imgurl']}' class='card-img-top' alt='{$row['name_packge']}' style='height:220px; object-fit:cover;'>
                <div class='card-body'>
                  <h5 class='card-title text-primary'>{$row['name_packge']}</h5>
                  <p class='card-text'><strong>الوجهة:</strong> {$row['destination']}</p>
                  <p class='card-text'><strong>نوع الإقامة:</strong> {$row['accommodation_type']}</p>
                  <p class='card-text'><strong>وسائل النقل:</strong> {$row['Transportations']}</p>
                  <p class='card-text'><strong>الفترة:</strong> {$row['periods']}</p>
                  <p class='card-text'><strong>السعر لليلة:</strong> {$row['price_night']} جنيه</p>
                  <a href='bookings.php?packag_id={$row['id']}' class='btn btn-primary w-100'>احجز الآن</a>
                </div>
              </div>
            </div>";
        }

        echo "</div></div>";
    } else {
        echo "<div class='alert alert-warning text-center mt-5'> لا توجد نتائج مطابقة لبحثك.</div>";
    }

} else {
    echo "<div class='alert alert-danger text-center mt-5'>يرجى إدخال جميع البيانات المطلوبة للبحث.</div>";
}
?>