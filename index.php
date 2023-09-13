<?php

include 'config.local.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

//nur zum Testen
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

// postVar Empfang
$id = $_POST['id'] ?? 0; // ist bzw. PK vom Week-Objekt
$action = $_POST['action'] ?? '';
$kw = $_POST['kw'] ?? 1;
$thema = $_POST['thema'] ?? '';
$eintrag = $_POST['eintrag'] ?? ['', '', '', '', '', '', '', '', '', '']; // 10 Einträge pro Woche
$doz = $_POST['doz'] ?? [''];
$bem = $_POST['bem'] ?? '';

// week-Objekt aus Übergabevars erstellen
$postWeek = new Week($id, $kw, $thema, $doz[0], $bem, $eintrag);

// controller
// benötigt Week-Objekt $postWeek - mit den Daten aus der gesendeten Woche
//      und $action um die angeforderte Aktion auszuführen
switch ($action) {
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
$thema = $requestWeek->getModule();
// Kalenderwoche Nummer
$weekNo = $requestWeek->getWeekNo();
// Tageseinträge
$eintrag = $requestWeek->getLessons();
// Bememerkung
$bem = $requestWeek->getNotice();
// Dozent
$doz = $requestWeek->getTeachers();

// Datum erstellen aus KW und Kalenderjahr für jeweiliges Tagesdatum
// Wochenzahl muss 2-stellig sein
if ($weekNo < 10) {
    $weekNo2digits = '0' . $weekNo;
} else {
    $weekNo2digits = '' . $weekNo;
}

// Datum erzeugen bis Freitag
$datum = [];
if ($weekNo == 1) {
    $date = DateHelper::getFirstMondayInYear(YEAR);
} else {
    $date = DateHelper::getFirstMondayInYear(YEAR)
      ->add(new DateInterval('P'. $weekNo-1 . 'W'));

}

array_push($datum, $date->format('d.m.Y'));
for ($i = 1; $i < 5; $i++) {
    $date->add(new DateInterval('P1D'));
    array_push($datum, $date->format('d.m.Y'));
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

