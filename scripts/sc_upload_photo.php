<?php

require_once "../connections/connections.php";

session_start();
$target_dir = "../imgs/recursos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (isset($_SESSION["id_user"])) {
    $id_utlizador = $_SESSION["id_user"];
}

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 100000*1024) {
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
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
        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {$errors = 1;}
        else {
            $size = filesize($_FILES['fileToUpload']['tmp_name']);
            if ($size > 50000000 * 1024) {
                echo "You have exceeded the size limit";
                $errors = 1;
            }
            if ($extension == "jpg" || $extension == "jpeg") {$src = imagecreatefromjpeg($uploadedfile);}
            else if ($extension == "png") {$src = imagecreatefrompng($uploadedfile);}
            else {$src = imagecreatefromgif($uploadedfile);}
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

        // Update do campo imagem na tabela X
        $user = $_SESSION["username"];
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $nome_imagem= htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
        $query ="UPDATE utilizador SET foto_perfil = ? WHERE utilizador.id_utilizador = ?";
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'si', $nome_imagem, $id_utlizador);
            mysqli_stmt_execute($stmt);
        }else {
            echo mysqli_stmt_error($stmt);
        }
        header("Location: ../perfil.php?id=$id_utlizador");

        // Redirecionar para página qualquer
    } else {

    }
}

?>