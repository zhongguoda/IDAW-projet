<?php
require_once('config.php');
session_start();
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
    }
if (isset($_SESSION['MAIL']) && isset($_SESSION['MOT_DE_PASSE'])){
    $sql = "SELECT COUNT(DISTINCT DATE) FROM `a_mange` INNER JOIN a ON a_mange.ID_ALIMENT = a.ID_ALIMENT WHERE a_mange.MAIL = '".$_SESSION["MAIL"]."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $array_values[] = $row;
        }
        echo json_encode($array_values[0]["COUNT(DISTINCT DATE)"]);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
$conn->close();