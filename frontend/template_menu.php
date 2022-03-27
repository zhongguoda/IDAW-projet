<head>
    <link href="css/dashboard.css" rel="stylesheet">
</head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" style="font-family: Segoe Script;">iMangerMieux</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <?php
                if (isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"])){
                    echo '<a class="nav-link" href="../backend/logout.php">Se déconnecter...</a>';
                } else {
                    echo '<a class="nav-link" href="login.php">Se connecter...</a>';
                }
            ?>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <!--<li class="nav-item">
                <a <?php if ($title == "Accueil") echo 'class="nav-link active"'; else echo 'class="nav-link"'; ?> href="index.php"><span data-feather="home"></span>Accueil</a>
              <li class="nav-item">-->
                <a <?php if ($title == "Statistiques") echo 'class="nav-link active"'; else echo 'class="nav-link"'; ?> href="index.php"><span data-feather="bar-chart-2"></span>Statistiques</a>
              </li>
              <?php
                    if (isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"])){
                        if ($title == "Journal"){
                            echo '<li class="nav-item"><a class="nav-link active" href="journal.php"><span data-feather="book"></span>Journal</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="journal.php"><span data-feather="book"></span>Journal</a></li>';
                        }
                    }
              ?>
              <?php
                    if (isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"])){
                        if ($title == "Aliments"){
                            echo '<li class="nav-item"><a class="nav-link active" href="aliments.php"><span data-feather="database"></span>Aliments</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="aliments.php"><span data-feather="database"></span>Aliments</a></li>';
                        }
                    }
              ?>
               <?php
                    if (isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"])){
                        if ($title == "Mon compte"){
                            echo '<li class="nav-item"><a class="nav-link active" href="profil.php"><span data-feather="user"></span>Mon compte</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="profil.php"><span data-feather="user"></span>Mon compte</a></li>';
                        }
                    }
              ?>
            </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo $title; ?></h1>
          </div>
        </main>
      </div>
    </div>
        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace()
        </script>