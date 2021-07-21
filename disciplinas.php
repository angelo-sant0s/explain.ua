<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Explain.ua</title>
</head>
<body class="bgClaro">


<?php include_once "components/cp_nav.php"; ?>
<?php include_once "components/cp_nav.php";

require_once "connections/connections.php";

$local_link = new_db_connection();

if (isset($_GET["id"])) {
    $id_cadeira = $_GET["id"];
}


$confirma=0;

$userid = $_SESSION["user_id"];

$stmt3 = mysqli_stmt_init($local_link);

$stmt2 = mysqli_stmt_init($local_link);

if(isset($_GET['order'])){
    switch ($_GET['order']){
        case "recente":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), cadeira.imagem, cadeira.nome, cadeira.sigla, recursos.link_recurso, recursos.tipo_id_tipo
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket
WHERE cadeira.id_cadeira = ?
ORDER BY topico.data_publicacao DESC";
            break;
        case "popular":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), cadeira.imagem, cadeira.nome, cadeira.sigla, recursos.link_recurso, recursos.tipo_id_tipo
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
WHERE cadeira.id_cadeira = ?
ORDER BY ticket.data_submissao ASC";
            break;
        case "top":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), cadeira.imagem, cadeira.nome, cadeira.sigla, recursos.link_recurso, recursos.tipo_id_tipo
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador 
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket
INNER JOIN utilizador_has_topico ON topico.id_topico = utilizador_has_topico.topico_id_topico
INNER JOIN votos ON votos.id_votos = utilizador_has_topico.votos_id_votos
WHERE cadeira.id_cadeira = ?
ORDER BY SUM(votos.valor_voto) DESC";
            break;
    }
}else{
    $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), cadeira.imagem, cadeira.nome, cadeira.sigla, recursos.link_recurso, recursos.tipo_id_tipo
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket
WHERE cadeira.id_cadeira = ?
ORDER BY topico.data_publicacao DESC";
}

$query2 = "SELECT COUNT(comentario.texto)
FROM `comentario` 
INNER JOIN topico ON topico_id_topico = id_topico 
WHERE id_topico = ?;";

if (mysqli_stmt_prepare($stmt3,$query)){
    mysqli_stmt_bind_param($stmt3, 's', $id_cadeira);
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_bind_result($stmt3, $titulo, $texto, $id, $idtopico, $autor, $publishing_hour, $publishing_minute, $cadeirapfp, $cadeiranome, $cadeirasigla, $imagemnome, $imagemtipo);
}

while(mysqli_stmt_fetch($stmt3)) {
    if($confirma==0){

?>



<div class="container azul1b shadow borderElement p-5">
    <section class="row pt-3 ">
        <article class="col-12 text-center andabaixo">
            <img class="iconzito1" src="imgs/cadeiras/<?=$cadeirapfp?>">
            <h3 class="titulo textoClaro font-weight-bold pt-5"><?=$cadeiranome?></h3>
        </article>
    </section>
</div>
<?php
        $confirma=1;
}
}
?>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98 shadow">
    <section class="row text-center pt-2">
        <article class="col-12">
            <p class="titulo text-black-50">Ordenar tópicos por:</p>
        </article>
    </section>
    <section class="row justify-content-between text-center p-2">
        <article class="col-12 col-lg-6 filtro">
            <a href="disciplinas.php?id=<?=$id_cadeira?>&order=recente"> <button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-clock fa-2x px-1"></i><span class="pb-2">Recente</span></button></a>
            <a href="disciplinas.php?id=<?=$id_cadeira?>&order=popular"><button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-fire fa-2x px-1"></i><span class="pb-2">Popular</span></button></a>
            <a href="disciplinas.php?id=<?=$id_cadeira?>&order=top"><button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-arrow-up fa-2x px-1"></i><span class="pb-2">Top</span></button></a>
        </article>
        <article class="col-12 col-lg-6 text-center position-relative mt-lg-0 mt-4 search_box">
            <input type="text" placeholder="Search" class="pl-3 shadow">
            <i class="fas fa-search lupa roxinho"></i>
        </article>
    </section>

</div>

<!------------------>

<div class="container" id="container">
    <?php
    mysqli_stmt_close($stmt3);
    $stmt = mysqli_stmt_init($local_link);

    if (mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_bind_param($stmt, 's', $id_cadeira);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $titulo, $texto, $id, $idtopico, $autor, $publishing_hour, $publishing_minute, $cadeirapfp, $cadeiranome, $cadeirasigla, $imagemnome, $imagemtipo);
    }
    mysqli_stmt_store_result($stmt);
    while (mysqli_stmt_fetch($stmt)){
        ?>
        <div class='container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98' id="hometopic">
        <div class='pl-3 py-4'>

        <img class='iconzito  float-left pr-4' src='imgs/<?=$cadeirapfp?>'>

        <div class='row'>
            <article class='col-9'>
                <a href='topico.php?id=<?=$id?>'> <h2 class='titulo corazul'> <?= $titulo ?></h2> </a>
                <h5 class='titulo font-italic text-black-50'> Submetido  por <span class="textoAzul1"><?= $autor ?></span></h5>
            </article>
            <article class='col-3'>
                <div class='float-right'>
                    <?php
                    $statement = mysqli_stmt_init($local_link);

                    $score_track = "SELECT SUM(votos.valor_voto)
                           FROM votos
                           INNER JOIN utilizador_has_topico ON utilizador_has_topico.votos_id_votos = votos.id_votos
                           WHERE utilizador_has_topico.topico_id_topico = ?";

                    $upvote = "SELECT utilizador_has_topico.votos_id_votos
        FROM utilizador_has_topico
        INNER JOIN utilizador ON utilizador.id_utilizador = utilizador_has_topico.utilizador_id_utilizador
        INNER JOIN topico ON topico.id_topico = utilizador_has_topico.topico_id_topico
        WHERE utilizador.id_utilizador = ?  AND topico.id_topico = ?";

                    if (mysqli_stmt_prepare($statement, $score_track)) {

                        mysqli_stmt_bind_param($statement, 'i', $idtopico);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($statement);

                        /* bind result variables */
                        mysqli_stmt_bind_result($statement,$score);

                    }


                    mysqli_stmt_store_result($statement);

                    while(mysqli_stmt_fetch($statement)) {

                        $controlador = 0;


                        $statement1 = mysqli_stmt_init($local_link);

                        if (mysqli_stmt_prepare($statement1, $upvote)) {

                            mysqli_stmt_bind_param($statement1, 'ii', $userid,  $idtopico);

                            /* execute the prepared statement */
                            mysqli_stmt_execute($statement1);

                            /* bind result variables */
                            mysqli_stmt_bind_result($statement1, $vote);

                        }


                        mysqli_stmt_store_result($statement1);

                        while (mysqli_stmt_fetch($statement1)) {

                            $controlador = 1;

                            if ($vote == 1) {
                                echo "<a href='scripts/sc_upvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-up fa-2x d-block'></i></a>
                       $score 
                     <a href='scripts/sc_downvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-down fa-2x d-block'></i></a>";
                            } else if ($vote == 2) {
                                echo "<a href='scripts/sc_upvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-up fa-2x d-block'></i></a>
                       $score 
                     <a href='scripts/sc_downvote.php?id=$id&cadeira=$id_cadeira' class='btn corazul'><i class='fas fa-chevron-down fa-2x d-block'></i></a>";
                            } else if ($vote == 3){
                                echo "<a href='scripts/sc_upvote.php?id=$id&cadeira=$id_cadeira' class='btn corazul'><i class='fas fa-chevron-up fa-2x'></i></a>
                       $score 
                     <a href='scripts/sc_downvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-down fa-2x d-block'></i></a>";
                            }
                        }
                    }
                    if ($controlador == 0) {
                        echo "<a href='scripts/sc_upvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-up fa-2x d-block'></i></a>
                       $score 
                     <a href='scripts/sc_downvote.php?id=$id&cadeira=$id_cadeira' class='btn text-black-50'><i class='fas fa-angle-down fa-2x d-block'></i></a>";
                    }
                    mysqli_stmt_close($statement);

                    ?>
                </div>
            </article>
        </div>
        <hr>
        <a href='topico.php?id=<?=$id?>'>
            <div>
                <p class='align-self-start px-4'> <?= $texto ?> </p>
            </div>
        </a>
        <div class="text-center">
            <?php
            if($imagemtipo==1){
                $imagemtipo=".jpg";
            }
            if($imagemtipo==2){
                $imagemtipo=".png";
            }
            if($imagemtipo==3){
                $imagemtipo=".mp4";
            }
            if($imagemtipo==4){
                $imagemtipo=".gif";
            }
            if($imagemtipo==5){
                $imagemtipo=".mp3";
            }
            if($imagemtipo==6){
                $imagemtipo=".mov";
            }

            if(isset($imagemnome)){
                echo "<img class=\"w-75 w-auto maximo py-5\" src=\"imgs/$imagemnome$imagemtipo\">";


            }
            else{ echo "<div class='py-4'></div>";}

            ?>
        </div>
        <div class='text-secondary font-italic'>
        <?php
        if (mysqli_stmt_prepare($stmt2,$query2)){
            mysqli_stmt_bind_param($stmt2, 'i' , $idtopico);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result( $stmt2, $count);
            while (mysqli_stmt_fetch($stmt2)) {
                ?>
                <span > <?= $count; } ?> Comentários</span >
            <i class='fas fa-comment' ></i >
            <div class='float-right pr-4' > Postado há
                <?php
                if ($publishing_hour == 0){
                    echo $publishing_minute." minutos"; }
                else if ($publishing_hour > 0 && $publishing_hour < 24){
                    echo $publishing_hour ." horas";}
                else if ($publishing_hour < 24*7 && $publishing_hour > 24){
                    $publishing_day = intval(($publishing_hour / 24));
                    echo $publishing_day." dias";
                }else{
                    $publishing_week = intval(($publishing_hour / (24*7)));
                    echo    $publishing_week." semanas";
                }
                ?>  </div >
            </div >
            </div >
            </div >
            <?php
        }
    }
    ?>
</div>

<a href="#" class="text-center text-secondary small cursor mt-4 ml-3 mb-0"><span class="mb-4">carregar mais tópicos...</span></a>

<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>
</body>
</html>
