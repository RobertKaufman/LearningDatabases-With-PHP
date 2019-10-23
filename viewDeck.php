<?php
require 'connect.php';

$singleTableQuery = "SELECT wins, losses, notes, opdeck FROM {$_POST['table_names']}";
    $singleTableStatement = $db->prepare($singleTableQuery);
    //$singleTableStatement->bindValue(':tableName', $tableNames);
    $singleTableStatement->execute();

    $wTable = $singleTableStatement->fetchAll();
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
      <?php print_r($wTable)?>

    <table class="table">
        <thead>
            <tr>
                <th>OP Deck</th>
                <th>Wins</th>
                <th>Losses</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($wTable as $row):?>
            <tr>
                <td scope="row"><?=$row['opdeck']?></td>
                <td><?=$row['wins']?></td>
                <td><?=$row['losses']?></td>
                <td><?=$row['notes']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>