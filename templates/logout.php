<?php
session_start();

session_destroy();

Location: header('Location: main.php');
exit();
?>