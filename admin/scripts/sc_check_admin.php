<?php

session_start();

if(!isset($_SESSION["role"])){
   header("location: ../../index.php");
}else if(isset($_SESSION["role"]) && $_SESSION["role"] != 3){
    header("location: ./../home.php");
}