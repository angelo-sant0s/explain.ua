<?php

if (isset($_POST["id_users"])){

    $userid = $_POST["id_users"];

    $username = $_POST["username"];

    $email = $_POST["email"];

    //$active = $_POST["active"];

    $role = $_POST["id_roles"];

    switch ($role){
        case 'Utilizador':
            $id_role = 2;
        break;
        case 'Admin':
            $id_role = 3;
        break;
        case 'Mod':
            $id_role = 1;
        break;
    }

    require_once("../connections/connection.php");


    $link = new_db_connection();


    $stmt = mysqli_stmt_init($link);



    $query = "UPDATE utilizador SET utilizador.username = ?, utilizador.email = ?, utilizador.perfil_idperfil = ? WHERE utilizador.id_utilizador = ?";

    if (mysqli_stmt_prepare($stmt, $query)){

        mysqli_stmt_bind_param($stmt, 'ssii', $username, $email, $id_role, $userid);

    }

    if (mysqli_stmt_execute($stmt)) {
        // Acção de sucesso
        mysqli_stmt_close($stmt);
        header("Location: ../pages/users.php");
    } else {
        // Acção de erro
        echo "Error:" . mysqli_stmt_error($stmt);
       header("Location: ../pages/users.php");
    }

}

