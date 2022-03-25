<?php
$title = "testConnexion";
require_once('template_header.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_idaw_prast";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT MAIL, NOM, PRENOM, MOT_DE_PASSE FROM utilisateur";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // output data of each row
    echo '<table><tr><th>MAIL</th><th>NOM</th><th>PRENOM</th><th>MOT_DE_PASSE</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo '</tr><td>';
        echo $row["MAIL"];
        echo '</td>';
        echo '<td>';
        echo $row["NOM"];
        echo '</td>';
        echo '<td>';
        echo $row["PRENOM"];
        echo '</td>';
        echo '<td>';
        echo $row["MOT_DE_PASSE"];
        echo '</td></tr>';
    }
    echo '</table>';
  } else {
    echo "0 results";
  }
  $conn->close();
  require_once('template_footer.php');
?>