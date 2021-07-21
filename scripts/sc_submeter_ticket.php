<?php
require_once "../connections/connections.php";
session_start();


echo $_GET["idCadeira"];
echo $_POST["tituloTicket"];

if (isset($_POST["tituloTicket"]) && isset($_POST["corpoTicket"]) && isset($_GET["idCadeira"]) ) {
    $ticket_titulo = $_POST["tituloTicket"];
    $ticket_corpo = $_POST["corpoTicket"];
    $cadeira_id = $_GET["idCadeira"];
    $userid = $_SESSION["user_id"];


    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $query = "INSERT INTO ticket (id_ticket, titulo, corpo_mensagem, cadeira_id_cadeira, utilizador_id_utilizador, data_submissao, topico_id_topico, utilizador_id_utilizador1, estado_id_estado, data_ultima) VALUES (NULL, ?, ?, ?, ?, NOW(), NULL, NULL, '2', NOW()) ";


    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssii', $ticket_titulo, $ticket_corpo, $cadeira_id, $userid);
        mysqli_stmt_execute($stmt);
    }

    header("Location: ../tickets.php?id=$userid");

    mysqli_stmt_close($stmt);


}
