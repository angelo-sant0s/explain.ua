<?php

require_once "../connections/connections.php";

session_start();
$target_dir = "../imgs/recursos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$pieces = explode(".",basename($_FILES["fileToUpload"]["name"]));
$nome_file = "";
$terminacao = ".".$pieces[sizeof($pieces)-1];
for ($i=0; $i < sizeof($pieces)-1; $i++) {
    if ($nome_file == "") {$nome_file = $pieces[0];}
    else $nome_file = $nome_file . "." . $pieces[$i];
}

echo "teste";


if (isset($_SESSION["user_id"])) {
    $id_utlizador = $_SESSION["user_id"];
}

if (isset($_GET["ticketid"])) {$ticketid = $_GET["ticketid"];}

if ($terminacao == ".jpg" || $terminacao == "png" || $terminacao == "gif") {
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {

        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 100000 * 1024) {
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    define("MAX_SIZE", "500000");

    $errors = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $image = $_FILES["fileToUpload"]["name"];
        $uploadedfile = $_FILES['fileToUpload']['tmp_name'];

        if ($image) {
            $filename = stripslashes($_FILES['fileToUpload']['name']);
            $extension = $imageFileType;
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                $errors = 1;
            } else {
                $size = filesize($_FILES['fileToUpload']['tmp_name']);
                if ($size > 50000000 * 1024) {
                    echo "You have exceeded the size limit";
                    $errors = 1;
                }
                if ($extension == "jpg" || $extension == "jpeg") {
                    $src = imagecreatefromjpeg($uploadedfile);
                } else if ($extension == "png") {
                    $src = imagecreatefrompng($uploadedfile);
                } else {
                    $src = imagecreatefromgif($uploadedfile);
                }
                list($width, $height) = getimagesize($uploadedfile);
            }
        }
    }
//If no errors registred, print the success message

    if (isset($_POST['Submit']) && !$errors) {
        // mysql_query("update SQL statement ");
        echo "Image Uploaded Successfully!";

    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<h2 class='text-white-50 mx-auto my-5'>Sorry, your file was not uploaded.</h2>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            // criar aqui uma mensagem á qual o recurso vai ser adicionado
            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "INSERT INTO mensagens (id_mensagens, texto, data_envio, ticket_id_ticket, utilizador_id_utilizador) VALUES (NULL, '', NOW(),?,? )";
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'ii', $ticketid, $id_utlizador);
                mysqli_stmt_execute($stmt);
            }


            $query1 = "UPDATE ticket SET data_ultima = NOW() WHERE ticket.id_ticket = ?";
            if (mysqli_stmt_prepare($stmt, $query1)) {
                mysqli_stmt_bind_param($stmt, 'i', $ticketid);
                mysqli_stmt_execute($stmt);
            }

            $query2 = "SELECT mensagens.id_mensagens FROM mensagens WHERE mensagens.ticket_id_ticket = ?  
ORDER BY mensagens.id_mensagens  DESC LIMIT 1";
            if (mysqli_stmt_prepare($stmt, $query2)) {
                mysqli_stmt_bind_param($stmt, 'i', $ticketid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_mensagem);
            }

            mysqli_stmt_store_result($stmt);
            while (mysqli_stmt_fetch($stmt)) {

                $stmt2 = mysqli_stmt_init($link);
                // Update do campo imagem na tabela X
                //$nome_imagem= htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
                echo $nome_file . " " . $terminacao;
                // aqui é dar insert na cena
                switch ($terminacao) {
                    case ".gif":
                        $terminacao_id = 4;
                        break;
                    case ".jpg":
                        $terminacao_id = 1;
                        break;
                    case ".png":
                        $terminacao_id = 2;
                        break;
                }
                $query3 = "INSERT INTO recursos (id_recursos, ticket_id_ticket, topico_id_topico, mensagens_id_mensagens, tipo_id_tipo, comentario_id_comentario, link_recurso) VALUES (NULL, NULL, NULL, ?, ?, NULL, ?)";
                if (mysqli_stmt_prepare($stmt2, $query3)) {
                    mysqli_stmt_bind_param($stmt2, 'iis', $id_mensagem, $terminacao_id, $nome_file);
                    mysqli_stmt_execute($stmt2);
                } else {
                    echo mysqli_stmt_error($stmt2);
                }

            }


            header("Location: ../chat.php?id=$id_utlizador");


        } else {

        }
    }
}

else if ($terminacao == ".mp3" || $terminacao == ".mp4" || $terminacao == ".mov"){
    $size = filesize($_FILES['fileToUpload']['tmp_name']);
    if ($size > 50000000 * 1024) {
        echo "You have exceeded the size limit";
        $errors = 1;
    }
    echo "You have NOT MORE THNA  the size limit";

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // criar aqui uma mensagem á qual o recurso vai ser adicionado
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "INSERT INTO mensagens (id_mensagens, texto, data_envio, ticket_id_ticket, utilizador_id_utilizador) VALUES (NULL, '', NOW(),?,? )";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ii', $ticketid, $id_utlizador);
            mysqli_stmt_execute($stmt);
        }


        $query1 = "UPDATE ticket SET data_ultima = NOW() WHERE ticket.id_ticket = ?";
        if (mysqli_stmt_prepare($stmt, $query1)) {
            mysqli_stmt_bind_param($stmt, 'i', $ticketid);
            mysqli_stmt_execute($stmt);
        }

        $query2 = "SELECT mensagens.id_mensagens FROM mensagens WHERE mensagens.ticket_id_ticket = ?  
ORDER BY mensagens.id_mensagens  DESC LIMIT 1";
        if (mysqli_stmt_prepare($stmt, $query2)) {
            mysqli_stmt_bind_param($stmt, 'i', $ticketid);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_mensagem);
        }

        mysqli_stmt_store_result($stmt);
        while (mysqli_stmt_fetch($stmt)) {

            $stmt2 = mysqli_stmt_init($link);
            echo $nome_file . " " . $terminacao;

            switch ($terminacao) {
                case ".mov":
                    $terminacao_id = 6;
                    break;
                case ".mp3":
                    $terminacao_id = 5;
                    break;
                case ".mp4":
                    $terminacao_id = 3;
                    break;
            }
            $query3 = "INSERT INTO recursos (id_recursos, ticket_id_ticket, topico_id_topico, mensagens_id_mensagens, tipo_id_tipo, comentario_id_comentario, link_recurso) VALUES (NULL, NULL, NULL, ?, ?, NULL, ?)";
            if (mysqli_stmt_prepare($stmt2, $query3)) {
                mysqli_stmt_bind_param($stmt2, 'iis', $id_mensagem, $terminacao_id, $nome_file);
                mysqli_stmt_execute($stmt2);
            } else {
                echo mysqli_stmt_error($stmt2);
            }

        }


        header("Location: ../chat.php?id=$id_utlizador");


    }
}



