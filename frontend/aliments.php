<?php
$title = "Aliments";
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
    url: "../backend/getAllAliments.php",
  })
    .done((response) => {
      list = JSON.parse(response);
      list.forEach(function (ID_ALIMENT, i) {
        arr.push([list[i].ID_ALIMENT, list[i].NOM, list[i].TYPE_ALIMENT]);
      });
      $('#example').DataTable( {
        data: arr,
        columns: [
            { title: "Référence" },
            { title: "Aliment" },
            { title: "Type d'aliment" }
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
        <button id="myBtnSuppr" class="btn btn-outline-danger float-right add-model" style="margin-bottom:10px; margin-left:10px;">Supprimer un aliment</button>
        <button id="myBtnModif" class="btn btn-outline-warning float-right add-model" style="margin-bottom:10px; margin-left:10px;">Modifier un aliment</button>
        <button id="myBtnAjout" class="btn btn-outline-success float-right add-model" style="margin-bottom:10px; margin-left:10px;">Ajouter un aliment</button>
    </div>
    <!-- The Modal -->
    <div id="myModalAjout" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action="../backend/addAliment.php" method="POST">
        <h2 style="text-align:center;">Ajouter un aliment</h2>
        <input type="text" id="inputFName" class="form-control" placeholder="Nom de l'aliment" name="NOM" required autofocus>
        <br><label>Type d'aliment : </label>
        <select class="form-control" name="ID_TYPE_ALIMENT" id="rec_mode">
        <script>
            $.ajax({
            method: "GET",
            url: "../backend/getAllAlimentsTypes.php",
          })
            .done((response) => {
              listType = JSON.parse(response);
              var select = document.getElementById("rec_mode");
              var Types = [];
              var ID_Types = [];
              listType.forEach(function (ID_TYPE_ALIMENT, i) {
                Types.push(listType[i].TYPE_ALIMENT);
                ID_Types.push(listType[i].ID_TYPE_ALIMENT);
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
      <button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter l'aliment...</button>
    </form>
    </div>
    </div>

    <!-- The Modal -->
    <div id="myModalModif" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action="../backend/editAliment.php" method="POST">
        <h2 style="text-align:center;">Modifier un aliment</h2>
        <input type="text" id="inputFName" class="form-control" placeholder="Référence de l'aliment à modifier" name="ID_ALIMENT" required autofocus><br>
        <h6 style="text-align:center;">(Laisser vide les champs que vous ne souhaitez pas modifier !)</h6>
        <input type="text" id="inputFName" class="form-control" placeholder="Nom de l'aliment" name="NOM" required autofocus>
        <br><label>Type d'aliment : </label>
        <select class="form-control" name="ID_TYPE_ALIMENT" id="rec_mode2">
        <script>
            $.ajax({
            method: "GET",
            url: "../backend/getAllAlimentsTypes.php",
          })
            .done((response) => {
              listTypeM = JSON.parse(response);
              var select = document.getElementById("rec_mode2");
              var TypesM = [];
              var ID_TypesM = [];
              listTypeM.forEach(function (ID_TYPE_ALIMENT, i) {
                TypesM.push(listTypeM[i].TYPE_ALIMENT);
                ID_TypesM.push(listTypeM[i].ID_TYPE_ALIMENT);
              });
              select.options[select.options.length] = new Option("PAS DE MODIFICATION", -1);
              for(index in TypesM) {
                  select.options[select.options.length] = new Option(TypesM[index], ID_TypesM[index]);
              }
            })
            .catch(function (error) {
              console.log(error);
            });
            
          </script>        
        </select><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Modifier l'aliment...</button>
    </form>
    </div>
    </div>

    <!-- The Modal -->
    <div id="myModalSuppr" class="modal col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close"></span>
        <form class="form-signin" action="../backend/deleteAliment.php" method="POST">
        <h2 style="text-align:center;">Supprimer un aliment</h2>
        <input type="text" id="inputFName" class="form-control" placeholder="Référence de l'aliment à supprimer" name="ID_ALIMENT" required autofocus>
        <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Supprimer l'aliment...</button>
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