
<?php
// database connection settings
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "student_management";

// connect to database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if connection fails, stop the page and show error
if ($conn == false) {
    die("could not connect to database");
}