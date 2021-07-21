<?php
require_once "../connections/connections.php";
session_start();

if ($_SESSION["role"] == 1 && isset($_GET["ticket"])) {
    echo "working";
    $ticket_id = $_GET["ticket"];
    $mod_id = $_SESSION["user_id"];
    //update na bd
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE ticket SET utilizador_id_utilizador1 = ?, data_ultima = NOW(), estado_id_estado = 1 WHERE ticket.id_ticket = ?;";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ii', $mod_id, $ticket_id);
        mysqli_stmt_execute($stmt);

    }

    mysqli_stmt_close($stmt);
    header("Location: ../chat.php?id=$mod_id");

}
