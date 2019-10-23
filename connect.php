<?php
    define('DB_DSN','mysql:host=localhost;dbname=magicstats;charset=utf8');
    define('DB_USER','rob');
    define('DB_PASS','Password01');     

    // Create a PDO object called $db.
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }
?>