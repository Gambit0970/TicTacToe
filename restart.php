<?php
  session_start(); // start the session if it hasn't been started already
  session_destroy();
  header('Location: index.php');
?>
