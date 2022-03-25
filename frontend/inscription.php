<head>
<link href="css/min.css" rel="stylesheet">
<link href="css/signin.css" rel="stylesheet">
</head>
<?php
$title = "Inscription";
session_start();
session_unset();
session_destroy();
require_once('template_header.php');
?>
<body class="text-center">
    <form class="form-signin" action="../backend/addUser.php" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Inscription</h1>

        <input type="text" id="inputFName" class="form-control" placeholder="Prénom" name="PRENOM" required autofocus>
        <input type="text" id="inputName" class="form-control" placeholder="Nom" name="NOM" required>
        <input type="number" id="inputBDate" class="form-control" placeholder="Âge" name="AGE" required>
        <br>
        <div>
            <label>Genre : </label>
            <input type="radio" id="inputSexe" name="ID_SEXE" value="1"checked>
            <label>Homme</label>
            <input type="radio" id="inputSexe" name="ID_SEXE" value="2">
            <label>Femme</label>
        </div>
        <div>
            <label>Genre : </label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="1"checked>
            <label>Bas</label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="2">
            <label>Moyen</label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="3">
            <label>Élevé</label>
        </div>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adresse Mail" name="MAIL" required>
        <input type="password" id="inputPassword" class="form-control" minlength="6" maxlength="50" placeholder="Mot de passe" name="MOT_DE_PASSE" required>
        <div class="BottomText login-bottom-text register hideable">
            Déjà sur iMangerMieux&nbsp;?
            <a href="login.php">Se connecter...</a>
        </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire...</button>
    </form>
  </body>
<?php
require_once('template_footer.php');
?>