<?php
include 'config.php';
// fehlende Klassen werden hier (on the fly) eingebunden
spl_autoload_register(function ($class){
    include 'class/' . $class . '.php';
});
$year = 2020;
$weekNo = 33;
// Datum erstellen aus KW und Kalenderjahr
$timestamp_montag = strtotime("{$year}-W{$weekNo}");
$date = new DateTime('@' . $timestamp_montag);
$date->add(new DateInterval('P1D'));
//echo $dt->format('d.m.Y');
////$dt->setIsoDate($year, $weekNo);
//echo '<pre>';
//print_r($dt);
//echo '</pre>';

$week = Week::getByWeekNo($weekNo);
// Kalenderwoche Nummer
$weekNo = $week->getWeek();
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
// Kalenderwoche Nummer
$weekNo = $week->getWeek();
// Tageseinträge
$eintrag = $week->getEntrys();
// Bememerkung
$bem = $week->getNotice();
// Dozent
$doz = $week->getDoz();

//Layoutwerte
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
