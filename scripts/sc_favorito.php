<?php

require_once "../connections/connections.php";
session_start();

if (isset($_GET["id"])) {

    $id_ticket = $_GET["id"];

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

                mysqli_stmt_store_result($stmt);

                while(mysqli_stmt_fetch($stmt)) {

                    $stmt2 = mysqli_stmt_init($link);

                    $query2 = "SELECT utilizador_has_topico.utilizador_id_utilizador, utilizador_has_topico.topico_id_topico, utilizador_has_topico.favorito
FROM utilizador_has_topico
WHERE utilizador_has_topico.utilizador_id_utilizador = ? AND  utilizador_has_topico.topico_id_topico = ?";

                    if (mysqli_stmt_prepare($stmt2, $query2)) {

                        mysqli_stmt_bind_param($stmt2, 'ii', $userid, $id_topico);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt2);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt2,$x,$y,$z);

                    }
                    $contador_temp = 0;
                    while (mysqli_stmt_fetch($stmt2)) {

                        $contador_temp++;


                    }

                    mysqli_stmt_close($stmt2);


                    $stmt1 = mysqli_stmt_init($link);

                    if($contador_temp == 0){
                        $query1 = "INSERT INTO utilizador_has_topico (utilizador_has_topico.utilizador_id_utilizador, utilizador_has_topico.topico_id_topico,utilizador_has_topico.favorito,utilizador_has_topico.votos_id_votos) VALUES(?,?,1,1)";
                    }else{
                        $query1 = "UPDATE `utilizador_has_topico` SET `favorito` = ? WHERE `utilizador_has_topico`.`utilizador_id_utilizador` = ? AND `utilizador_has_topico`.`topico_id_topico` = ?";
                    }

                    if (mysqli_stmt_prepare($stmt1, $query1)) {

                            if ($z == 1) $fav = 0;
                            else $fav = 1;

                        if($contador_temp == 0) {
                            mysqli_stmt_bind_param($stmt1, 'ii', $userid, $id_topico);
                        }else{
                            mysqli_stmt_bind_param($stmt1, 'iii', $fav, $userid, $id_topico);
                        }

                        // Devemos validar tamb??m o resultado do execute!
                        if (mysqli_stmt_execute($stmt1)) {
                            // Ac????o de sucesso
                            mysqli_stmt_close($stmt1);
                            header("Location: ../topico.php?id=$id_ticket");

                        } else {
                            // Ac????o de erro
                            echo "Error:" . mysqli_stmt_error($stmt1);
                           header("Location: ../topico.php?id=$id_ticket");
                        }
                    } else {
                        // Ac????o de erro
                        echo "Error:" . mysqli_error($link);
                        header("Location: ../topico.php?id=$id_ticket");
                    }

                }

            } else {
                echo mysqli_stmt_error($stmt);
            }


        } else {
            echo mysqli_stmt_error($stmt);
        }
}
