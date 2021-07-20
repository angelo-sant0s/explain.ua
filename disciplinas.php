<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Explain.ua</title>
</head>
<body class="bgClaro">


<?php include_once "components/cp_nav.php"; ?>
<?php
require_once "connections/connections.php";
$link= new_db_connection();
$stmt=mysqli_stmt_init($link);

if (isset($_GET["id"])) {
    $id_cadeira = $_GET["id"];
}


echo $id_cadeira;
$confirma=0;

$querry="SELECT cadeira.nome, ticket.titulo, ticket.corpo_mensagem, ticket.data_submissao, utilizador.nome, recursos.tipo_id_tipo, ticket.imagem, utilizador.id_utilizador, cadeira.imagem, cadeira.sigla FROM ticket INNER JOIN cadeira ON ticket.cadeira_id_cadeira=cadeira.id_cadeira INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador WHERE cadeira.id_cadeira = ?";





  if(mysqli_stmt_prepare($stmt,$querry)){
        mysqli_stmt_bind_param($stmt, 's', $id_cadeira);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$cadeira, $titulo, $mensagem, $data, $utilizador, $tiporec, $imagem, $id_user, $imagem_cad, $sigla_cad);
  }


while(mysqli_stmt_fetch($stmt)) {
    if($confirma==0){
?>



<div class="container azul1b shadow borderElement p-5">
    <section class="row pt-3 ">
        <article class="col-12 text-center andabaixo">
            <img src="imgs/<?=$imagem_cad?>.png">
            <h3 class="titulo textoClaro font-weight-bold pt-5"><?=$cadeira?></h3>
        </article>
    </section>
</div>
<?php
        $confirma=1;
}
}
?>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98 shadow">
    <section class="row text-center pt-2">
        <article class="col-12">
            <p class="titulo text-black-50">Ordenar tópicos por:</p>
        </article>
    </section>
    <section class="row justify-content-between text-center p-2">
        <article class="col-12 col-lg-6 filtro">
            <button class="btn border-0 rounded-pill btn-outline-dark shadow bgClaro roxinho mr-3"><i class="fas fa-clock fa-2x px-1"></i><span class="pb-2">Recente</span></button>
            <button class="btn border-0 rounded-pill btn-outline-dark shadow bgClaro roxinho mr-3"><i class="fas fa-fire fa-2x px-1"></i><span class="pb-2">Popular</span></button>
            <button class="btn border-0 rounded-pill btn-outline-dark shadow bgClaro roxinho mr-3"><i class="fas fa-arrow-up fa-2x px-1"></i><span class="pb-2">Top</span></button>
        </article>
        <article class="col-12 col-lg-6 text-center position-relative mt-lg-0 mt-4 search_box">
            <input type="text" placeholder="Search" class="pl-3 shadow">
            <i class="fas fa-search lupa roxinho"></i>
        </article>
    </section>

</div>

<!------------------>

<?php

mysqli_stmt_close($stmt);

$stmt1=mysqli_stmt_init($link);


$querry1="SELECT cadeira.nome, ticket.titulo, ticket.corpo_mensagem, ticket.data_submissao, utilizador.nome, recursos.tipo_id_tipo, ticket.imagem, utilizador.id_utilizador, cadeira.imagem, cadeira.sigla FROM ticket INNER JOIN cadeira ON ticket.cadeira_id_cadeira=cadeira.id_cadeira INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador WHERE cadeira.id_cadeira = ?";





if(mysqli_stmt_prepare($stmt1,$querry1)){
    mysqli_stmt_bind_param($stmt1, 's', $id_cadeira);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_bind_result($stmt1,$cadeira1, $titulo1, $mensagem1, $data1, $utilizador1, $tiporec1, $imagem1, $id_user1, $imagem_cad1, $sigla_cad1);
}



while(mysqli_stmt_fetch($stmt1)) {


if($tiporec=="1"){
    $tipofic="png";
}


echo "<div class=\"container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98\">
    <div class=\"pl-3 py-4\">
        <img class=\"iconzito float-left pr-4\" src=\"imgs/iconn.png\">
        <div class=\"row\">
            <article class=\"col-9\">
                <h3 class=\"titulo\"><a href=\"topico.html\">" . $titulo1 . "</a></h3>
                <a href=\"http://localhost/github/perfil.php?id=" . $id_user1 ." \"><h5 class=\"titulo font-italic text-black-50\">" . $utilizador1 . "</h5></a>
            </article>
            <article class=\"col-3\">
                <div class=\"float-right\">
                    <i class=\"fas fa-angle-up fa-2x d-block\"></i>
                    <i class=\"fas fa-angle-down fa-2x d-block\"></i>
                </div>
            </article>
        </div>

        <hr>
        <p class=\"texto pt-3 px-4 mb-0\">" . $mensagem1 . "</p>
        
       
        <div class=\"text-center\">
        ";
    if(isset($imagem1)){
        echo "<img class=\"w-75 h-auto py-5\" src=\"imgs/$imagem1.$tipofic\">";
    }
    else{ echo "<div class='py-4'></div>";}

        echo "</div>
        <div class=\"text-secondary font-italic\">
            <span>73 Comentários</span>
            <i class=\"fas fa-comment\"></i>
            <div class=\"float-right pr-4\">Postado " . $data1 . "</div>
        </div>
    </div>
</div>";
}
?>
<!------------------>

    </div>
</div>






<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>
</body>
</html>

