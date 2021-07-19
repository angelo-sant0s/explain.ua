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

if (!isset($_SESSION["username"]) || (($_GET["id"] != $_SESSION["user_id"]))) {
    header("Location: ../blockedAccess.php");
}

$userid = $_GET["id"];


// We need the function!
require_once("connections/connections.php");


// Create a new DB connection
$link = new_db_connection();


/* create a prepared statement */
$stmt = mysqli_stmt_init($link);



$query = "SELECT cadeira.nome FROM cadeira";

if (mysqli_stmt_prepare($stmt, $query)) {

    //mysqli_stmt_bind_param($stmt, 'i', $userid);

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt,$nome);

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




                while (mysqli_stmt_fetch($stmt)) {
                    ?>


                        <section id="joao" class="row p-2 custom-borderb cursorPointer">
                            <article class="col-2 p-0 please ">
                                <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                            </article>

                            <article class="col-10 p-0 pl-1 justify-content-between">
                                <section class="row m-0 h-100">
                                    <article class="col-8 p-0">
                                        <div class=""><?php echo $mod_nome?></div>
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

            <section id="chatRow" class="row chatRow justify-content-center p-3 bg-chat-format">

                <!-- resumo topioc -->
                <article class="col-7">
                    <div class="resumoTop textoClaro bg-roxo borderElement font-italic text-center p-3 mx-5">
                        As minhas dúvidas são as seguintes: em primeiro lugar, qual é a diferença entre scope de bloco e scope de função? E já agora, o conceito de scope de bloco sempre exisitu ou surgiu no EcmaScript6 com o aparecimento do let e do const?
                    </div>
                </article>

                <!-- divisao de 24h -->
                <article class="col-7 text-center font-italic text-secondary">
                    <hr>
                    Ontem às 14:10
                </article>

                <!-- corpo da mensagem -->
                <article class="col-12">


                    <section class="row mt-2">
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                        </article>
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person1 borderElement">Olá Mafalda como estás? Quando estás disponivel para marcarmos uma videochamada?</div>
                        </article>
                    </section>


                    <section class="row mt-2 justify-content-end">
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person2 borderElement">Olá João. Obrigada pela ajuda! Posso agora se tu puderes!</div>
                        </article>
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face2.jpg" class="img-fluid faceIcon">
                        </article>
                    </section>

                    <section class="row mt-2">
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                        </article>
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person1 borderElement">Pode ser! vamos então.</div>
                        </article>
                    </section>

                </article>


                <!-- Indicação de chamada -->
                <article class="col-12 my-3 text-center">
                    <hr>
                    <a href="videochamada.html" class="textoClaro"><span class="py-2 px-3 mt-2 bg-azul2 borderElement d-inline-block">Chamada iniciada</span></a>
                </article>

            </section>

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

