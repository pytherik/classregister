DROP DATABASE IF EXISTS classregister;
CREATE DATABASE classregister;
USE classregister;

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

CREATE TABLE method (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(65)
);

CREATE TABLE lesson2method (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lessonId INT,
    methodId INT
);

INSERT INTO method VALUES
                       (NULL, 'F'),
                       (NULL, 'P'),
                       (NULL, 'G'),
                       (NULL, 'S');

INSERT INTO lesson2method VALUES
                              (NULL, 1, 1),
                              (NULL, 1, 3),
                              (NULL, 2, 3),
                              (NULL, 2, 4),
                              (NULL, 3, 2),
                              (NULL, 3, 4),
                              (NULL, 4, 1),
                              (NULL, 4, 2),
                              (NULL, 4, 3),
                              (NULL, 4, 4),
                              (NULL, 5, 1),
                              (NULL, 5, 4);

ALTER TABLE lesson ADD FOREIGN KEY (calweekId) REFERENCES calweek(id);
ALTER TABLE lesson2method ADD FOREIGN KEY (lessonId) REFERENCES lesson(id),
ADD FOREIGN KEY (methodId) REFERENCES method(id);


select * from calweek join lesson on lesson.calweekId = calweek.id;
SELECT method.name FROM method
    JOIN lesson2method ON methodId=method.id
    JOIN lesson ON lessonId=lesson.id
                   WHERE lesson.id = 1;