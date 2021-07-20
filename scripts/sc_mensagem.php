<?php
require_once "../connections/connections.php";
session_start();




if (isset($_SESSION["user_id"]) && isset($_POST["mensagem"]) && $_SESSION["user_id"] == $_GET["id"] ) {
    $userid = $_SESSION["user_id"];
    $message = $_POST["mensagem"];
    $ticketid = $_GET["ticketid"];

echo "is it";


// Create a new DB connection
$link = new_db_connection();


/* create a prepared statement */
$stmt = mysqli_stmt_init($link);


    $query = "INSERT INTO mensagens (id_mensagens, texto, data_envio, ticket_id_ticket, utilizador_id_utilizador) VALUES (NULL, ?, NOW(),?,? )";
    $query2 = "UPDATE ticket SET data_ultima = NOW() WHERE ticket.id_ticket = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'sii', $message, $ticketid, $userid);
    mysqli_stmt_execute($stmt);
}

    if (mysqli_stmt_prepare($stmt, $query2)) {
        mysqli_stmt_bind_param($stmt, 'i', $ticketid);
        mysqli_stmt_execute($stmt);
    }
    header("Location: ../chat.php?id=$userid");







mysqli_stmt_close($stmt);

}

?>


