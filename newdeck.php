<?php
    require 'create.php';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$deckName = filter_input(INPUT_POST, 'deckname', FILTER_SANITIZE_SPECIAL_CHARS);
$wins = filter_input(INPUT_POST, 'wins', FILTER_SANITIZE_NUMBER_INT);
$losses = filter_input(INPUT_POST, 'losses', FILTER_SANITIZE_NUMBER_INT);
$comments = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_SPECIAL_CHARS);
$opdeck = filter_input(INPUT_POST, 'opdeck', FILTER_SANITIZE_SPECIAL_CHARS);
$insertResult = "";

try{
  $statement = "INSERT INTO $deckName (deckKey, wins, losses, notes, opdeck) VALUES (NULL, :wins, :losses, :notes, :opdeck)";
  $insert = $db->prepare($statement);
  $insert->bindValue(':wins', $wins);
  $insert->bindValue(':losses', $losses);
  $insert->bindValue(':notes', $comments);
  $insert->bindValue(':opdeck', $opdeck);
  

  $insert->execute();
  $insertResult = 'Success!';
}
catch (PDOException $e){
  echo $e->getMessage();
  $insertResult = 'Failure';
 }
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
      <p>Update Status : <?= $insertResult?>/p>
      <<button class="btn">
              Notification <span class="badge badge-primary"></span>
      </button>
      <p><a href='home.php'>Go home?</p>
      <p><?=print_r($_POST)?></p>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>