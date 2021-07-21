<?php

if (isset($_POST["id_ticket"])){

    $idticket = $_POST["id_ticket"];

    $username = $_POST["username"];

    $cadeira = $_POST["cadeira"];

    $estado = $_POST["estado"];

    switch ($estado){
        case 'Recusado/Cancelado':
            $id_estado = 4;
            break;
        case 'Pendente':
            $id_estado = 2;
            break;
        case 'Resolvido':
            $id_estado = 3;
            break;
        case 'Ativo':
            $id_estado = 1;
            break;
    }

    require_once("../connections/connection.php");

    echo $cadeira;


    $link = new_db_connection();


    $stmt = mysqli_stmt_init($link);

     $query4 = "SELECT cadeira.id_cadeira, utilizador.id_utilizador 
                FROM cadeira 
                INNER JOIN ticket ON ticket.cadeira_id_cadeira = cadeira.id_cadeira
                INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
                WHERE cadeira.nome = ? AND utilizador.username = ?";

     if (mysqli_stmt_prepare($stmt, $query4)) {

         mysqli_stmt_bind_param($stmt, 'ss', $cadeira, $username);

    /* execute the prepared statement */
       mysqli_stmt_execute($stmt);

    /* bind result variables */
       mysqli_stmt_bind_result($stmt,$chair, $userid);

     }

      mysqli_stmt_store_result($stmt);
      while (mysqli_stmt_fetch($stmt)) {



    $stmt1 = mysqli_stmt_init($link);


    $query = "UPDATE ticket SET ticket.utilizador_id_utilizador = ? ,ticket.cadeira_id_cadeira = ? , ticket.estado_id_estado = ? WHERE ticket.id_ticket = ?";

    if (mysqli_stmt_prepare($stmt1, $query)){

        mysqli_stmt_bind_param($stmt1, 'iiii', $userid, $chair, $id_estado, $idticket);

    }

    if (mysqli_stmt_execute($stmt1)) {
        // Acção de sucesso
        mysqli_stmt_close($stmt1);
        //header("Location: ../pages/tickets.php");
    } else {
        echo "Error:" . mysqli_stmt_error($stmt1);
        //header("Location: ../pages/tickets.php");
    }

}

}


