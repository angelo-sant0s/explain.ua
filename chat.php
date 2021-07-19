<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Chat</title>
</head>
<body>

<?php include_once "components/cp_nav.php"; ?>

<?php

function msg_direita($mensagem, $foto){
    echo "<section class='row mt-2 justify-content-end'>
                                        <article class='col-8 p-1''>
                                            <div class='p-2 bg-person2 borderElement'>".$mensagem."</div>
                                        </article>
                                        <article class='col-1 p-1 text-center''>
                                            <img src='imgs/".$foto."' class='img-fluid faceIcon'>
                                        </article>
                                    </section>";
}

function msg_esquerda($mensagem, $foto){
    echo "<section class='row mt-2'>
                                        <article class='col-1 p-1 text-center'>
                                            <img src='imgs/".$foto."' class='img-fluid faceIcon'>
                                        </article>
                                        <article class='col-8 p-1'>
                                            <div class='p-2 bg-person1 borderElement'>$mensagem</div>
                                        </article>
                                   </section>";
}

/* Indicação de chamada*/

                    /*<article class="col-12 my-3 text-center">
                        <hr>
                        <a href="videochamada.html" class="textoClaro"><span class="py-2 px-3 mt-2 bg-azul2 borderElement d-inline-block">Chamada iniciada</span></a>
                    </article>
                    */

if (!isset($_SESSION["username"]) || (($_GET["id"] != $_SESSION["user_id"]))) {
    header("Location: ../blockedAccess.php");
}

$userid = $_GET["id"];
$perfilid = $_SESSION["role"];
$botid = 3;


// We need the function!
require_once("connections/connections.php");


// Create a new DB connection
$link = new_db_connection();


/* create a prepared statement */
$stmt = mysqli_stmt_init($link);



$query = "SELECT utilizador.nome, utilizador.foto_perfil FROM utilizador WHERE utilizador.id_utilizador = ?";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'i', $userid);

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt,$postersname, $posterfoto);

}



mysqli_stmt_store_result($stmt);
while (mysqli_stmt_fetch($stmt)) {

}




mysqli_stmt_close($stmt);

?>


<main class="container-fluid texto cor5" id="mainchat">
    <section class="row">
        <!-- conversas -->
        <article id="conversaSection" class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 bg-person1">
            <section class="row  borders4" id="conversatitle">
                <article class="col-12 text-center p-3 bg-inputzone" >Conversa</article>
            </section>



            <section id="Conversas" class="row overflow-auto borders4">
                <article class="col-12">
                <?php
                /* create a prepared statement */
                $stmt = mysqli_stmt_init($link);

                $query = "SELECT ticket.utilizador_id_utilizador1, utilizador.nome, utilizador.foto_perfil, ticket.titulo, ticket.id_ticket, ticket.data_ultima, cadeira.sigla, HOUR(TIMEDIFF(NOW(), ticket.data_ultima)), MINUTE(TIMEDIFF(NOW(), ticket.data_ultima)), HOUR(ticket.data_ultima), MINUTE(ticket.data_ultima)
                            FROM ticket
                            INNER JOIN utilizador ON ticket.utilizador_id_utilizador1 = utilizador.id_utilizador
                            INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                            WHERE ticket.utilizador_id_utilizador = ?  
                            ORDER BY `ticket`.`data_ultima` DESC";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $userid);

                    /* execute the prepared statement */
                    mysqli_stmt_execute($stmt);

                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt,$mod_id, $mod_nome, $mod_foto, $ticket_nome, $ticket_id, $ticket_ultima, $cadeira_sigla, $publishing_hour, $publishing_minute, $relogio_horas, $relogio_minutos);

                }

                $num_ids = "";

                while (mysqli_stmt_fetch($stmt)) {
                    if ($num_ids=="") $num_ids = $ticket_id ;
                    else $num_ids = $num_ids . " " . $ticket_id ;
                    ?>


                        <section id="smallchat<?php echo $ticket_id?>" class="row p-2 custom-borderb cursorPointer">
                            <article class="col-2 p-0 please ">
                                <img src="imgs/<?php
                                if ($perfilid=2) {echo $mod_foto;}
                                else echo $posterfoto
                                ?>" class="img-fluid faceIcon">
                            </article>

                            <article class="col-10 p-0 pl-1 justify-content-between">
                                <section class="row m-0 h-100">
                                    <article class="col-8 p-0">
                                        <div class=""><?php
                                            if ($perfilid=2) {echo $mod_nome;}
                                            else echo $postersname
                                            ?></div>
                                    </article>

                                    <article class="col-4 p-0">
                                        <div class=" text-right">

                                            <?php

                                            if ($publishing_hour < 24){
                                                // horas
                                                echo $relogio_horas.":".$relogio_minutos;}
                                            else if ($publishing_hour < 247 && $publishing_hour > 24){
                                                // ha quantos dias
                                                $publishing_day = intval(($publishing_hour / 24));
                                                echo $publishing_day;
                                                if ($publishing_day==1) {echo " dia";}
                                                else echo " dias";
                                            }else{
                                                // data
                                                $publishing_week = intval(($publishing_hour / (247)));
                                                echo    $publishing_week;
                                                if ($publishing_week==1) {echo " semana";}
                                                else echo " semanas";
                                            }

                                            ?>

                                        </div>
                                    </article>

                                    <article class="col-12 p-0">
                                        <div class=""><?php echo $cadeira_sigla?> - <?php echo $ticket_nome?></div>
                                    </article>
                                </section>
                            </article>
                        </section>


                    <?php

                }




                mysqli_stmt_close($stmt);
                echo "<h1 id='infochatids' class='d-none'>$num_ids</h1>";

                ?>
                </article>




            </section>
        </article>

        <!-- chat -->
        <article id="chatSection" class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 bg-light  ">
            <section class="row  borders4 bg-inputzone" id="chattitle">
                <article class="col-1 align-items-center d-flex text-right" id="backtbn"><i class="d-inline-block d-lg-none fas fa-chevron-left arrowsize"></i></article>
                <article class="col-10 text-center p-3" > Chat</article>
            </section>

            <?php
            /* create a prepared statement */
            $stmt2 = mysqli_stmt_init($link);

            $query2 = "SELECT ticket.id_ticket, ticket.titulo, ticket.corpo_mensagem, YEAR(ticket.data_submissao), MONTHNAME(ticket.data_submissao), DAY(ticket.data_submissao), HOUR(ticket.data_submissao), MINUTE(ticket.data_submissao) FROM ticket  
                        WHERE ticket.utilizador_id_utilizador = ?  
                        ORDER BY `ticket`.`data_ultima` DESC";

            if (mysqli_stmt_prepare($stmt2, $query2)) {

                mysqli_stmt_bind_param($stmt2, 'i', $userid);

                /* execute the prepared statement */
                mysqli_stmt_execute($stmt2);

                /* bind result variables */
                mysqli_stmt_bind_result($stmt2,$ticket_id, $ticket_titulo, $ticket_mensagem, $submissão_ano, $submissão_mes, $submissão_dia, $submissão_hora, $submissão_minuto);

            }

            mysqli_stmt_store_result($stmt2);
            while (mysqli_stmt_fetch($stmt2)) {

                ?>

                    <!-- n tem aqui o echo-->
                <section id="chatRow<?php echo $ticket_id?>" class="row chatRow justify-content-center p-3 bg-chat-format">

                    <!-- resumo topioc -->
                    <article class="col-7">
                        <div class="resumoTop textoClaro bg-roxo borderElement font-italic text-center p-3 mx-5">
                            <?php echo $ticket_mensagem?>
                        </div>
                    </article>

                    <!-- divisao de 24h -->
                    <article class="col-7 text-center font-italic text-secondary">
                        <hr>
                        <?php
                        if ($submissão_hora == 0) $submissão_hora=00;
                        if ($submissão_minuto == 0) $submissão_minuto=00;
                        ?>
                        <?php echo $submissão_dia ." de " . $submissão_mes . ", " . $submissão_ano ?>
                        <br>
                        <?php if ($submissão_hora == 0) echo "00";
                        else echo $submissão_hora ;
                        echo ":";
                        if ($submissão_minuto == 0) echo "00";
                        else echo $submissão_minuto ;
                        ?>
                    </article>

                    <!-- corpo da mensagem -->
                    <article class="col-12">

                        <?php

                        /* create a prepared statement */
                        $stmt3 = mysqli_stmt_init($link);



                        $query3 = "SELECT ticket.id_ticket, mensagens.texto, mensagens.utilizador_id_utilizador, utilizador.perfil_idperfil, utilizador.foto_perfil FROM ticket
                                        INNER JOIN mensagens ON mensagens.ticket_id_ticket = ticket.id_ticket
                                        INNER JOIN utilizador ON utilizador.id_utilizador = mensagens.utilizador_id_utilizador
                                        WHERE ticket.utilizador_id_utilizador = ? AND ticket.id_ticket = ?  
                                        ORDER BY `mensagens`.`data_envio` ASC";

                        if (mysqli_stmt_prepare($stmt3, $query3)) {

                        mysqli_stmt_bind_param($stmt3, 'ii', $userid, $ticket_id);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt3);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt3,$id_ticket_useless, $texto, $remetente_id, $remetente_permissao, $remetente_foto );

                        }



                        mysqli_stmt_store_result($stmt3);
                        while (mysqli_stmt_fetch($stmt3)) {

                            if ($remetente_id == $botid) {
                                // mensagens do bot
                            }
                            else if ($_SESSION["role"]==1 && $remetente_permissao == 1) {
                                msg_direita($texto, $remetente_foto);
                            }
                            else if ($_SESSION["role"]==1 && $remetente_permissao == 2) {
                                msg_esquerda($texto, $remetente_foto);
                            }
                            else if ($_SESSION["role"]==2 && $remetente_permissao == 2) {
                                msg_direita($texto, $remetente_foto);
                            }
                            else if ($_SESSION["role"]==2 && $remetente_permissao == 1) {
                                msg_esquerda($texto, $remetente_foto);
                            }


                        }



                        mysqli_stmt_close($stmt3);

                        ?>




                </section>


                <?php

            }

            mysqli_stmt_close($stmt2);

            ?>



            <section id="inputZone" class="row py-2 px-3 bg-inputzone">
                <article class="col-9">
                    <input id="chatInput" class="borderElement p-1 pl-3 borderPic Valign">
                </article>
                <article class="col-1">
                    <i class="fas fa-arrow-alt-circle-right iconsSize Valign"></i>
                </article>
                <article class="col-1">
                    <i class="fas fa-images iconsSize Valign"></i>
                </article>
                <article class="col-1">
                    <i class="fas fa-video iconsSize Valign"></i>
                </article>


            </section>

        </article>


        </section>

</main>




<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>

<!-- js nossos -->
<script src="js/js.js"></script>
</body>
</html>

