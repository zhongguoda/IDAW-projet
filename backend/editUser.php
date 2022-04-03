<?php
session_start();
require_once('config.php');

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
if (isset($_SESSION['MAIL']) && isset($_SESSION["MOT_DE_PASSE"]) && isset($_POST['ANCIEN_MOT_DE_PASSE']) && isset($_POST['NOUVEAU_MOT_DE_PASSE']) && isset($_POST['MAIL'])) {
    $SQL = "SELECT MAIL FROM utilisateur WHERE MAIL = '".$_POST["MAIL"]."'";
    $result = mysqli_query($conn, $SQL);
    if (((mysqli_num_rows($result) == 0 && $_POST["MAIL"] != $_SESSION['MAIL']) || (mysqli_num_rows($result) == 1 && $_POST["MAIL"] == $_SESSION['MAIL'])) && $_POST['ANCIEN_MOT_DE_PASSE'] != $_POST['NOUVEAU_MOT_DE_PASSE'] && $_POST['ANCIEN_MOT_DE_PASSE'] == $_SESSION['MOT_DE_PASSE']) {
        $list = Array(
            'PRENOM'  => $_POST['PRENOM'],
            'NOM'  => $_POST['NOM'],
            'AGE'  => $_POST['AGE'],
            'ID_SEXE'  => $_POST['ID_SEXE'],
            'ID_NIVEAU_DE_PRATIQUE_SPORTIVE'  => $_POST['ID_NIVEAU_DE_PRATIQUE_SPORTIVE'],
            'MAIL'  => $_POST['MAIL'],
            'ANCIEN_MOT_DE_PASSE'  => $_POST['ANCIEN_MOT_DE_PASSE'],
            'NOUVEAU_MOT_DE_PASSE'  => $_POST['NOUVEAU_MOT_DE_PASSE']
        );
        $sql = "UPDATE `utilisateur` SET `MOT_DE_PASSE` = '".$list['NOUVEAU_MOT_DE_PASSE']."', `AGE` = '".$list['AGE']."', `MAIL` = '".$list['MAIL']."', `ID_NIVEAU_DE_PRATIQUE_SPORTIVE` = '".$list['ID_NIVEAU_DE_PRATIQUE_SPORTIVE']."', `ID_SEXE` = '".$list['ID_SEXE']."', `NOM` = '".$list['NOM']."', `PRENOM` = '".$list['PRENOM']."' WHERE `utilisateur`.`MAIL` = '".$_SESSION["MAIL"]."'";
        if ($conn->query($sql) === TRUE) {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["MAIL"]=$list['MAIL'];
            $_SESSION["MOT_DE_PASSE"]=$list['NOUVEAU_MOT_DE_PASSE'];
            $_SESSION["NOM"]=$list['NOM'];
            $_SESSION["PRENOM"]=$list['PRENOM'];
            $_SESSION["AGE"]=$list['AGE'];
            $_SESSION["ID_SEXE"]=$list['ID_SEXE'];
            $_SESSION["ID_NIVEAU_DE_PRATIQUE_SPORTIVE"]=$list['ID_NIVEAU_DE_PRATIQUE_SPORTIVE'];

            echo '<script type="text/javascript">'; 
            echo 'alert("Votre compte a été modifié avec succès !");'; 
            echo 'window.location.href = "../frontend/index.php";';
            echo '</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($_POST['ANCIEN_MOT_DE_PASSE'] != $_SESSION['MOT_DE_PASSE']) {
        echo '<script type="text/javascript">'; 
        echo 'alert("Erreur de mot de passe !");'; 
        echo 'window.location.href = "../frontend/profil.php";';
        echo '</script>';
    } elseif ($_POST['ANCIEN_MOT_DE_PASSE'] == $_POST['NOUVEAU_MOT_DE_PASSE']) {
        echo '<script type="text/javascript">'; 
        echo 'alert("Nouveau mot de passe identique à l\'ancien !");'; 
        echo 'window.location.href = "../frontend/profil.php";';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">'; 
        echo 'alert("Adresse Mail déjà utilisée !");'; 
        echo 'window.location.href = "../frontend/profil.php";';
        echo '</script>';
    }
} else {
    header('Location: ../frontend/index.php');
}
$conn->close();