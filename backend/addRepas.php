<?php
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "projet_idaw_prast";
session_start();
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_POST['ID_ALIMENT']) && isset($_POST['QUANTITE']) && isset($_POST['DATE'])){
    $SQL = "SELECT QUANTITE FROM a_mange WHERE MAIL = '".$_SESSION["MAIL"]."' AND QUANTITE = '".$_POST["QUANTITE"]."' AND DATE = '".$_POST["DATE"]."' AND ID_ALIMENT = '".$_POST["ID_ALIMENT"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) == 0) {
        $list = Array(
            'DATE'  => $_POST['DATE'],
            'QUANTITE'  => $_POST['QUANTITE'],
            'MAIL'  => $_SESSION['MAIL'],
            'ID_ALIMENT'  => $_POST['ID_ALIMENT']
        );
        $sql = "INSERT INTO a_mange (`DATE`, `QUANTITE`, `MAIL`, `ID_ALIMENT`) VALUES ('".$list['DATE']."', '".$list['QUANTITE']."', '".$list['MAIL']."', '".$list['ID_ALIMENT']."')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Repas ajouté avec succès !");'; 
            echo 'window.location.href = "../frontend/journal.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Un repas avec les mêmes données existe déjà !");'; 
        echo 'window.location.href = "../frontend/journal.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/journal.php');
}
$conn->close();