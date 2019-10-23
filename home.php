<?php
    require 'connect.php';
    //ref https://mariadb.com/kb/en/library/information-schema-tables-table/

    //fetches all the tables in the magicStats database
    $selectTablesStatement = <<<SQL
    select table_name
      from information_schema.tables
      where table_schema = 'magicstats'
        order by table_name;
SQL;

$selectThreeTablesStatement = <<<SQL
select table_name
  from information_schema.tables
  where table_schema = 'magicstats' LIMIT 5;
SQL;

function generateTableNamesArray($selectStatement, $db)
{

  $fetchedTables = $db->prepare($selectStatement);
  $fetchedTables->execute();
  $calledTables = $fetchedTables->fetchAll();
  $currentHashes = [];

  foreach($calledTables as $currentTable)
  {
    $currentHashes[] = $currentTable['table_name'];
  }

  return $currentHashes;
}

function generateTableData($tableNames, $db)
{
  //for each tableName in tableNames, do a pull for the Name, Wins, and Losses. Then generate a win rate based on that
  $singleTableQuery = "SELECT wins, losses FROM $tableNames";
  $singleTableStatement = $db->prepare($singleTableQuery);
  //$singleTableStatement->bindValue(':tableName', $tableNames);
  $singleTableStatement->execute();

  $returnValues = $singleTableStatement->fetchAll();
  return $returnValues;
}


    $preparedInsertStatement = $db->prepare($selectTablesStatement);
    $preparedInsertStatement->execute();
    $tableNames = $preparedInsertStatement->fetchAll()


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <h1><span class="badge badge-primary">Magic Stats for today!</span></h1>
      <div id='LastThree'><?php $generatedTables = generateTableNamesArray($selectThreeTablesStatement, $db);?>
      <p>Here are some stats on previously played decks<p>
          <p> <?php $generatedTables?> </p>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Wins</th>
                <th>Losses</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($generatedTables as $currentTable): ?>
              <?php $wData = generateTableData($currentTable, $db); ?>
                <td scope="row"><?=$currentTable?></td>
                <td><?= $wData[0]['wins']?></td>
                <td><?= $wData[0]['losses']?></td>
              </tr>
              <?php endforeach;?>
            </tbody>
          </table>
      </div>
      <div id='All-Decks'>
        <div class="form-group">
        <i class="fas fa-h1    ">dive deep into a single deck!</i>
        <form action='viewDeck.php' method='post'>
          <select class="form-control" name="table_names" id="table_names">
            <?php foreach($tableNames as $tableName): ?>
              <option value = <?=$tableName['table_name']?>><?= $tableName['table_name']?></option>
            <?php endforeach ?>
          </select>
          <input type="submit" value="Submit">
        </form>
        </div>
      </div>
    <i class="fas fa-divide    ">
    <div class="form-group">
    <form action='newdeck.php', method='post'>
        <label for="deckname">Deck Name:</label>
        <input type="text" class="form-control" name="deckname" id="deckname" aria-describedby="helpId" placeholder="">
        <label for="deckname">Wins</label>
        <input type="text" class="form-control" name="wins" id="wins" aria-describedby="helpId" placeholder="">
        <label for="deckname">losses</label>
        <input type="text" class="form-control" name="losses" id="losses" aria-describedby="helpId" placeholder="">
        <label for='notes'>Notes</label>
        <input type="text" class="form-control" name="notes" id="notes" aria-describedby="helpId" placeholder="">
        <label for='opdeck'>Opposing Deck</label>
        <input type='text' class="form-control" name="opdeck" id="opdeck" aria-describedby="helpId" placeholder="">
        <input type='submit' value='submit'>
        <small id="helpId" class="form-text text-muted">Help text</small>
      </form>
    </div>
    </i>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>