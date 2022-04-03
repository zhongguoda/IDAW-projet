<?php
require_once('config.php');

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_POST['NOM']) && isset($_POST['ID_TYPE_ALIMENT'])){
    $SQL = "SELECT NOM FROM aliment WHERE NOM = '".$_POST["NOM"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) == 0) {
        $list = Array(
            'NOM'  => $_POST['NOM'],
            'ID_TYPE_ALIMENT'  => $_POST['ID_TYPE_ALIMENT']
        );
        $sql = "INSERT INTO aliment (`NOM`, `ID_TYPE_ALIMENT`) VALUES ('".$list['NOM']."', '".$list['ID_TYPE_ALIMENT']."')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Aliment ajouté avec succès !");'; 
            echo 'window.location.href = "../frontend/aliments.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Un aliment avec le même nom existe déjà !");'; 
        echo 'window.location.href = "../frontend/aliments.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/aliments.php');
}
$conn->close();