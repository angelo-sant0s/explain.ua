<?php

session_start();

?>

<nav class="navbar sticky-top d-flex navbar-expand-md bgClaro">
    <a class="navbar-brand" href="home.html">
        <img src="imgs/logo.svg" alt="logo" class="img-fluid px-2" width="90px">
    </a>
    <div class="justify-content-center d-flex d-md-none justify-content-md-right">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.html"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-2x roxinho"></i>
    </button>
    <div class="collapse navbar-collapse d-md-flex justify-content-md-center" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
            <li class="nav-item">
                <a class="nav-link corazul" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="perfil.php">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cadeiras.php">Cadeiras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tickets.php">Ticket</a>
            </li>
            <li class="nav-item d-md-none pt-2">
                <a href="index.php"><i class="fas fa-sign-out-alt fa-2x roxinho"></i></a>
            </li>
        </ul>
    </div>
    <div class="justify-content-center d-none d-md-flex justify-content-md-right">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.html"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
</nav>
