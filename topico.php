<!DOCTYPE html>
<html lang="pt">
<head>
    <?php

    include_once "helpers/meta_helper.php";

    include_once "helpers/css_helper.php";

    ?>

    <title> Post </title>
</head>
<body class="cinzaClaroBg" id="topico">

<?php

include_once "components/cp_nav.php";

require_once "connections/connections.php";

$userid = $_SESSION["user_id"];

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "SELECT ticket.titulo, ticket.corpo_mensagem,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), utilizador.username, utilizador.id_utilizador, topico.pontuacao, topico.id_topico, cadeira.imagem 
FROM ticket 
INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
WHERE id_ticket = ?";

if (isset($_GET["id"])){

$id_ticket = $_GET["id"];

if (mysqli_stmt_prepare($stmt,$query)){
    mysqli_stmt_bind_param($stmt, 'i' , $id_ticket);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result( $stmt, $titulo,$corpo, $publishing_hour,$publishing_minute, $autor, $idauthor,$score, $id_topico,$cadeira_img);
} else {
    echo "ERROR: ". mysqli_error($link);
}

mysqli_stmt_store_result($stmt);

while (mysqli_stmt_fetch($stmt)){

?>

<main class="container textoEscuro texto fundoClaro p-4 p-xl-5">
    <section class="row justify-content-center mt-4">
        <article class="col-11 col-md-9 mt-3">
            <section class="row">
                <div class="col-12 col-sm-3 col-lg-2 text-center">
                    <img src="imgs/<?=$cadeira_img?>" height="100px" width="100px">
                </div>
                <div class="col-10 col-sm-7 col-lg-8 mt-3 pt-3 pt-sm-0">
                    <h3 class="titulo font-weight-bold mb-2"><?= $titulo ?></h3>
                    <p class="small font-italic  ml-2 mb-0">Submetido por <a href="perfil.php?id=<?=$idauthor?>" class="text-secondary cursor"><?=$autor?></a><br><?php
                        if ($publishing_hour == 0){
                            echo "Postado há ".$publishing_minute." minutos"; }
                        else if ($publishing_hour > 0 && $publishing_hour < 24){
                            echo "Postado há ".$publishing_hour ." horas";}
                        else if ($publishing_hour < 24*7 && $publishing_hour > 24){
                            $publishing_day = intval(($publishing_hour / 24));
                            echo "Postado há ".$publishing_day." dias";
                        }else{
                            $publishing_week = intval(($publishing_hour / (24*7)));
                            echo  "Postado há ". $publishing_week." semanas";
                        }
                        ?></p>
                </div>
                <!-- falta upvote/downvote -->
                <div class="col-1 pt-4 pt-sm-3 text-right">
                    <i class="fas fa-angle-up fa-2x d-block cursor"></i>
                    <?= $score ?>
                    <i class="fas fa-angle-down fa-2x d-block cursor"></i>
                </div>
                <?php

                $statement = mysqli_stmt_init($link);

                $buscafav = "SELECT utilizador_has_topico.favorito
                 FROM utilizador_has_topico 
                 INNER JOIN utilizador ON utilizador.id_utilizador = utilizador_has_topico.utilizador_id_utilizador
                 INNER JOIN topico ON topico.id_topico = utilizador_has_topico.topico_id_topico
                 WHERE utilizador.id_utilizador = ?  AND topico.id_topico = ?";

                if (mysqli_stmt_prepare($statement, $buscafav)) {

                mysqli_stmt_bind_param($statement, 'ii', $userid, $id_topico);

                /* execute the prepared statement */
                mysqli_stmt_execute($statement);

                /* bind result variables */
                mysqli_stmt_bind_result($statement,$fav);

                }

                mysqli_stmt_store_result($statement);

                    while (mysqli_stmt_fetch($statement)) {
                        if ($fav == 1) {
                            echo " <div class='col-1 pt-4 pt-sm-3 text-right'>
                    <a href='scripts/sc_favorito.php?id=$id_ticket' class='btn'><i class='fas fa-star'></i></a>
                </div>";
                        } else {
                            echo " <div class='col-1 pt-4 pt-sm-3 text-right'>
                    <a href='scripts/sc_favorito.php?id=$id_ticket' class='btn'><i class='far fa-star'></i></a>
                </div>";
                        }
                    }
                mysqli_stmt_close($statement);

                ?>
            </section>
        </article>

        <article class="col-11 col-md-9 my-4 mt-sm-5">
            <p class="text-secondary"><?=$corpo?></p>
        </article>

    </section>
    <?php
         }
    }
?>

    <section class="row justify-content-center">
        <article class="col-12 col-md-11 mt-4">

            <div class="cinzaClaroBg borderElement pb-2">
                <div class="azul1 borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Esclarecimento do mentor</h5>
                </div>

                <div class="cinzaClaroBg borderElement py-4 px-3 p-sm-4 p-xl-5">
                    <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                    <p class="float-left font-weight-bold m-0 pt-2 pl-2">Jorge Santos<span class="small font-italic text-success ml-1">mentor</span></p>

                    <img class="img-fluid mt-4" src="imgs/videochamada_ilu.png">
                    <p class="font-weight-bold textoAzul1 mt-4 ml-2">NOTAS</p>
                    <p>Exemplo de prepared statements com mysqli:</p>
                    <code class="textoRosinha">
                        $db = new mysqli('localhost', 'usuario', 'senha', 'teste');<br>
                        $sql = 'INSERT INTO tabela(campo1, campo2, campo3) VALUES(?, ?, ?)';<br>
                        $stmt = $db->prepare($sql);<br>
                        $var1 = 1; $var2 = 'foo'; $var3 = 1.99;<br>
                        $stmt->bind_param('isd', $var1, $var2, $var3);<br>
                        $stmt->execute();<br>
                    </code>

                    <p class="font-weight-bold textoAzul1 mt-4 ml-2">ANEXOS</p>
                    <a class="font-italic text-secondary cursor" href="https://www.php.net/manual/en/mysqli-stmt.bind-param.php">Manual de PHP: bind_param</a>
                </div>
            </div>
        </article>
    </section>
    <section class="row justify-content-center">
        <article class="col-12 col-md-11 mt-4">
<?php

$stmt2 = mysqli_stmt_init($link);

$query2 = "SELECT comentario.id_comentario,comentario.texto, comentario.pontuacao, utilizador.username, utilizador.foto_perfil, HOUR(TIMEDIFF(NOW(),comentario.data_envio)), MINUTE(TIMEDIFF(NOW(), comentario.data_envio)) 
FROM comentario
INNER JOIN utilizador ON utilizador.id_utilizador = comentario.utilizador_id_utilizador
INNER JOIN topico On topico.id_topico = comentario.topico_id_topico
WHERE topico.id_topico = ?
ORDER BY comentario.pontuacao DESC LIMIT 1";

if (mysqli_stmt_prepare($stmt2,$query2)){
    mysqli_stmt_bind_param($stmt2, 'i' , $id_topico);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result( $stmt2, $id_comment,$top_comment,$top_score, $top_user,$top_pfp, $top_envio_hora,$top_envio_minuto);
} else {
    echo "ERROR: ". mysqli_error($link);
}
while (mysqli_stmt_fetch($stmt2)){
?>

            <div class="cinzaClaroBg borderElement pb-3">
                <div class="roxinhob borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Comentário principal</h5>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/<?=$top_pfp?>" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2"><?=$top_user?></p>
                        </div>

                        <div class="col-12 mt-4">
                            <p><?=$top_comment?></p>
                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <?= $top_score ?>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">
                                    <?php
                                    if ($top_envio_hora == 0){
                            echo "Postado há ".$top_envio_minuto." minutos"; }
                        else if ($top_envio_hora > 0 && $top_envio_hora < 24){
                            echo "Postado há ".$top_envio_hora ." horas";}
                        else if ($top_envio_hora < 24*7 && $top_envio_hora > 24){
                            $top_envio_dia = intval(($top_envio_hora / 24));
                            echo "Postado há ".$top_envio_dia." dias";
                        }else{
                            $top_envio_week = intval(($top_envio_hora / (24*7)));
                            echo  "Postado há ". $top_envio_week." semanas";
                        }
                        ?>
                                </span>
                            </div>
                        </div>
                    </section>
                </div>
        <?php
        }

        $stmt3 = mysqli_stmt_init($link);

        $query3 = "SELECT COUNT(comentario.texto) FROM comentario WHERE comentario.topico_id_topico = ?";

        if (mysqli_stmt_prepare($stmt3,$query3)){
                    mysqli_stmt_bind_param($stmt3, 'i' , $id_topico);
                    mysqli_stmt_execute($stmt3);
                    mysqli_stmt_bind_result( $stmt3, $total);
                } else {
                    echo "ERROR: ". mysqli_error($link);
                }
                while (mysqli_stmt_fetch($stmt3)){
            ?>

                <div class="azul1 borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Comentários (<?= $total; } ?>)</h5>
                </div>
                <?php

                $stmt1 = mysqli_stmt_init($link);

                $query1 = "SELECT comentario.texto, utilizador.username, comentario.pontuacao, HOUR(TIMEDIFF(NOW(),comentario.data_envio)), MINUTE(TIMEDIFF(NOW(), comentario.data_envio)), utilizador.foto_perfil
FROM comentario
INNER JOIN ticket ON ticket.topico_id_topico = comentario.topico_id_topico
INNER JOIN topico ON topico.id_topico = comentario.topico_id_topico
INNER JOIN utilizador ON utilizador.id_utilizador = comentario.utilizador_id_utilizador
WHERE topico.id_topico = ? 
ORDER BY comentario.data_envio DESC;";

                if (mysqli_stmt_prepare($stmt1,$query1)){
                    mysqli_stmt_bind_param($stmt1, 'i' , $id_topico);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result( $stmt1, $comment, $pessoa, $comment_score, $comment_hour, $comment_minute, $fotos);
                } else {
                    echo "ERROR: ". mysqli_error($link);
                }
                while (mysqli_stmt_fetch($stmt1)){


                ?>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/<?= $fotos?>" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2"><?= $pessoa ?></p>
                        </div>

                        <div class="col-12 mt-4">
                            <p><?= $comment ?></p>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <?= $comment_score ?>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">
                                <?php
                                if ($comment_hour == 0){
                                    echo "Postado há ".$comment_minute." minutos"; }
                                else if ($comment_hour > 0 && $comment_hour < 24){
                                    echo "Postado há ".$comment_hour ." horas";}
                                else if ($comment_hour < 24*7 && $comment_hour > 24){
                                    $comment_day = intval(($comment_hour / 24));
                                    echo "Postado há ".$comment_day." dias";
                                }else{
                                    $comment_week = intval(($comment_hour / (24*7)));
                                    echo  "Postado há ". $comment_week." semanas";
                                }
                                ?>
                                </span>
                            </div>
                        </div>
                    </section>
                </div>
            <?php } ?>
                <a href="#" class="text-secondary small cursor mt-4 ml-3 mb-0">carregar mais comentários...</a>
            </div>
        </article>
    </section>

    <?php

    $stmt4 = mysqli_stmt_init($link);

    $query4 = "SELECT utilizador.foto_perfil, utilizador.username FROM utilizador WHERE utilizador.username = ?";

    if (mysqli_stmt_prepare($stmt4,$query4)){
        mysqli_stmt_bind_param($stmt4, 's' , $_SESSION['username']);
        mysqli_stmt_execute($stmt4);
        mysqli_stmt_bind_result( $stmt4, $lafoto, $lenome);
    } else {
        echo "ERROR: ". mysqli_error($link);
    }
    while (mysqli_stmt_fetch($stmt4)){
        echo "<section class='row justify-content-center'>
        <article class='col-12 col-md-11 mt-4 mb-5'>
            <div class='cinzaClaroBg borderElement py-1'>
                <div class='form-group p-3 mt-3'>
                    <div>
                        <img class='float-left mb-3 ml-2' src='imgs/$lafoto' height='40px' width='40px'>
                        <p class='float-left font-weight-bold m-0 pt-2 pl-2 mb-3'> $lenome </p>
                    </div>
                <form  class='py-2 px-5 text-center' role='form' action='scripts/sc_leave_comment.php?id=$id_ticket' method='post'>
                    <textarea class='form-control borderElement font-italic p-3' id='FormControlTextarea1' rows='2' placeholder='Escreve um comentário...' name='comment'></textarea>
                    <div class='d-flex justify-content-between small mt-3'>
                        <button class='btn borderElement textoClaro comentAnexo titulo ml-1 azul1' type='submit'>Deixar Comentario</button>
                    </div>
                </form>    
                </div>
        </article>
    </section>";
    }
    ?>

</main>
<!-- Footer -->
<?php include_once "components/cp_footer.php"?>

<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>

</body>
</html>
