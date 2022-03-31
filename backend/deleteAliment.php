<?php
$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "projet_idaw_prast";

$table = "utilisateur";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_POST['ID_ALIMENT'])){
    $SQL = "SELECT ID_ALIMENT FROM aliment WHERE ID_ALIMENT = '".$_POST["ID_ALIMENT"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $list = Array(
            'ID_ALIMENT'  => $_POST['ID_ALIMENT']
        );
        $sql = "DELETE FROM aliment WHERE ID_ALIMENT = '".$_POST["ID_ALIMENT"]."'";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Aliment supprimé avec succès !");'; 
            echo 'window.location.href = "../frontend/aliments.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Aucun aliment avec cette référence !");'; 
        echo 'window.location.href = "../frontend/aliments.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/aliments.php');
}
$conn->close();