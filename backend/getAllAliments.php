<?php
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "projet_idaw_prast";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}

$sql = "SELECT aliment.ID_ALIMENT, aliment.NOM, type_aliment.TYPE_ALIMENT FROM aliment INNER JOIN type_aliment ON type_aliment.ID_TYPE_ALIMENT = aliment.ID_TYPE_ALIMENT";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $array_values[] = $row;
    }
} else {
    echo "0 results";
}

echo json_encode($array_values);
$conn->close();