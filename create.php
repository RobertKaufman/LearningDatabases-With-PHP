<?php
require 'connect.php';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$deckName = filter_input(INPUT_POST, 'deckname', FILTER_SANITIZE_SPECIAL_CHARS);
$wins = filter_input(INPUT_POST, 'wins', FILTER_SANITIZE_NUMBER_INT);
$losses = filter_input(INPUT_POST, 'losses', FILTER_SANITIZE_NUMBER_INT);
$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_SPECIAL_CHARS);
$opdeck = filter_input(INPUT_POST, 'opdeck', FILTER_SANITIZE_SPECIAL_CHARS);

function createTable($tableName, $db){
  $statement = <<<SQL
  CREATE OR REPLACE TABLE $tableName(deckKey INT(11) NOT NULL AUTO_INCREMENT, 
  wins INT(11), 
  losses INT(11),  
  notes VARCHAR(255), 
  opdeck VARCHAR(255),
  PRIMARY KEY (deckKey)
  ) ENGINE=InnoDB;
SQL;

  $createStatement = $db->prepare($statement);
  $createStatement->execute();

}
try{
    createTable($deckName, $db);
}
catch (PDOException $e)
{
    echo $e->getMessage();
}
?>