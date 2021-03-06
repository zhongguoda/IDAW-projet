<?php
require_once('config.php');
session_start();
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_SESSION['MAIL']) && isset($_SESSION['MOT_DE_PASSE'])){
    $sql = "SELECT type_ratio.TYPE_RATIO, ROUND(SUM((a_mange.QUANTITE/100)*a.VALEUR_RATIO), 2) AS VALEUR FROM a_mange INNER JOIN a ON a.ID_ALIMENT = a_mange.ID_ALIMENT INNER JOIN type_ratio ON type_ratio.ID_TYPE_RATIO = a.ID_TYPE_RATIO WHERE a_mange.MAIL = '".$_SESSION["MAIL"]."' GROUP BY a.ID_TYPE_RATIO";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $array_values[] = $row;
        }
        echo json_encode($array_values);
    } else {
        echo json_encode([]);
    }
} else {
    header('Location: ../frontend/index.php');
}
$conn->close();