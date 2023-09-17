<?php

include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});


$id = $_POST['id'] ?? 0; // ist bzw. PK vom Week-Objekt
$action = $_POST['action'] ?? '';
$kw = $_POST['kw'] ?? 1;
$module = $_POST['module'] ?? ''; // vorher $thema
$lessons = $_POST['lessons'] ?? ['', '', '', '', '', '', '', '', '', '']; // vorher $eintrag -- 10 Einträge pro Woche
$teacher = $_POST['teacher'] ?? ['']; // vorher $doz
$notice = $_POST['notice'] ?? ''; // vorher $bem
$methods = [
  $_POST['method0'] ?? [],
  $_POST['method1'] ?? [],
  $_POST['method2'] ?? [],
  $_POST['method3'] ?? [],
  $_POST['method4'] ?? []];

// week-Objekt aus Übergabevars erstellen
$postWeek = new Week($id, $kw, $module, $teacher[0], $notice, $lessons, $methods);

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
$module = $requestWeek->getModule();
// Kalenderwoche Nummer
$weekNo = $requestWeek->getWeekNo();
// Tageseinträge
$lessons = $requestWeek->getLessonsByCalWeekId();
// Bememerkung
$notice = $requestWeek->getNotice();
// Dozent
$teacher = $requestWeek->getTeacher();

$methods = $requestWeek->getMethodsByCalWeekId();

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

// Ausgabeseite einbinden
include 'view/oneweek.php';

