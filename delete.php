
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_login";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,3306);


// Check connection php_login
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM clockinout WHERE itc_search='$id'");

header("Location: EmployeeTime.php");
exit();

?>
