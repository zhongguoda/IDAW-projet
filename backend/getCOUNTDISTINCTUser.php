<?php
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "projet_idaw_prast";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(DISTINCT MAIL) FROM `a_mange`";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $array_values[] = $row;
    }
    echo json_encode($array_values[0]["COUNT(DISTINCT MAIL)"]);
} else {
    echo json_encode([]);
}

$conn->close();