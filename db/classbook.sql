DROP DATABASE IF EXISTS classbook;
CREATE DATABASE classbook;
USE classbook;

-- DDL
CREATE TABLE calweek (
                         id INT PRIMARY KEY AUTO_INCREMENT,
                         weekNo INT NOT NULL,
                         module VARCHAR(45),
                         teacher VARCHAR(45),
                         notice VARCHAR(65));

CREATE TABLE lesson (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        calweekId INT,
                        weekday ENUM('montag', 'dienstag', 'mittwoch', 'donnerstag', 'freitag'),
                        amContent VARCHAR(65),
                        pmContent VARCHAR(65));

CREATE TABLE method (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(25));

CREATE TABLE method2lesson (
                               id INT PRIMARY KEY AUTO_INCREMENT,
                               lessonId INT,
                               methodId INT);

-- DML
INSERT INTO calweek VALUES(
                              NULL, 33, 'Datenbanken',
                              'Häckel', 'GR = Gruppenarbeit, SV = Schülervortrag'
                          );

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
                          'Zeile 4 123456789012345678901 234567890123456789012345678901234',
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

INSERT INTO method VALUES(NULL, 'frontalunterricht');
INSERT INTO method VALUES(NULL, 'projektarbeit');
INSERT INTO method VALUES(NULL, 'gruppenarbeit');
INSERT INTO method VALUES(NULL, 'selbstlernphase');

INSERT INTO method2lesson VALUES(NULL, 1, 1);
INSERT INTO method2lesson VALUES(NULL, 1, 2);
INSERT INTO method2lesson VALUES(NULL, 1, 3);
INSERT INTO method2lesson VALUES(NULL, 1, 4);
INSERT INTO method2lesson VALUES(NULL, 2, 1);
INSERT INTO method2lesson VALUES(NULL, 2, 3);
INSERT INTO method2lesson VALUES(NULL, 3, 2);
INSERT INTO method2lesson VALUES(NULL, 3, 3);
INSERT INTO method2lesson VALUES(NULL, 4, 4);
INSERT INTO method2lesson VALUES(NULL, 5, 2);
INSERT INTO method2lesson VALUES(NULL, 5, 3);


-- CONSTRAINTS
ALTER TABLE lesson ADD FOREIGN KEY (calweekId) REFERENCES calweek(id);
ALTER TABLE method2lesson ADD FOREIGN KEY (lessonId) REFERENCES lesson(id);
ALTER TABLE method2lesson ADD FOREIGN KEY (methodId) REFERENCES method(id);


-- CONTENT
SELECT * FROM calweek
                  LEFT JOIN lesson ON(calweekId=calweek.id)
                  LEFT JOIN method2lesson ON(lessonId=lesson.id)
                  LEFT JOIN method ON(methodId=method.id);
