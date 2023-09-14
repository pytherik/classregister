<?php
include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});


$mon = 'montag';

$t = new Lesson(1,1,$mon,'amc', 'pmc');

//print_r($t);
//
echo '<pre>';
print_r($t->getLessonsByCalWeekId(1));
echo '</pre>';

//$t->createLessons(1,
//    'm1', 'm2',
//    'd1',  'd2',
//    'm1','m2',
//    'd1', 'd2',
//    'f1', 'f2');
$t->update(1,
    'm1', 'm2',
    'd1',  'd2',
    'm1','m2',
    'd1', 'd2',
    'f1', 'f2');