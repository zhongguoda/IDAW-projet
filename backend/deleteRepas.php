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
if (isset($_POST['ID_REPAS']) && isset($_SESSION['MAIL'])){
    $SQL = "SELECT ID_REPAS FROM a_mange WHERE ID_REPAS = '".$_POST["ID_REPAS"]."' AND MAIL = '".$_SESSION["MAIL"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) > 0) {
        $list = Array(
            'MAIL' => $_SESSION['MAIL'],
            'ID_REPAS'  => $_POST['ID_REPAS']
        );
        $sql = "DELETE FROM a_mange WHERE ID_REPAS = '".$list["ID_REPAS"]."' AND MAIL = '".$list["MAIL"]."'";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Repas supprimé avec succès !");'; 
            echo 'window.location.href = "../frontend/journal.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Aucun repas avec cette référence !");'; 
        echo 'window.location.href = "../frontend/journal.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/journal.php');
}
$conn->close();