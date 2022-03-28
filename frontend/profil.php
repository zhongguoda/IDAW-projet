<?php
$title = "Mon compte";
session_start();
require_once('template_header.php');
if (!(isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"]))){
    header('Location: login.php');
}
require_once('template_menu.php');
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <form class="form-signin" action="../backend/editUser.php" method="POST">

        <input type="text" id="inputFName" class="form-control" placeholder="Prénom" value=<?php echo $_SESSION["PRENOM"]; ?> name="PRENOM" required autofocus>
        <input type="text" id="inputName" class="form-control" placeholder="Nom" value=<?php echo $_SESSION["NOM"]; ?> name="NOM" required>
        <input type="number" id="inputBDate" class="form-control" placeholder="Âge" value=<?php echo $_SESSION["AGE"]; ?> name="AGE" required>
        <br>
        <div>
            <label>Genre : </label>
            <input type="radio" id="inputSexe" name="ID_SEXE" value="1" <?php if ($_SESSION["ID_SEXE"]=="1") echo "checked"; ?>>
            <label>Homme</label>
            <input type="radio" id="inputSexe" name="ID_SEXE" value="2" <?php if ($_SESSION["ID_SEXE"]=="2") echo "checked"; ?>>
            <label>Femme</label>
        </div>
        <div>
            <label>Niveau de pratique sportive : </label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="1" <?php if ($_SESSION["ID_NIVEAU_DE_PRATIQUE_SPORTIVE"]=="1") echo "checked"; ?>>
            <label>Bas</label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="2" <?php if ($_SESSION["ID_NIVEAU_DE_PRATIQUE_SPORTIVE"]=="2") echo "checked"; ?>>
            <label>Moyen</label>
            <input type="radio" id="inputNPSportive" name="ID_NIVEAU_DE_PRATIQUE_SPORTIVE" value="3" <?php if ($_SESSION["ID_NIVEAU_DE_PRATIQUE_SPORTIVE"]=="3") echo "checked"; ?>>
            <label>Élevé</label>
        </div>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adresse Mail" value=<?php echo $_SESSION["MAIL"]; ?> name="MAIL" required>
        <input type="password" id="inputOldPassword" class="form-control" minlength="6" maxlength="50" placeholder="Ancien mot de passe" name="ANCIEN_MOT_DE_PASSE" required>
        <input type="password" id="inputNewPassword" class="form-control" minlength="6" maxlength="50" placeholder="Nouveau mot de passe" name="NOUVEAU_MOT_DE_PASSE" required><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Modifier...</button>
    </form>
    </div>
</main>
<?php
require_once('template_footer.php');
?>
