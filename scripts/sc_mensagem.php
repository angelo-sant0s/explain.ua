<?php
require_once "../connections/connections.php";
session_start();

if (isset($_SESSION["user_id"]) && isset($_POST["message"]) && $_SESSION["user_id"] == $_GET["id"] ) {
    $userid = $_SESSION["user_id"];
    $message = $_POST["message"];
    $ticketid = $_GET["ticketid"];
}

// We need the function!
require_once("connections/connections.php");


// Create a new DB connection
$link = new_db_connection();


/* create a prepared statement */
$stmt = mysqli_stmt_init($link);



$query = "INSERT INTO `mensagens` (`id_mensagens`, `texto`, `data_envio`, `ticket_id_ticket`, `utilizador_id_utilizador`) VALUES ('NULL', ?, NOW(), ?, ?)";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'sii', $message, $ticketid, $userid);

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
