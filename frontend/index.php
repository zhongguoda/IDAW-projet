<?php
$title = "Statistiques";
session_start();
require_once('template_header.php');
require_once('template_menu.php');
?>
<head>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.GFG{                 
    transform: scale(-1, 1);
    -moz-transform: scale(-1, 1);
    -webkit-transform: scale(-1, 1);
    -o-transform: scale(-1, 1);
    -ms-transform: scale(-1, 1);
    transform: scale(-1, 1);
}
</style>

</head>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div <?php if (isset($_SESSION["MAIL"]) && isset($_SESSION["MOT_DE_PASSE"])) echo 'class="row px-4"';?>>
            <div <?php if (isset($_SESSION["MAIL"]) && isset($_SESSION["MOT_DE_PASSE"])) echo 'class="column" style="float: left!important;"';?>>
            <h5 id="TStat">Apports journaliers moyens de nos utilisateurs :</h5><br>
            <p id="Stats"></p>
            </div>
            <?php 
                if (isset($_SESSION["MAIL"]) && isset($_SESSION["MOT_DE_PASSE"])){
                    echo '<div class="column" style="float: right!important; text-align: right!important;">
                    <h5 id="TStatM" style="direction: rtl;">Mes apports journaliers moyens :</h5><br>
                    <p id="Stats_moi"></p>
                    </div>';
                }
            ?>
        </div>
    </div>
</main>

<script>

var nb_mes_jours_mesure = ($.ajax({
method: "GET",
url: <?php echo $url;?>/getCOUNTMyDate.php",
global: false,
async:false,
})
.done((response) => {
    listType = JSON.parse(response);
    if (listType == 0 && document.getElementById("TStatM") != null) document.getElementById("TStatM").innerHTML = "";
    return listType;
}).responseText).replaceAll('"','');

var nb_jours_mesure;

$.ajax({
method: "GET",
url: <?php echo $url;?>/getCOUNTDISTINCTDate.php",
global: false,
async:false,
})
.done((response) => {
    listType = JSON.parse(response);
    var Date_par_mail = [];
    var res = 0;
    listType.forEach(function (NOM, i) {
    Date_par_mail.push(listType[i]["COUNT(DISTINCT a_mange.DATE)"]);
    });
    for(index in Date_par_mail) {
        res = res + parseInt(Date_par_mail[index].replaceAll('"',''));
    }
    if (listType == 0) document.getElementById("TStat").innerHTML = "";
    nb_jours_mesure = res;
});

$.ajax({
method: "GET",
url: <?php echo $url;?>/getAllRatios.php",
})
.done((response) => {
    listType = JSON.parse(response);
    var Type_ratio = [];
    var Somme_Type_ratio = [];
    listType.forEach(function (NOM, i) {
    Type_ratio.push(listType[i].TYPE_RATIO);
    Somme_Type_ratio.push(listType[i].VALEUR);
    });
    var valeurs_stats = "";
    for(index in Type_ratio) {
        valeurs_stats = valeurs_stats + Type_ratio[index] + " : " + (Somme_Type_ratio[index]/(parseInt(nb_jours_mesure))) + "<br>";
    }
    document.getElementById("Stats").innerHTML = valeurs_stats;
})
.catch(function (error) {
    console.log(error);
});

if (document.getElementById("Stats_moi") != null){
    $.ajax({
    method: "GET",
    url: <?php echo $url;?>/getMyRatios.php",
    })
    .done((response) => {
        listType = JSON.parse(response);
        var Type_ratio = [];
        var Somme_Type_ratio = [];
        listType.forEach(function (NOM, i) {
        Type_ratio.push(listType[i].TYPE_RATIO);
        Somme_Type_ratio.push(listType[i].VALEUR);
        });
        var valeurs_stats = "";
        for(index in Type_ratio) {
            valeurs_stats = valeurs_stats  + (Somme_Type_ratio[index]/(nb_mes_jours_mesure)) +  " : " +  Type_ratio[index] +  "<br>";
        }
        document.getElementById("Stats_moi").innerHTML = valeurs_stats;
    })
    .catch(function (error) {
        console.log(error);
    });
}
</script>

<?php
require_once('template_footer.php');
?>