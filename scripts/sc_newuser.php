<?php
require_once "../connections/connections.php";

session_start();


$user_id = $_GET["id"];

if (isset($_POST["usrname"])) {
    $novo_username = $_POST["usrname"];
}
if (isset($_POST["password"])) {
    $passworddd = $_POST["password"];
}

$link = new_db_connection();

$stmt = mysqli_stmt_init($link);


$query = "SELECT utilizador.username, utilizador.password_hash, utilizador.id_utilizador FROM utilizador WHERE utilizador.id_utilizador = "."'$user_id'";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $old_userrname, $passs , $utilizadorid);
}else {
    echo mysqli_stmt_error($stmt);
}

while (mysqli_stmt_fetch($stmt)) {

    password_verify($passworddd, $passs);
    echo"ola";
    echo $passs;

    if (password_verify($passworddd, $passs)==TRUE){
        $confirma1=1;
        if($user_id==$utilizadorid){
            echo"ola2";
            $confirma2=1;

    }
    }

}

if(isset($confirma1) && $confirma1==1 && isset($confirma1) && $confirma2==1){
    mysqli_stmt_close($stmt);
    $stmt1 = mysqli_stmt_init($link);
    $query1 ="UPDATE `utilizador` SET `username` = "."'$novo_username'"." WHERE `utilizador`.`id_utilizador` = "."'$utilizadorid'";
    if (mysqli_stmt_prepare($stmt1, $query1)) {
        mysqli_stmt_execute($stmt1);
        echo"ola3";
        session_destroy();
        header("Location: ../index.php?msg=1");
    }else {
        echo mysqli_stmt_error($stmt1);
        header("Location: ../index.php?msg=2");
    }
}else {
    header("Location: ../index.php?msg=2");
}


?>

