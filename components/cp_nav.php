<?php

session_start();





?>

<nav class="navbar sticky-top d-flex navbar-expand-md bgClaro justify-content-between" id="navchat">
    <a class="navbar-brand" href="home.php">
        <img src="imgs/logo.svg" alt="logo" class="img-fluid px-2" width="90px">
    </a>
    <div class="justify-content-center d-flex d-md-none">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.php"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-2x roxinho"></i>
    </button>
    <div class="collapse navbar-collapse d-md-flex justify-content-md-center" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <?php
if(isset($_SESSION["username"])) {
    $session = $_SESSION["username"];
    $userid = $_SESSION["user_id"];
    ?>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $session ?>
                </a>
                <div class="dropdown-menu text-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="perfil.php?id=<?=$userid?>">Perfil</a>
                    <?php if($_SESSION["role"] == 3){
                        echo "<a class='dropdown-item' href='admin/pages/index.php'>Ferramenta de Administração</a>";
                    }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="scripts/sc_logout.php">Terminar Sessão</a>
                </div>
            </li>

         <?php }else{
              header("Location: index.php?msg=3");
    echo "bola";

}

            ?>
            <li class="nav-item">
                <a class="nav-link" href="cadeiras.php">Cadeiras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tickets.php">Ticket</a>
            </li>
        </ul>
    </div>
    <div class="justify-content-center d-none d-md-flex justify-content-md-right">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.php?id=<?=$userid?>"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
</nav>
