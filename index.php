<?php
include 'config.php';
// fehlende Klassen werden hier (on the fly) eingebunden
spl_autoload_register(function ($class){
    include 'class/' . $class . '.php';
});

//nur zum Testen
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

// Vereinfachung
$year = 2021;

// postVar Empfang
$id = $_POST['id'] ?? 0; // ist bzw. PK vom Week-Objekt
$action = $_POST['action'] ?? '';
$kw = $_POST['kw'] ?? 1;
$thema = $_POST['thema'] ?? '';
$eintrag = $_POST['eintrag'] ?? ['','','','','','','','','','']; // 10 Einträge pro Woche
$doz = $_POST['doz'] ?? [''];
$bem = $_POST['bem'] ?? '';

// week-Objekt aus Übergabevars erstellen
$postWeek = new Week($id, $kw, $thema, $doz[0], $bem, $eintrag);
//echo '<pre>'; print_r($postWeek); echo '</pre>';

// controller
// benötigt Week-Objekt $postWeek - mit den Daten aus der gesendeten Woche
//      und $action um die angeforderte Aktion auszuführen
switch ($action){
    case 'save':
        $postWeek->save();
        $requestWeek = $postWeek;
        break;
    case 'next':
        $postWeek->save();
        $requestWeek = $postWeek->getNextWeek($postWeek);
        break;
    case 'previous':
        $postWeek->save();
        $requestWeek = $postWeek->getPreviousWeek($postWeek);
        break;
    default:
        // leeres Objekte mit PK = null
        //$postWeek->save();
        $requestWeek = $postWeek->getLastOrStandardWeek($postWeek);
}

// aus $postWeek werden die anzuzeigenden Daten aufbereitet
// id ist PK
$id = $requestWeek->getId();
// Unterrichtsmodul
$thema = $requestWeek->getModul();
// Kalenderwoche Nummer
$weekNo = $requestWeek->getWeekNo();
// Tageseinträge
$eintrag = $requestWeek->getEntrys();
// Bememerkung
$bem = $requestWeek->getNotice();
// Dozent
$doz = $requestWeek->getDoz();

// Datum erstellen aus KW und Kalenderjahr für jeweiliges Tagesdatum
// Wochenzahl muss 2-stellig sein
if ($weekNo < 10){
    $weekNo2digits = '0' . $weekNo;
} else {
    $weekNo2digits = '' . $weekNo;
}
$timestamp_montag = strtotime("{$year}-W{$weekNo2digits}");
$date = new DateTime('@' . $timestamp_montag);
$date->add(new DateInterval('P1D'));
// Datum erzeugen bis Freitag
$datum = [];
//$date = new DateTime('2020-09-19');
array_push($datum, $date->format('d.m.Y'));
for ($i = 1; $i < 5; $i++){
    $date->add(new DateInterval('P1D'));
    array_push($datum,$date->format('d.m.Y'));
}

//Layoutwerte (für CSS)
$themaLeft = 400;
$themaKwTop = 355;
$kwLeft = 2100;
$datumLeft = 370;
$datumTop = 558;
$datumDiffTop = 155;
$eintragLeft = 570;
$eintragTop = 559;
$eintragDiffTop = 155;
$bemTop = 1400;
$dozLeft = 2000;
$dozTop = 599;

// Ausgabeseite einbinden
include 'view/oneweek.php';
?>
