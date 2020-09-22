<?php
/*
 * Design Pattern Singleton
 * man möchte nur 1 Objekt in der Klasse haben
 */

class Db
{
    private static object $dbh;
    public static function getConnection() : object
    {
        if (!isset(self::$dbh)) {
            /* Connect to a MySQL database using driver invocation */
            try {
                self::$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWD); // $dbh data base handle / handle = Resource
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return self::$dbh;
    }
}