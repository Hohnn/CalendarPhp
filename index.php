<?php
setlocale(LC_TIME, "fr_FR", "fra");
$date = new DateTime();
if (isset($_GET['month']) && isset($_GET['year'])) {
    $inputMonth = $_GET['month'];
    $inputyear = $_GET['year'];
    $dateChose = utf8_encode( strftime('%B %Y', strtotime("$inputMonth/02/$inputyear")));
    $firstDay = date("N", mktime(0,0,0,$inputMonth,1,$inputyear));
    $target = mktime(0,0,0,$inputMonth,1,$inputyear);
} else {
    $dateChose = strftime('%B %Y');
    $firstDay = date("N", mktime(0,0,0,6,1,2021));
    $target = time();
}
//paque + 39 
$ferier = ['1/01'=>'Jour de l\'An', '13/04'=>'Pâques', '1/05'=>'Fête du Travail','08/05'=>'Victoire des Alliés', '21/05'=>'Ascension',  '1/06'=>'Pentecôte', '14/07'=>'Fête nationale','15/08'=>'Assomption','1/11'=>'Toussaint', '11/11'=>'Armistice', '25/12'=>'Noël'];

function showDays($offset, $target){
    global $inputMonth, $ferier;
    $lengthMonth = date("t", $target);
    if ($offset > 5 ) {
        for ($i=1; $i <= 42; $i++) {
            $class ='';
            $classNot = "";
            $start =  $i - $offset + 1 ;
            if ($start <= 0) {
                $start = '';
                $classNot = "not";
            } elseif ($start > $lengthMonth) {
                $start = '';
                $classNot = "not";
            }
            $info = '';
            if (array_key_exists("$start/$inputMonth", $ferier)) {
                $info = $ferier["$start/$inputMonth"];
                $class = "ferier";
            }
            ?>
                <div class="box bg-dark<?=  $class ?> <?=  $classNot ?>">
                    <div class="number "><?= $start ?></div>
                    <div class="info"><?= $info ?></div>
                </div>
            <?php
        }
        return false;
    }
    for ($i=1; $i <= 35; $i++) {
        $class ='';
        $classNot = "";
        $start =  $i - $offset + 1 ;
        if ($start <= 0) {
            $start = '';
            $classNot = "not";
        } elseif ($start > $lengthMonth) {
            $start = '';
            $classNot = "not";
        }
        $info = '';
        if (array_key_exists("$start/$inputMonth", $ferier)) {
            $info = $ferier["$start/$inputMonth"];
            $class = "ferier";
        }
        ?>
            <div class="box bg-dark<?=  $class ?> <?=  $classNot ?>">
                <div class="number "><?= $start ?></div>
                <div class="info"><?= $info ?></div>
            </div>
        <?php
    }
}

function isSelectMonth($params){
    if (isset($_GET['month'])) {
        if ($_GET['month'] == $params) {
            return 'selected';
        }
    }
}
function isSelectYear($params){
    if (isset($_GET['year'])) {
        if ($_GET['year'] == $params) {
            return 'selected';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">    
    <title>Calendrier</title>
</head>
<body class="accueil bg-dark">
    <h1 class="mb-1 mt-5">CALENDRIER GENERATOR</h1>
    <h5 class="my-4">Générer votre calendrier</h5>
    <div class="myForm p-3">
        <form action="index.php" method="get">
        <div class="mb-3">
            <label for="month">Mois</label>
            <select class="form-select" id="month" aria-label="Default select example" name="month">
                <option selected disabled hidden>Choisir un mois</option>
                <option <?= isSelectMonth(1)?> value="01">janvier</option>
                <option <?= isSelectMonth(2)?> value="02">février</option>
                <option <?= isSelectMonth(3)?> value="03">mars</option>
                <option <?= isSelectMonth(4)?> value="04">avril</option>
                <option <?= isSelectMonth(5)?> value="05">mai</option>
                <option <?= isSelectMonth(6)?> value="06">juin</option>
                <option <?= isSelectMonth(7)?> value="07">juillet</option>
                <option <?= isSelectMonth(8)?> value="08">août</option>
                <option <?= isSelectMonth(9)?> value="09">septembre</option>
                <option <?= isSelectMonth(10)?> value="10">octobre</option>
                <option <?= isSelectMonth(11)?> value="11">novembre</option>
                <option <?= isSelectMonth(12)?> value="12">décembre</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="year">Année</label>
            <select class="form-select" id="year" aria-label="Default select example" name="year">
                <option selected disabled hidden>Choisir une année</option>
                <option <?= isSelectYear(2015) ?> value="2015">2015</option>
                <option <?= isSelectYear(2016) ?> value="2016">2016</option>
                <option <?= isSelectYear(2017) ?> value="2017">2017</option>
                <option <?= isSelectYear(2018) ?> value="2018">2018</option>
                <option <?= isSelectYear(2019) ?> value="2019">2019</option>
                <option <?= isSelectYear(2020) ?> value="2020">2020</option>
                <option <?= isSelectYear(2021) ?> value="2021">2021</option>
                <option <?= isSelectYear(2022) ?> value="2022">2022</option>
                <option <?= isSelectYear(2023) ?> value="2023">2023</option>
                <option <?= isSelectYear(2024) ?> value="2024">2024</option>
                <option <?= isSelectYear(2025) ?> value="2025">2025</option>
            </select>
        </div>
        <button class="btn btn-primary" type="submit" id="btn">Afficher</button>
        </form>
    </div>

    <div class="calendar">
        <h2><?= $dateChose ?></h2>
        <div class="days">
            <div class="jour">Lundi</div>
            <div class="jour">Mardi</div>
            <div class="jour">Mercredi</div>
            <div class="jour">Jeudi</div>
            <div class="jour">Vendredi</div>
            <div class="jour">Samedi</div>
            <div class="jour">Dimanche</div>
        </div>
        <div class="core">
            <?= showDays($firstDay, $target) ?>
        </div>
    </div>
</body>
</html>