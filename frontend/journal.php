<?php
$title = "Journal";
session_start();
require_once('template_header.php');
if (!(isset($_SESSION["NOM"])  && isset($_SESSION["PRENOM"]))){
    header('Location: login.php');
}
?>
<head>
    <meta charset="UTF-8"> <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            getData();
        });
    </script>

<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  margin-top:180px;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

</head>
<?php
require_once('template_menu.php');
?>
<script>

var list = new Array();
var arr = [];

function getData() {
  $.ajax({
    method: "GET",
    url: <?php echo $url;?>/getAllRepas.php",
  })
    .done((response) => {
      list = JSON.parse(response);
      list.forEach(function (ID_REPAS, i) {
        arr.push([list[i].ID_REPAS, list[i].NOM, list[i].QUANTITE, list[i].DATE]);
      });
      $('#example').DataTable( {
        data: arr,
        columns: [
            { title: "Référence" },
            { title: "Aliment" },
            { title: "Quantité (en g)" },
            { title: "Date" }
        ]
    } );
    })
    .catch(function (error) {
      console.log(error);
    });
}

</script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <div class="page-header clearfix">
        <button id="myBtnSuppr" class="btn btn-outline-danger float-right add-model" style="margin-bottom:10px; margin-left:10px;">Supprimer un repas</button>
        <button id="myBtnModif" class="btn btn-outline-warning float-right add-model" style="margin-bottom:10px; margin-left:10px;">Modifier un repas</button>
        <button id="myBtnAjout" class="btn btn-outline-success float-right add-model" style="margin-bottom:10px; margin-left:10px;">Ajouter un repas</button>
    </div>
    <!-- The Modal -->
    <div id="myModalAjout" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action=<?php echo $url;?>/addRepas.php" method="POST">
        <h2 style="text-align:center;">Ajouter un repas</h2>
        <label>Nom de l'aliment : </label>
        <select class="form-control" name="ID_ALIMENT" id="rec_mode">
        <script>
            $.ajax({
            method: "GET",
            url: <?php echo $url;?>/getAllAliments.php",
          })
            .done((response) => {
              listType = JSON.parse(response);
              var select = document.getElementById("rec_mode");
              var Types = [];
              var ID_Types = [];
              listType.forEach(function (NOM, i) {
                Types.push(listType[i].NOM);
                ID_Types.push(listType[i].ID_ALIMENT);
              });
              for(index in Types) {
                  select.options[select.options.length] = new Option(Types[index], ID_Types[index]);
              }
            })
            .catch(function (error) {
              console.log(error);
            });
          </script>        
        </select><br>
        <label>Quantité (en grammes) : </label>
        <input type="number" id="inputFName" class="form-control" name="QUANTITE" min="0" max="10000" step="1" required>
        <br>
        <label>Date à laquelle le repas a été consommé : </label>
        <input type="date" id="inputFName" class="form-control" <?php echo "value=" . date("Y-m-d"); ?> name="DATE" required>
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter le repas...</button>
    </form>
    </div>
    </div>

    <!-- The Modal -->
    <div id="myModalModif" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action=<?php echo $url;?>/editRepas.php" method="POST">
        <h2 style="text-align:center;">Modifier un repas</h2>
        <input type="text" id="inputFName" class="form-control" placeholder="Référence du repas à modifier" name="ID_REPAS" required autofocus><br>
        <label>Nom de l'aliment : </label>
        <select class="form-control" name="ID_ALIMENT" id="rec_mode2">
        <script>
            $.ajax({
            method: "GET",
            url: <?php echo $url;?>/getAllAliments.php",
          })
            .done((response) => {
              listType = JSON.parse(response);
              var select = document.getElementById("rec_mode2");
              var Types = [];
              var ID_Types = [];
              listType.forEach(function (NOM, i) {
                Types.push(listType[i].NOM);
                ID_Types.push(listType[i].ID_ALIMENT);
              });
              for(index in Types) {
                  select.options[select.options.length] = new Option(Types[index], ID_Types[index]);
              }
            })
            .catch(function (error) {
              console.log(error);
            });
          </script>        
        </select><br>
        <label>Quantité (en grammes) : </label>
        <input type="number" id="inputFName" class="form-control" name="QUANTITE" min="0" max="10000" step="1" required>
        <br>
        <label>Date à laquelle le repas a été consommé : </label>
        <input type="date" id="inputFName" class="form-control" <?php echo "value=" . date("Y-m-d"); ?> name="DATE" required>
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Modifier le repas...</button>
    </form>
    </div>
    </div>

    <!-- The Modal -->
    <div id="myModalSuppr" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action=<?php echo $url;?>/deleteRepas.php" method="POST">
        <h2 style="text-align:center;">Supprimer un repas</h2>
        <input type="text" id="inputFName" class="form-control" placeholder="Référence du repas à supprimer" name="ID_REPAS" required autofocus>
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Supprimer le repas...</button>
    </form>
    </div>

    </div>
    <table id="example" class="display" width="100%"></table>
    </div>
</main>

<script>
// Get the modal
var modalAjout = document.getElementById("myModalAjout");

// Get the button that opens the modal
var btnAjout = document.getElementById("myBtnAjout");

// Get the <span> element that closes the modal
var spanAjout = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btnAjout.onclick = function() {
  modalAjout.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanAjout.onclick = function() {
  modalAjout.style.display = "none";
}

// Get the modal
var modalModif = document.getElementById("myModalModif");

// Get the button that opens the modal
var btnModif = document.getElementById("myBtnModif");

// Get the <span> element that closes the modal
var spanModif = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btnModif.onclick = function() {
  modalModif.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanModif.onclick = function() {
  modalModif.style.display = "none";
}

// Get the modal
var modalSuppr = document.getElementById("myModalSuppr");

// Get the button that opens the modal
var btnSuppr = document.getElementById("myBtnSuppr");

// Get the <span> element that closes the modal
var spanSuppr = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btnSuppr.onclick = function() {
  modalSuppr.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanSuppr.onclick = function() {
  modalSuppr.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalSuppr || event.target == modalAjout || event.target == modalModif) {
    modalSuppr.style.display = "none";
    modalAjout.style.display = "none";
    modalModif.style.display = "none";
  }
}
</script>

<?php
require_once('template_footer.php');
?>