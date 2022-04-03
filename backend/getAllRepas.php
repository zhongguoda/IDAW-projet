<?php
require_once('config.php');
session_start();
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_SESSION["MAIL"]) && isset($_SESSION["MOT_DE_PASSE"])){
    $tryLogin=$_SESSION["MAIL"];
    $tryPwd=$_SESSION["MOT_DE_PASSE"];
    $sql = "SELECT `a_mange`.`ID_REPAS`, `aliment`.`NOM`, `a_mange`.`QUANTITE`, `a_mange`.`DATE` FROM `a_mange`, `aliment`, `utilisateur` WHERE `a_mange`.`MAIL` ='".$tryLogin."' AND `utilisateur`.`MOT_DE_PASSE` = '".$tryPwd."' AND `aliment`.`ID_ALIMENT` = `a_mange`.`ID_ALIMENT`";
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