<?php
include 'config.php';
// fehlende Klassen werden hier (on the fly) eingebunden
spl_autoload_register(function ($class){
    include 'class/' . $class . '.php';
});
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Vereinfachung
$year = 2020;

// postvar Empfang
$id = $_POST['id'] ?? 0;
$action = $_POST['action'] ?? '';
$kw = $_POST['kw'] ?? 1;
$thema = $_POST['thema'] ?? '';
$eintrag = $_POST['eintrag'] ?? [];
$doz = $_POST['doz'] ?? [];
$bem = $_POST['bem'] ?? '';
// bisher nur 1 Dozent pro Klassenbuch vorgesehen
if (count($doz) === 0){
    $doz[0] = '';
}

// week-Ojekt aus Übergabevars erstellen
$postWeek = new Week($id, $kw, $thema, $doz[0], $bem, $eintrag);

// controller
switch ($action){
    case 'save':
        // Übergabewoche
        $postWeek->save();
        // neu auszugebende Woche
        $newWeek = Week::getByWeekNo($kw);
        break;
    case 'next':
        $postWeek->save();
        $newWeek = Week::getByWeekNo($kw + 1);
        break;
    case 'previous':
        $postWeek->save();
        $newWeek = Week::getByWeekNo($kw - 1);
        break;
    default:
        $newWeek = Week::getByWeekNo();
}

$weekNo = $newWeek->getWeekNo();

// Datum erstellen aus KW und Kalenderjahr
$timestamp_montag = strtotime("{$year}-W{$weekNo}");
$date = new DateTime('@' . $timestamp_montag);
$date->add(new DateInterval('P1D'));

$week = Week::getByWeekNo($weekNo);
// Kalenderwoche Nummer
$weekNo = $week->getWeekNo();
// Tageseinträge
$eintrag = $week->getEntrys();
// Bememerkung
$bem = $week->getNotice();
// Dozent
$doz = $week->getDoz();

// Inhalte
// Datum erzeugwn bis Freitag
$datum = [];
//$date = new DateTime('2020-09-19');
array_push($datum,$date->format('d.m.Y'));
for ($i = 1; $i < 5; $i++){
    $date->add(new DateInterval('P1D'));
    array_push($datum,$date->format('d.m.Y'));
}

// Thema
$thema = $week->getModul();
// Kalenderwoche Nummer
$weekNo = $week->getWeekNo();
// Tageseinträge
$eintrag = $week->getEntrys();
// Bememerkung
$bem = $week->getNotice();
// Dozent
$doz = $week->getDoz();

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

include 'view/oneweek.php';
?>
