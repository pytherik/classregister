DROP
DATABASE IF EXISTS buch;
CREATE
DATABASE buch;
USE
buch;

CREATE TABLE calweek (
    id INT PRIMARY KEY AUTO_INCREMENT,
    weekNo INT NOT NULL,
    module VARCHAR(45),
    teacher VARCHAR(45),
    notice VARCHAR(65));

INSERT INTO calweek VALUES(
                           NULL, 33, 'Datenbanken',
                           'Häckel', 'GR = Gruppenarbeit, SV = Schülervortrag'
                           );

CREATE TABLE lesson (
    id INT PRIMARY KEY AUTO_INCREMENT,
    calweekId INT,
    weekday ENUM('montag', 'dienstag', 'mittwoch', 'donnerstag', 'freitag'),
    amContent VARCHAR(65),
    pmContent VARCHAR(65));

INSERT INTO lesson VALUES(NULL,
                          1,
                          1,
                          'Zeile 0 123456789012345678901234567890123456789012345678901234',
                          'Zeile 1 123456789012345678901234567890123456789012345678901234'),
                       (NULL,
                          1,
                          2,
                          'Zeile 2 123456789012345678901234567890123456789012345678901234',
                          'Zeile 3 123456789012345678901234567890123456789012345678901234'),
                       (NULL,
                          1,
                          3,
                          'Zeile 4 123456789012345678901234567890123456789012345678901234',
                          'Zeile 5 123456789012345678901234567890123456789012345678901234'),
                       (NULL,
                          1,
                          4,
                          'Zeile 6 123456789012345678901234567890123456789012345678901234',
                          'Zeile 7 123456789012345678901234567890123456789012345678901234'),
                       (NULL,
                          1,
                          5,
                          'Zeile 8 123456789012345678901234567890123456789012345678901234',
                          'Zeile 9 123456789012345678901234567890123456789012345678901234');

ALTER TABLE lesson ADD FOREIGN KEY (calweekId) REFERENCES calweek(id);

select * from calweek join lesson on lesson.calweekId = calweek.id;