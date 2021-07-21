<?php
require_once "../connections/connections.php";
session_start();

if (isset($_GET["ticket"]) && isset($_SESSION["role"])) {
    $ticket_id = $_GET["ticket"];
    $userid = $_SESSION["user_id"];

    //update na bd
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE ticket SET data_ultima = NOW(), estado_id_estado = 4 WHERE ticket.id_ticket = ?;";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'i',$ticket_id);
        mysqli_stmt_execute($stmt);

    }

    mysqli_stmt_close($stmt);
    header("Location: ../tickets.php?id=$userid");
}
