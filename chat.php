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

$lastmsgarray = "";

function msg_direita($mensagem, $foto, $idmsg){
    echo "<section id='msg".$idmsg."' class='row mt-2 justify-content-end'>
                                        <article class='col-8 p-1''>
                                            <div class='p-2 bg-person2 borderElement'>".$mensagem."</div>
                                        </article>
                                        <article class='col-1 p-1 text-center''>
                                            <img src='imgs/recursos/".$foto."' class='img-fluid faceIcon'>
                                        </article>
                                    </section>";
}

function msg_esquerda($mensagem, $foto, $idmsg){
    echo "<section id='msg".$idmsg."' class='row mt-2'>
                                        <article class='col-1 p-1 text-center'>
                                            <img src='imgs/recursos/".$foto."' class='img-fluid faceIcon'>
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
    header("Location: index.php?msg=3");
}

$userid = $_SESSION["user_id"];
$perfilid = $_SESSION["role"];
$botid = 0;


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

                if ($_SESSION["role"]==2) {
                    $query = "SELECT  ticket.titulo, ticket.id_ticket, ticket.data_ultima, cadeira.sigla, HOUR(TIMEDIFF(NOW(), ticket.data_ultima)), MINUTE(TIMEDIFF(NOW(), ticket.data_ultima)), HOUR(ticket.data_ultima), MINUTE(ticket.data_ultima)
                            FROM ticket
                            INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador
                            INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                            WHERE ticket.utilizador_id_utilizador = ?  
                            ORDER BY `ticket`.`data_ultima` DESC";
                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $userid);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $ticket_nome, $ticket_id, $ticket_ultima, $cadeira_sigla, $publishing_hour, $publishing_minute, $relogio_horas, $relogio_minutos);

                    }
                }
                else if ($_SESSION["role"]==1) {
                    $query = "SELECT  ticket.titulo, ticket.id_ticket, ticket.data_ultima, cadeira.sigla, HOUR(TIMEDIFF(NOW(), ticket.data_ultima)), MINUTE(TIMEDIFF(NOW(), ticket.data_ultima)), HOUR(ticket.data_ultima), MINUTE(ticket.data_ultima)
                            FROM ticket
                            INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador
                            INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                            WHERE ticket.utilizador_id_utilizador1 = ?
                            ORDER BY `ticket`.`data_ultima` DESC";
                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $userid);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $ticket_nome, $ticket_id, $ticket_ultima, $cadeira_sigla, $publishing_hour, $publishing_minute, $relogio_horas, $relogio_minutos);

                    }
                }





                $num_ids = "";
                mysqli_stmt_store_result($stmt);
                while (mysqli_stmt_fetch($stmt)) {
                    if ($num_ids=="") $num_ids = $ticket_id ;
                    else $num_ids = $num_ids . " " . $ticket_id ;
                    ?>

                    <?php
                    $link20 = new_db_connection();
                    $stmt20 = mysqli_stmt_init($link);
                    if ($_SESSION["role"]==2) {$query20 = "SELECT utilizador.nome, utilizador.foto_perfil FROM utilizador INNER JOIN ticket ON ticket.utilizador_id_utilizador1 = utilizador.id_utilizador WHERE ticket.id_ticket = ?";}
                    else {$query20 = "SELECT utilizador.nome, utilizador.foto_perfil FROM utilizador INNER JOIN ticket ON ticket.utilizador_id_utilizador = utilizador.id_utilizador WHERE ticket.id_ticket = ?";}

                    if (mysqli_stmt_prepare($stmt20, $query20)) {
                        mysqli_stmt_bind_param($stmt20, 'i', $ticket_id);
                        mysqli_stmt_execute($stmt20);
                        mysqli_stmt_bind_result($stmt20,$mod_nome, $mod_foto);
                    }

                    mysqli_stmt_store_result($stmt20);

                    if (mysqli_stmt_fetch($stmt20)) {

                    }
                    else {
                        $mod_nome = "Sem mentor atríbuído";
                        $mod_foto = "default.jpg";
                    }

                    mysqli_stmt_close($stmt20);

                    ?>


                        <section id="smallchat<?php echo $ticket_id?>" class="row p-2 custom-borderb cursorPointer">
                            <article class="col-2 p-0 please ">
                                <img src="imgs/recursos/<?php
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
                echo "<h1 id='userid' class='d-none'>$userid</h1>"
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


            if ($_SESSION["role"]==2) {
                $query2 = "SELECT ticket.id_ticket, ticket.titulo, ticket.corpo_mensagem, YEAR(ticket.data_submissao), MONTHNAME(ticket.data_submissao), DAY(ticket.data_submissao), HOUR(ticket.data_submissao), MINUTE(ticket.data_submissao) FROM ticket  
                        WHERE ticket.utilizador_id_utilizador = ?  
                        ORDER BY `ticket`.`data_ultima` DESC";
            }
            else if ($_SESSION["role"]==1) {
                $query2 = "SELECT ticket.id_ticket, ticket.titulo, ticket.corpo_mensagem, YEAR(ticket.data_submissao), MONTHNAME(ticket.data_submissao), DAY(ticket.data_submissao), HOUR(ticket.data_submissao), MINUTE(ticket.data_submissao) FROM ticket  
                        WHERE ticket.utilizador_id_utilizador1 = ?  
                        ORDER BY `ticket`.`data_ultima` DESC";
            }

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





                        if ($_SESSION["role"]==2) {
                            $query3 = "SELECT ticket.id_ticket, mensagens.texto, mensagens.utilizador_id_utilizador, utilizador.perfil_idperfil, utilizador.foto_perfil, mensagens.id_mensagens FROM ticket
                                        INNER JOIN mensagens ON mensagens.ticket_id_ticket = ticket.id_ticket
                                        INNER JOIN utilizador ON utilizador.id_utilizador = mensagens.utilizador_id_utilizador
                                        WHERE ticket.utilizador_id_utilizador = ? AND ticket.id_ticket = ?  
                                        ORDER BY `mensagens`.`data_envio` ASC";
                        }
                        else if ($_SESSION["role"]==1) {
                            $query3 = "SELECT ticket.id_ticket, mensagens.texto, mensagens.utilizador_id_utilizador, utilizador.perfil_idperfil, utilizador.foto_perfil, mensagens.id_mensagens FROM ticket
                                        INNER JOIN mensagens ON mensagens.ticket_id_ticket = ticket.id_ticket
                                        INNER JOIN utilizador ON utilizador.id_utilizador = mensagens.utilizador_id_utilizador
                                        WHERE ticket.utilizador_id_utilizador1 = ? AND ticket.id_ticket = ?  
                                        ORDER BY `mensagens`.`data_envio` ASC";
                        }

                        if (mysqli_stmt_prepare($stmt3, $query3)) {

                        mysqli_stmt_bind_param($stmt3, 'ii', $userid, $ticket_id);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt3);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt3,$id_ticket_useless, $texto, $remetente_id, $remetente_permissao, $remetente_foto, $mensagem_id );

                        }





                        mysqli_stmt_store_result($stmt3);
                        while (mysqli_stmt_fetch($stmt3)) {

                            if ($texto=="") {

                                $stmt10 = mysqli_stmt_init($link);
                                $query10 = "SELECT recursos.link_recurso, tipo.terminacao FROM recursos INNER JOIN tipo ON tipo.id_tipo = recursos.tipo_id_tipo WHERE recursos.mensagens_id_mensagens = ?";
                                if (mysqli_stmt_prepare($stmt10, $query10)) {
                                    mysqli_stmt_bind_param($stmt10, 'i', $mensagem_id);
                                    mysqli_stmt_execute($stmt10);
                                    mysqli_stmt_bind_result($stmt10,$nome_recurso, $tipo_recurso);
                                }
                                mysqli_stmt_store_result($stmt10);
                                while (mysqli_stmt_fetch($stmt10)) {
                                    switch ($tipo_recurso){
                                        case ".jpg":
                                        case ".gif":
                                        case ".png":
                                            $texto = "<img  class='img-fluid' src='imgs/recursos/$nome_recurso$tipo_recurso'>";
                                            break;
                                        case ".mp4":
                                        case ".mov":
                                            $texto = "<video  controls>
                                                          <source src='imgs/recursos/$nome_recurso.mp4' type='video/mp4'>
                                                          <source src='imgs/recursos/$nome_recurso.mov' type='video/mov'>
                                                       </video>";
                                            break;
                                        case ".mp3":
                                            $texto = "<audio controls>
                                                          <source src='imgs/recursos/$nome_recurso.mp3' type='audio/mpeg'>
                                                      </audio>";
                                            break;
                                    }


                                }
                                mysqli_stmt_close($stmt10);

                            }

                            if ($remetente_id == $botid) {
                                // mensagens do bot
                            }
                            else if ($_SESSION["role"]==1 && $remetente_permissao == 1) {
                                msg_direita($texto, $remetente_foto, $mensagem_id);
                            }
                            else if ($_SESSION["role"]==1 && $remetente_permissao == 2) {
                                msg_esquerda($texto, $remetente_foto, $mensagem_id);
                            }
                            else if ($_SESSION["role"]==2 && $remetente_permissao == 2) {

                                msg_direita($texto, $remetente_foto, $mensagem_id);
                            }
                            else if ($_SESSION["role"]==2 && $remetente_permissao == 1) {
                                msg_esquerda($texto, $remetente_foto, $mensagem_id);
                            }



                        }
                        if ($lastmsgarray=="") {
                            $lastmsgarray = "$mensagem_id";
                        }
                        else ($lastmsgarray = $lastmsgarray . " " . $mensagem_id);





                        mysqli_stmt_close($stmt3);

                        ?>




                </section>


                <?php

            }

            mysqli_stmt_close($stmt2);
            echo "<h1 id='lastmessageid' class='d-none'>$lastmsgarray</h1>";
            ?>



            <section id="inputZone" class="row py-2 px-3 bg-inputzone">


                <form id="formMessage" class="col-10 p-0 d-flex" role="form" action="esta action é definida no javascript" method="post">
                    <article class="col-11 p-0">
                        <input id="chatInput" class="borderElement p-1 pl-3 borderPic Valign" name="mensagem">
                    </article>
                    <article class="col-1">
                        <button class="fas fa-arrow-alt-circle-right iconsSize Valign p-0 m-0 border-0 bg-transparent" type="submit"></button>
                    </article>
                </form>

                <form id="formMessage2" class=" align-items-center text-center py-3  " action="tambem definida no js" method=post enctype=multipart/form-data>
                    <input class="border-1 mx-2  text-light px-0 col-6 position-relative"  type="file" name="fileToUpload" id="fileToUpload">
                    <input class="border-1 btn btn-light my-0 col-4 mx-1" type="submit" value="uplod" name="submit">
                </form>



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

