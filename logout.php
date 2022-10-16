<?php
session_start();
unset($_SESSION["nameOfStudent"]);
unset($_SESSION["group"]);
unset($_SESSION["id"]);
unset($_SESSION["admin"]);
header('location: login.php');