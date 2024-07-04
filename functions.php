<?php

// functions.php

function connect_to_db()
{
  $dbn='mysql:dbname=tenshokukanri_01;charset=utf8mb4;port=3308;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:'.$e->getMessage());
  }
}

?>



