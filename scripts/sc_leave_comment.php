<?php
require_once "../connections/connections.php";
session_start();

if (isset($_GET["id"])) {

    $id_ticket = $_GET["id"];

    if (isset($_POST["comment"])) {

        $comment = $_POST["comment"];

        $userid = $_SESSION["user_id"];

        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        $query = "SELECT topico.id_topico 
FROM topico
INNER JOIN ticket ON ticket.topico_id_topico = topico.id_topico
WHERE ticket.id_ticket = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_ticket);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $id_topico);


                if (mysqli_stmt_fetch($stmt)) {

                    mysqli_stmt_close($stmt);
                    $stmt = mysqli_stmt_init($link);

                    $query1 = "INSERT INTO comentario (comentario.texto, comentario.topico_id_topico, comentario.utilizador_id_utilizador, comentario.data_envio, comentario.pontuacao, comentario.id_comentario) VALUES (?, ?, ?,NOW(),0, NULL);";


                    if (mysqli_stmt_prepare($stmt, $query1)) {

                        mysqli_stmt_bind_param($stmt, 'sii', $comment, $id_topico, $userid);


                        // Devemos validar também o resultado do execute!
                        if (mysqli_stmt_execute($stmt)) {
                            // Acção de sucesso
                            mysqli_stmt_close($stmt);
                            header("Location: ../topico.php?id=$id_ticket");

                        } else {
                            // Acção de erro
                            echo "Error:" . mysqli_stmt_error($stmt);
                            header("Location: ../topico.php?id=$id_ticket");
                        }
                    } else {
                        // Acção de erro
                        echo "Error:" . mysqli_error($link);
                        header("Location: ../topico.php?id=$id_ticket");
                    }

                } else {
                    echo mysqli_stmt_error($stmt);
                }


            } else {
                echo mysqli_stmt_error($stmt);
            }


        } else {
            echo mysqli_stmt_error($stmt);
        }

    } else {
        echo "Campos do formulário por preencher";
        header("Location: ../topico.php?id=$id_ticket");

    }
}
