
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Perfil</title>
</head>
<body class="cinzaClaroBg">


<?php include_once "components/cp_nav.php"; ?>

<?php

if (!isset($_SESSION["username"]) || (($_GET["id"] != $_SESSION["user_id"]) && $_SESSION["role"] == 2)) {
    header("Location: ../blockedAccess.php");
}

$userid = $_GET["id"];

// We need the function!
require_once("connections/connections.php");


// Create a new DB connection
$link = new_db_connection();

/* create a prepared statement */
$stmt = mysqli_stmt_init($link);


// SET lc_time_names = 'pt_PT'; arranjar maneira de por isto antes para ficar em pt
$query = " SELECT utilizador.nome, perfil.tipo_perfil, TIMESTAMPDIFF(YEAR, utilizador.data_nascimento ,CURDATE()), DAY(utilizador.data_registo), MONTHNAME (utilizador.data_registo), YEAR (utilizador.data_registo), utilizador.foto_perfil FROM utilizador INNER JOIN perfil ON perfil_idperfil = id_perfil WHERE utilizador.id_utilizador = ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $userid);

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt,$nome, $profile_name, $idade, $registo_dia, $registo_mes, $registo_ano, $foto);

}

$contador=0;

mysqli_stmt_store_result($stmt);
while (mysqli_stmt_fetch($stmt)) {

    ?>

    <main class="container-fluid container-lg texto bg-light">
        <section class="row justify-content-center">
            <article class="col-12 vh-80">

            </article>

            <article id="profileJoin" class="col-12 vh-55 position-absolute bg-profile">
                <article class="col-12 text-center  profilePic">
                    <img src="imgs/recursos/<?php echo $foto  ?>" class="borderElement img-fluid profilePicSize">
                </article>

                <article id="profileName" class="pt-4 col-12 text-centerfont-weight-bold rem2">
                    <div class="text-center"><?= $nome ?></div>
                </article>
            </article>

            <form class=" align-items-center text-center py-3  " action="scripts/sc_upload_photo.php?id=<?php echo $userid ?>" method=post enctype=multipart/form-data>
                <input class="border-1 mx-2  text-light px-0 col-6 " type="file" name="fileToUpload" id="fileToUpload">
                <input class="border-1 btn btn-light my-0 col-4 mx-1" type="submit" value="Upload Image" name="submit">
            </form>



        </section>

        <section class="row mt-5 mb-4 mx-2 shadow borderElement bitgreyer">
            <article class="col-6 col-sm-6 col-md-8">
                <section class="row py-2">

                    <article class="col-12 col-sm-12 col-md-6 text-center position-relative ">
                        <div class=" ">
                            <div class="mb-1 font-weight-bold rem1-3">Estatuto</div>
                            <div><?= $profile_name ?></div>
                        </div>
                    </article>

                    <article class="col-12 col-sm-12 col-md-6 text-center d-none d-sm-none d-md-block">
                        <div class="font-weight-bold rem1-3">Membro desde:</div>
                        <div class="position-relative mt-1">
                            <i class="fas fa-calendar rem4"><span class="position-absolute rem2 data-profile"><?= $registo_dia ?></span></i>
                        </div>
                        <div class="mt-1"><?php echo $registo_mes . " de " . $registo_ano?></div>
                    </article>

                </section>
            </article>

            <article class="col-6 col-sm-6 col-md-4 text-center position-relative">
                <div class=" py-2">
                    <div class="mb-1 font-weight-bold rem1-3">Idade</div>
                    <div><?= $idade ?> anos</div>
                </div>
            </article>

            <article class="col-12 text-center d-block d-sm-block d-md-none position-relative mt-custom1">
                <div class=" py-2">
                    <div class="font-weight-bold rem1-3">Membro desde:</div>
                    <div class="position-relative mt-1">
                        <i class="fas fa-calendar rem4"><span class="position-absolute rem2 data-profile">31</span></i>
                    </div>
                    <div class="mt-1">Abril 2020</div>
                </div>
            </article>
        </section>

        <section class="row mt-5">
            <!--First section -->
            <article class="col-12 col-sm-12 col-md-4 mb-4 py-3">
                <div class="mx-2 borderSections p-2 bitgreyer shadow">
                    <section class="row">
                        <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                            Area
                        </article>

                        <article class="col-12">
                            <section class="row mx-2 py-2">
                                <article class="col-2 p-0 text-right d-flex align-items-center justify-content-end ">
                                    <div>
                                        <img src="imgs/ntc.png" class="img-fluid textIcon2">
                                    </div>
                                </article>

                                <article class="col-10">
                                    <section class="row">
                                        <article class="col-12 font-weight-bold">
                                            Licenciatura NTC
                                        </article>

                                        <article class="col-12">
                                            2º ano
                                        </article>
                                    </section>
                                </article>
                            </section>
                        </article>
                    </section>
                </div>
            </article>

            <!--Second section -->
            <article class="col-12 col-sm-12 col-md-4 mb-4 py-3">
                <div class="mx-2 borderSections p-2 bitgreyer shadow">
                    <section class="row">
                        <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                            Cadeiras Frequentadas
                        </article>
                        <?php
                        /* create a prepared statement */
                        $stmt2 = mysqli_stmt_init($link);


                        // SET lc_time_names = 'pt_PT'; arranjar maneira de por isto antes para ficar em pt
                        $query2 = "SELECT cadeira.sigla, cadeira.imagem, cadeira.id_cadeira FROM cadeira 
                                            INNER JOIN cadeira_has_utilizador ON id_cadeira = cadeira_id_cadeira
                                            WHERE utilizador_id_utilizador = ?";

                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                            mysqli_stmt_bind_param($stmt2, 'i', $userid);

                            /* execute the prepared statement */
                            mysqli_stmt_execute($stmt2);

                            /* bind result variables */
                            mysqli_stmt_bind_result($stmt2,$nomecadeira, $imagemcadeira, $cadeiraid);

                        }



                        while (mysqli_stmt_fetch($stmt2)) {

                            ?>


                            <article class="col-4 col-sm-4 col-md-12 col-xl-4">
                                <a href="disciplinas.php?id=<?php echo $cadeiraid ?>" class="text-dark">
                                    <section class="row  mx-2 py-2">
                                        <article class="col-12 col-sm-12 col-md-6 col-xl-12 text-center text-md-right text-xl-center">
                                            <img src="imgs/<?php echo $imagemcadeira?>" class="img-fluid faceIcon">
                                        </article>
                                        <article class="col-12 col-sm-12 col-md-6 col-xl-12 d-flex align-items-center justify-content-center justify-content-md-start justify-content-xl-center font-weight-bold">
                                            <div><?php echo $nomecadeira?></div>
                                        </article>
                                    </section>
                                </a>
                            </article>


                            <?php

                        }
                        mysqli_stmt_close($stmt2);
                        ?>



                    </section>
                </div>
            </article>

            <!--Third section -->
            <article class="col-12 col-sm-12 col-md-4 mb-4 py-3 ">
                <div class="mx-2 borderSections p-2 bitgreyer shadow">
                    <section class="row">
                        <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                            Favoritos
                        </article>

                        <article class="col-12">
                            <?php
                            /* create a prepared statement */
                            $stmt3 = mysqli_stmt_init($link);

                            $true = 1;


                            // SET lc_time_names = 'pt_PT'; arranjar maneira de por isto antes para ficar em pt
                            $query3 = "SELECT utilizador_has_topico.topico_id_topico, ticket.titulo, cadeira.imagem FROM utilizador_has_topico
                                            INNER JOIN topico ON topico.id_topico = utilizador_has_topico.topico_id_topico
                                            INNER JOIN ticket ON topico.id_topico = ticket.topico_id_topico
                                            INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                                            WHERE utilizador_has_topico.utilizador_id_utilizador = ? AND utilizador_has_topico.favorito = ?";

                            if (mysqli_stmt_prepare($stmt3, $query3)) {

                                mysqli_stmt_bind_param($stmt3, 'ii', $userid, $true);

                                /* execute the prepared statement */
                                mysqli_stmt_execute($stmt3);

                                /* bind result variables */
                                mysqli_stmt_bind_result($stmt3,$topicoid, $topicotitulo, $imagem_cadeira);

                            }



                            while (mysqli_stmt_fetch($stmt3)) {

                                ?>

                                <div class="borderSectionsElement m-auto"> </div>

                                <a href="topico.php?id=<?php echo $topicoid ?>" class="text-dark">
                                    <section class="row mx-2 py-2 ">
                                        <article class="col-2 col-sm-2 col-md-3 col-lg-4 col-xl-2 p-0 d-flex align-items-center justify-content-end">
                                            <div>
                                                <img src="imgs/<?php echo $imagem_cadeira ?>" class="img-fluid textIcon">
                                            </div>
                                        </article>

                                        <article class="col-10 col-sm-10 col-md-9 col-lg-8 col-xl-10 d-flex align-items-center  ">
                                            <div><?php echo $topicotitulo ?></div>
                                        </article>
                                    </section>
                                </a>


                                <?php

                            }
                            mysqli_stmt_close($stmt3);
                            ?>

                            <!-- <div class="borderSectionsElement m-auto"></div> -->
                        </article>
                    </section>
                </div>
            </article>
        </section>
    </main>

    <?php

    $contador++;
}

if ($contador==0) {
    ?>
    <!-- html aqui para pagina de utilizador nao existente -->
    <h1>Utilizador não existente</h1>
    <h1>Por aqui o html - não esquecer</h1>
    <?php
}


mysqli_stmt_close($stmt);

?>





<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>


</body>
</html>
