<?php
session_start();
require_once('config.php');

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_SESSION['MAIL']) && isset($_POST['ID_REPAS']) && isset($_POST['ID_ALIMENT']) && isset($_POST['QUANTITE']) && isset($_POST['DATE'])) {
    $SQL = "SELECT MAIL FROM a_mange WHERE MAIL = '".$_SESSION["MAIL"]."' AND ID_REPAS = '".$_POST["ID_REPAS"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $list = Array(
            'DATE'  => $_POST['DATE'],
            'QUANTITE'  => $_POST['QUANTITE'],
            'ID_ALIMENT'  => $_POST['ID_ALIMENT'],
            'ID_REPAS'  => $_POST['ID_REPAS']
        );
        $sql = "UPDATE `a_mange` SET `DATE` = '".$list['DATE']."', `QUANTITE` = '".$list['QUANTITE']."', `ID_ALIMENT` = '".$list['ID_ALIMENT']."' WHERE `a_mange`.`MAIL` = '".$_SESSION["MAIL"]."' AND `a_mange`.`ID_REPAS` = '".$list['ID_REPAS']."'";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Repas modifié avec succès !");'; 
            echo 'window.location.href = "../frontend/journal.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Auncun repas avec cette référence !");'; 
        echo 'window.location.href = "../frontend/journal.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/journal.php');
}
$conn->close();