<?php
$title = "Journal";
session_start();
require_once('template_header.php');
if (!(isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"]))){
    header('Location: login.php');
}
require_once('template_menu.php');
?>

<?php
require_once('template_footer.php');
?>