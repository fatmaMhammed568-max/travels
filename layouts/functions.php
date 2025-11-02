
<?php

use Soap\Url;

const Project = 'travels';

define('BASE_URL', 'http://localhost/');
URL("/lectures/create.php");
function URL($var = null) 
{
    return (BASE_URL . Project . $var);
}

function redirect($var =null)
{
    $ProjectName = Project;
    echo "
     <script>
        window.location.replace('http://localhost/$ProjectName/$var');
    </script>
    ";
}

// filter All Inputs
function filterInputs($input)//00000000
{
    $input  = trim($input);
    $input  = strip_tags($input);
    $input  = stripslashes($input);
    $input  = htmlspecialchars($input);

    return $input;
}


if (!function_exists('countRows')) {
    function countRows($conn, $table, $where = '') {
        $sql = "SELECT COUNT(*) AS cnt FROM `$table`";
        if ($where) $sql .= " WHERE $where";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            return (int)$row['cnt'];
        }
        return 0;
    }
}