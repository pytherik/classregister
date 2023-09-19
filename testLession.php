<?php

declare(strict_types=1);

include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

$lession = new Lesson(1, 1, 'Montag', 'amc', 'pmc');

$test = $lession->update(
    1,
    'Maik',
    'maiki',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    ''
);

var_dump($test);