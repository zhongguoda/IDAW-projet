<?php
require_once('config.php');

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(DISTINCT a_mange.DATE) FROM `a_mange` INNER JOIN a ON a_mange.ID_ALIMENT = a.ID_ALIMENT GROUP BY a_mange.MAIL";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $array_values[] = $row;
    }
    echo json_encode($array_values);
} else {
    echo json_encode([]);
}

$conn->close();