<?php
session_start();

session_destroy();
require_once('../index.php');

Location: header('Location: index.php');
exit();
?>