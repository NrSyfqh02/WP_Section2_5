<html>
<head>
<title>Connecting to MySQL in PHP</title>
</head>
<body>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'testdb'; // tukar ikut nama database kau

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    echo "Connection failed: " . $mysqli->connect_error;
    exit();
}

echo "Connected successfully";

$mysqli->close();
?>

</body>
</html>