<?php

enum Weekday: string
{
    case montag = 'montag';
    case dienstag = 'dienstag';
    case mittwoch = 'mittwoch';
    case donnerstag = 'donnerstag';
    case freitag = 'freitag';

}
//enum FruitName: string {
//    case APPLE = 'Apple';
//    case BANANA = 'Banana';
//    case ORANGE = 'Orange';
//}

// Die Variable mit dem Wert 'Apple'
$wochentag = 'montag';

// Überprüfen, ob der Wert in das Enum passt, und ein Enum-Objekt erstellen
if (in_array($wochentag, Weekday::values(), true)) {
    $tag = Weekday::$wochentag;
    echo "Enum-Objekt erstellt: $tag";
} else {
    echo "Ungültiger Wert für das Enum";
}
