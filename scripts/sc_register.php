<?php
require_once "../connections/connections.php";


if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $data_nascimento =$_POST['date'];
    $nmec = $_POST['nmec'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO utilizador (username, email, password_hash, data_nascimento, numero_mecanografico, perfil_idperfil, foto_perfil, data_registo ) VALUES (?,?,?,?,?,2,'default.jpg', NOW() )";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $username, $email, $password_hash, $data_nascimento, $nmec);

        // Devemos validar também o resultado do execute!
        if (mysqli_stmt_execute($stmt)) {
            // Acção de sucesso
            header("Location: ../index.php");
        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo "Campos do formulário por preencher";
}

