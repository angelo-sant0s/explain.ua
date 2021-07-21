<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Tickets</title>
</head>
<body class="cinzaClaroBg">

<?php include_once "components/cp_nav.php";
require_once("connections/connections.php");?>

<main id="ticketsMain" class="container textoEscuro texto fundoClaro borderElement my-5 p-4 p-xl-5">
    <section class="row justify-content-center">
        <article class="col-12 mt-3">
            <h3 class="titulo font-weight-bold text-center mb-4"><?php
                if (isset($_SESSION["user_id"])) $userid = $_SESSION["user_id"];
                if ($_SESSION["role"]==2) echo "Meus Tickets";
                else echo "Tickets";
            ?></h3>
            <?php

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);
            if ($_SESSION["role"]==2) {$query = "SELECT COUNT(ticket.id_ticket) FROM ticket WHERE ticket.estado_id_estado = 1 AND ticket.utilizador_id_utilizador = ?";}
            else {$query = "SELECT COUNT(cadeira_has_utilizador.cadeira_id_cadeira) FROM cadeira_has_utilizador 
                                INNER JOIN ticket ON cadeira_has_utilizador.cadeira_id_cadeira = ticket.cadeira_id_cadeira
                                WHERE cadeira_has_utilizador.utilizador_id_utilizador = ? AND ticket.estado_id_estado = 1";}

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'i', $userid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$num);
            }

            while (mysqli_stmt_fetch($stmt)) {
                echo "<p class='small font-italic  ml-2 mb-0'>Tickets ativos: <span class='font-weight-bold textoAzul1'>$num</span></p>";
            }

            if ($_SESSION["role"]==2) {$query2 = "SELECT COUNT(ticket.id_ticket) FROM ticket WHERE ticket.estado_id_estado = 2 AND ticket.utilizador_id_utilizador = ?";}
            else {$query2 = "SELECT COUNT(cadeira_has_utilizador.cadeira_id_cadeira) FROM cadeira_has_utilizador 
                                INNER JOIN ticket ON cadeira_has_utilizador.cadeira_id_cadeira = ticket.cadeira_id_cadeira
                                WHERE cadeira_has_utilizador.utilizador_id_utilizador = ? AND ticket.estado_id_estado = 2";}

            if (mysqli_stmt_prepare($stmt, $query2)) {
                mysqli_stmt_bind_param($stmt, 'i', $userid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$num2);
            }

            while (mysqli_stmt_fetch($stmt)) {
                echo "<p class='small font-italic  ml-2 mb-0'>Tickets pendentes: <span class='font-weight-bold textoAzul1'>$num2</span></p>";
            }


            mysqli_stmt_close($stmt);

            ?>


        </article>

        <?php

        $link = new_db_connection();
        $stmt2 = mysqli_stmt_init($link);

        if ($_SESSION["role"]==2) {$query2 = "SELECT cadeira.id_cadeira, cadeira.nome, ticket.id_ticket, ticket.estado_id_estado, cadeira.nome, estado.nome, ticket.titulo, ticket.corpo_mensagem, DATE(ticket.data_submissao)
                                FROM cadeira
                                INNER JOIN ticket ON ticket.cadeira_id_cadeira = cadeira.id_cadeira
                                INNER JOIN estado ON estado.id_estado = ticket.estado_id_estado
                                WHERE ticket.utilizador_id_utilizador = ?  
                                ORDER BY `ticket`.`estado_id_estado` ASC";}
        else {$query2 = "SELECT cadeira_has_utilizador.cadeira_id_cadeira, cadeira_has_utilizador.utilizador_id_utilizador, ticket.id_ticket, ticket.estado_id_estado, cadeira.nome, estado.nome, ticket.titulo, ticket.corpo_mensagem, DATE(ticket.data_submissao)
                                FROM cadeira_has_utilizador
                                INNER JOIN ticket ON cadeira_has_utilizador.cadeira_id_cadeira = ticket.cadeira_id_cadeira
                                INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                                INNER JOIN estado ON estado.id_estado = ticket.estado_id_estado
                                WHERE cadeira_has_utilizador.utilizador_id_utilizador = ? ORDER BY ticket.estado_id_estado ASC";}

        if (mysqli_stmt_prepare($stmt2, $query2)) {
            mysqli_stmt_bind_param($stmt2, 'i', $userid);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2,$idcadeira, $id_user, $id_ticket, $id_estado, $nome_cadeira, $estado_nome, $ticket_titulo, $ticket_corpo, $data);
        }
        mysqli_stmt_store_result($stmt2);
        while (mysqli_stmt_fetch($stmt2)) {
            ?>
            <article class="col-12 col-lg-6 mt-xl-4">
                <div class="cinzaClaroBg textoEscuro borderElement p-0 <?php if ($id_estado==3 || $id_estado==4) echo "overlayTicket" ?>">
                    <div class="<?php
                    if ($id_estado==1) echo "azul1";
                    else if ($id_estado==2) echo "rosinha";
                    else if ($id_estado==3 || $id_estado==4) echo "cinzaClaroBg overlayTicket";
                    ?> textoClaro borderElement px-3 py-4">
                        <?php echo $ticket_titulo ?>
                        <!-- <i class="fas fa-exclamation-circle ml-3"></i> -->
                    </div>
                    <div class="pt-3 pb-4 px-5">
                        <p class=" d-flex justify-content-between">
                            <span class="text-left <?php
                            if ($id_estado==1) echo "text-success";
                            else if ($id_estado==2) echo "text-info";
                            else if ($id_estado==3) echo "";
                            else if ($id_estado==4) echo "text-danger";
                            ?>"><i class="fas <?php
                                if ($id_estado==1 || $id_estado==2) echo "fa-spinner";
                                else if ($id_estado==3 || $id_estado==4) echo "fa-lock";
                                ?> fa-sm mr-2"></i> <?php echo $estado_nome ?></span>
                            <?php
                            if ($id_estado == 2 && $_SESSION["role"] != 2) echo "<a class='text-right text-secondary cursor' href='scripts/sc_iniciar_conversa.php?ticket=$id_ticket'>iniciar conversa</a>";
                            else if ($id_estado == 2 && $_SESSION["role"] == 2) echo "<a class='text-right text-secondary cursor' href='scripts/sc_cancelar.php?ticket=$id_ticket'>cancelar pedido</a>";
                            else if ($id_estado==3) {
                                $stmt3 = mysqli_stmt_init($link);
                                $query3 = "SELECT topico.id_topico FROM topico
                                                INNER JOIN ticket ON topico.id_topico = ticket.topico_id_topico
                                                WHERE ticket.id_ticket = ?";

                                if (mysqli_stmt_prepare($stmt3, $query3)) {
                                    mysqli_stmt_bind_param($stmt3, 'i', $id_ticket);
                                    mysqli_stmt_execute($stmt3);
                                    mysqli_stmt_bind_result($stmt3,$id_topico);
                                }

                                mysqli_stmt_store_result($stmt3);
                                while (mysqli_stmt_fetch($stmt3)) {
                                    echo "<a class='text-right text-secondary cursor' href='topico.php?id=$id_topico'>consultar tópico</a>";
                                }

                                mysqli_stmt_close($stmt3);


                            }
                            ?>
                        </p>
                        <p class="font-weight-bold">Dúvida de <span class="textoLab3"><?php echo $nome_cadeira ?></span></p>
                        <p class="collapse font-italic" id="ticket1"><?php echo $ticket_corpo ?></p>
                        <p class="small font-italic">Pedido a <?php echo $data ?></p>
                    </div>
                </div>
                <div class="text-center botaoMais">
                    <button id="botaoFora1" class=" btn rounded-circle borderElement azul1b moreTicket" type="button" data-toggle="collapse" data-target="#ticket1" aria-expanded="false" aria-controls="ticket1">
                        <i id="botaoDentro1" class=' fas fa-chevron-down textoClaro px-1 py-2'></i>
                    </button>
                </div>
            </article>
        <?php
        }

        ?>



    </section>

    <button class=" btn roxinhob textoClaro titulo font-weight-bold borderElement botaoNovo px-4 py-3 <?php
    if ($_SESSION["role"] != 2) {echo "d-none";}
    ?>" id="botaoNovo"><a class="cursor " href="pedido_tickets.php"><i class="fas textoClaro fa-plus fa-sm mr-2"></i><span class="textoClaro">Novo Ticket</span></a></button>

</main>

<!-- Footer -->
<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>

<script src="js/js.js"></script>

</body>
</html>

