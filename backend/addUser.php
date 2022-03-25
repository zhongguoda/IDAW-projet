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
if (isset($_POST['MAIL']) && isset($_POST['MOT_DE_PASSE'])){
    $SQL = "SELECT PRENOM FROM utilisateur WHERE MAIL = '".$_POST["MAIL"]."'";
    $result = mysqli_query($conn, $SQL);
    if (mysqli_num_rows($result) == 0) {
        $list = Array(
            'PRENOM'  => $_POST['PRENOM'],
            'NOM'  => $_POST['NOM'],
            'AGE'  => $_POST['AGE'],
            'ID_SEXE'  => $_POST['ID_SEXE'],
            'ID_NIVEAU_DE_PRATIQUE_SPORTIVE'  => $_POST['ID_NIVEAU_DE_PRATIQUE_SPORTIVE'],
            'MAIL'  => $_POST['MAIL'],
            'MOT_DE_PASSE'  => $_POST['MOT_DE_PASSE']
        );
        echo $list["MOT_DE_PASSE"];
        $sql = "INSERT INTO utilisateur (`MOT_DE_PASSE`, `AGE`, `MAIL`, `ID_NIVEAU_DE_PRATIQUE_SPORTIVE`, `ID_SEXE`, `NOM`, `PRENOM`) VALUES ('".$list['MOT_DE_PASSE']."', '".$list['AGE']."', '".$list['MAIL']."', '".$list['ID_NIVEAU_DE_PRATIQUE_SPORTIVE']."', '".$list['ID_SEXE']."', '".$list['NOM']."', '".$list['PRENOM']."')";
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("Votre compte a été créé avec succès !");'; 
            echo 'window.location.href = "../frontend/login.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Adresse Mail déjà utilisée !");'; 
        echo 'window.location.href = "../frontend/inscription.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/inscription.php');
}
$conn->close();