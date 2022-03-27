<?php
$title = "Connexion";
session_start();
session_unset();
session_destroy();
require_once('template_header.php');
?>
<head>
  <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <form class="form-signin" action="../backend/connected.php" method="POST">
      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
      <input type="email" id="inputEmail" class="form-control" placeholder="Adresse Mail" name="MAIL" required autofocus>
      <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" name="MOT_DE_PASSE" required>
      <div class="BottomText login-bottom-text register hideable">
          Première fois sur iMangerMieux&nbsp;?
          <a href="inscription.php">S’inscrire</a>
        </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter...</button>
    </form>
  </body>
<?php
require_once('template_footer.php');
?>