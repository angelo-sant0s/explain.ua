<?php
require_once "../connections/connections.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password_hash, perfil_idperfil, id_utilizador FROM utilizador WHERE username LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $username);

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_bind_result($stmt, $password_hash, $perfil, $user_id);

            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $password_hash)) {
                    // Guardar sessão de utilizador
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = $perfil;
                    $_SESSION["user_id"] = $user_id;

                    // Feedback de sucesso
                    header("Location: ../home.php");
                } else {
                    // Password está errada
                    echo "Incorrect credentials!";
                    echo "<a href='../index.php'>Try again</a>";
                }
            } else {
                // Username não existe
                echo "Incorrect credentials!";
                echo "<a href='../index.php'>Try again</a>";
            }
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