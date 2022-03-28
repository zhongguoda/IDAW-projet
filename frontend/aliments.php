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
</head>
<?php
require_once('template_menu.php');
?>
<script>
var list = new Array();
var arr = [];
function displayTab() {
    $("#studentsTableBody tr").remove();
    list.forEach(function (ID_ALIMENT, i) {
        $("#studentsTableBody").append(
        `<tr id="row${i}">
                        <td id="ID_ALIMENT${i}">${list[i].ID_ALIMENT}</td>
                        <td id="NOM${i}">${list[i].NOM}</td>
                        <td id="ID_TYPE_ALIMENT${i}">${list[i].ID_TYPE_ALIMENT}</td>
                        <td>
                            <button class="edit btn btn-sm btn-outline-success" onclick="updateRow(${list[i].ID_ALIMENT}, ${i})">Update</button>
                            <button class="delete btn btn-sm btn-outline-danger" onclick="deleteRow(this, ${list[i].ID_ALIMENT})">Delete</button>
                        </td>
                    </tr>`
        );
    });
}

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
            //{ title: "Option" }
        ]
    } );
      //displayTab();
    })
    .catch(function (error) {
      console.log(error);
    });
}
</script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <table id="example" class="display" width="100%"></table>
    </div>
</main>
<?php
require_once('template_footer.php');
//header('Location: ../backend/aliments.php');
?>
