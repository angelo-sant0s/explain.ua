<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Cadeiras por semestre</title>
</head>
<body class="bkk-color">

<?php include_once "components/cp_nav.php"; ?>
<?php
require_once "connections/connections.php";

$check=0;
if (isset($_SESSION["username"])) {
    $user = $_SESSION["username"];
    $check=1;
}



if (isset($_GET["ano"])) {
    $ano = $_GET["ano"];
}


if($ano==1){
    $semestre1=1;
    $semestre2=2;
}
if($ano==2){
    $semestre1=3;
    $semestre2=4;
}
if($ano==3){
    $semestre1=5;
    $semestre2=6;
}


$link= new_db_connection();
$statement=mysqli_stmt_init($link);


$querry="SELECT cadeira.nome, cadeira.id_cadeira, cadeira.semestre_id_semestre,cadeira.imagem, cadeira.sigla  FROM cadeira WHERE cadeira.semestre_id_semestre=?";

if(mysqli_stmt_prepare($statement,$querry)){
    mysqli_stmt_bind_param($statement, 'i', $semestre1);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$nomecad, $id_cadeira, $semestre, $icon_cadeira, $sigla_cadeira);
}

?>


<main>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="roxinhob col-sm-12 text-center py-3 my-5 mb-5">
                <h2 class="text-dark titulo pl-4 greyText font-weight-bold"><?= $ano ?>º ano</h2>
            </div>

            <div class="m-auto w-75 text-center seila">




                <button class="btn azul1b borderElement col-lg-8 col-md-12 mx-auto my-4 py-4 hoverrr3 " data-toggle="collapse"
                        data-target="#cadsem1" role="button" aria-expanded="false" aria-controls="collapseExample">


                    <h3 class="texto titulo pl-4 greyText"> 1º Semestre</h3>

                </button>
<!------------------------>
                <?php

                while(mysqli_stmt_fetch($statement)) {



                    ?>

                    <div class="collapse negmar2 col-lg-8 col-md-12 mx-auto px-0" id="cadsem1">

                    <div class="text-center m-auto py-5 px-3 w-100 row bkk-color2 borderElement">
                        <div class=" m-auto pt-5 px-3">
                            <div class="icooon  centercenter m-auto bolinhaa ">
                                <a href="disciplinas.php?id=<?=$id_cadeira?>"><img src="imgs/<?=$icon_cadeira?>.png" class="ajustaa my-auto p-0 w-100 h-auto hoverrr bolinhaa"></a>
                            </div>
                            <p class="pt-2"><?=$nomecad?></p>
                        </div>



                    </div>

                </div>

                <?php
        }

                mysqli_stmt_close($statement);

                $stmt=mysqli_stmt_init($link);


                $querry1="SELECT cadeira.nome, cadeira.id_cadeira, cadeira.semestre_id_semestre,cadeira.imagem, cadeira.sigla  FROM cadeira WHERE cadeira.semestre_id_semestre=?";

                if(mysqli_stmt_prepare($stmt,$querry1)){
                    mysqli_stmt_bind_param($stmt, 'i', $semestre2);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,$nomecad1, $id_cadeira1, $semestre1, $icon_cadeira1, $sigla_cadeira1);
                }

                ?>

<!------------------------>
                <button class="btn azul2b borderElement col-lg-8 col-md-12 mx-auto my-4 py-4 hoverrr3 mb-5" data-toggle="collapse"
                        href="#cadsem2" role="button" aria-expanded="false" aria-controls="collapseExample">


                    <h3 class="texto titulo pl-4 greyText">2º semestre</h3>

                </button>
                <?php

                while(mysqli_stmt_fetch($stmt)) {



                    ?>

                    <div class="collapse negmar2 col-lg-8 col-md-12 mx-auto px-0" id="cadsem2">

                        <div class="text-center m-auto py-5 px-3 w-100 row bkk-color2 borderElement">
                            <div class=" m-auto pt-5 px-3">
                                <div class="icooon  centercenter m-auto bolinhaa ">
                                    <a href="disciplinas.php?id=<?=$id_cadeira1?>"><img src="imgs/<?=$icon_cadeira1?>.png" class="ajustaa my-auto p-0 w-100 h-auto hoverrr bolinhaa"></a>
                                </div>
                                <p class="pt-2"><?=$nomecad1?></p>
                            </div>



                        </div>

                    </div>

                    <?php
                }

                ?>



            </div>
        </div>
    </div>

    <footer class="container-fluid bgEscuro p-3">
        <section class="row justify-content-md-between">
            <article class="col-md-2 pt-4 pl-2 pl-md-5 text-white text-center text-md-left">
                <h5 class="footer-brand pl-2 pb-3 "><img src="imgs/logobranco.svg" width="80px" alt="img2">
                </h5>
            </article>
            <article class="col-md-7 pt-0 pt-md-4 pl-2 pl-md-0 text-white text-center text-md-left">
                <a href="#"><i class="fab fa-facebook-f p-3"></i></a>
                <a href="#"><i class="fab fa-twitter p-3"></i></a>
                <a href="#"><i class="fab fa-instagram p-3"></i></a>
            </article>
            <article class="col-md-3 text-white">
                <section class="row">
                    <article class="col-12 col-md-6 p-1 font-weight-normal text-center pt-5">
                        <a href="#" class="tamanho">
                            <h4>Sobre</h4>
                        </a>
                    </article>
                    <article class="col-12 col-md-6 p-1 font-weight-normal text-center py-5">
                        <a href="#" class="tamanho">
                            <h4>Contactos</h4>
                        </a>
                    </article>
                </section>
            </article>
        </section>
        <section class="row">
            <article class="col-12 text-white">
                <p class="text-right h4 font-weight-normal pt-4 tamanho ">&commat; 2021 explain.ua, All Rights Reserved</p>
            </article>
        </section>
    </footer>
</main>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
