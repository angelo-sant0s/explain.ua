<?php

session_start();

if(!isset($_SESSION["role"]) && $_SESSION["role"] != 1){
    header("location: ../../public/index.php");
}