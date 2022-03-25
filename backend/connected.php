<?php
$title = "Menu";
require_once('template_header.php');

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_idaw_prast";

$crit_login="MAIL";
$crit_pwd="MOT_DE_PASSE";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname); //$sql = "SELECT MAIL, NOM, PRENOM, MOT_DE_PASSE FROM utilisateur";

$login = "anonymous";
$errorText = "";
$successfullyLogged = false;
if (isset($_SESSION["MAIL"])  && isset($_SESSION["MOT_DE_PASSE"])){
    $tryLogin=$_SESSION["MAIL"];
    $tryPwd=$_SESSION["MOT_DE_PASSE"];

    $sql = "SELECT login FROM utilisateur WHERE MAIL='$tryLogin' AND MOT_DE_PASSE='$tryPwd'";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        $successfullyLogged = true;
        $login = $tryLogin;
    }else{
        $errorText = "Erreur de login/password";
    }

} else if (isset($_POST['MAIL']) && isset($_POST['MOT_DE_PASSE'])){
    $tryLogin=$_POST['MAIL'];
    $tryPwd=$_POST['MOT_DE_PASSE'];
    // si login existe et password correspond
    $sql = "SELECT NOM FROM utilisateur WHERE MAIL='$tryLogin' AND MOT_DE_PASSE='$tryPwd'";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        $successfullyLogged = true;
        $login = $tryLogin;
    }else{
        $errorText = "Erreur de login/password";
    }
    } else
        header('Location: ../frontend/login.php');
if(!$successfullyLogged) {
echo $errorText;
} else {
$sql = "SELECT * FROM utilisateur WHERE MAIL='$tryLogin' AND MOT_DE_PASSE='$tryPwd'";
$result = $conn->query($sql)->fetch_assoc();
echo "<h1>Bienvenue ".$result["PRENOM"]." ".$result["NOM"]."</h1>";
echo '<form id="login_form" action="../frontend/login.php" method="POST"><table><td><input type="submit" value="Se déconnecter..." /></td></table></form>';
}

$conn->close();
require_once('template_footer.php');
?>