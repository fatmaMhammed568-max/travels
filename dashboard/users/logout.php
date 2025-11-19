
<?php
session_start();
session_unset();
session_destroy();
header("Location: /travels/dashboard/users/login.php");
exit;
?>
