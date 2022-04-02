<?php
session_start();
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "projet_idaw_prast";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_SESSION['MAIL']) && isset($_POST['ID_ALIMENT']) && isset($_POST['NOM']) && isset($_POST['ID_TYPE_ALIMENT'])) {
    $SQL = "SELECT ID_ALIMENT FROM aliment WHERE ID_ALIMENT = '".$_POST["ID_ALIMENT"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $list = Array(
            'NOM'  => $_POST['NOM'],
            'ID_TYPE_ALIMENT'  => $_POST['ID_TYPE_ALIMENT'],
            'ID_ALIMENT'  => $_POST['ID_ALIMENT']
        );
        if ($list['ID_TYPE_ALIMENT'] == -1){
            $sql = "UPDATE `aliment` SET `NOM` = '".$list['NOM']."' WHERE `aliment`.`ID_ALIMENT` = '".$list['ID_ALIMENT']."'";
        } else {
            $sql = "UPDATE `aliment` SET `ID_TYPE_ALIMENT` = '".$list['ID_TYPE_ALIMENT']."', `NOM` = '".$list['NOM']."' WHERE `aliment`.`ID_ALIMENT` = '".$list['ID_ALIMENT']."'";
        }
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Aliment modifié avec succès !");'; 
            echo 'window.location.href = "../frontend/aliments.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Auncun aliment avec cette référence !");'; 
        echo 'window.location.href = "../frontend/aliments.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/aliments.php');
}
$conn->close();