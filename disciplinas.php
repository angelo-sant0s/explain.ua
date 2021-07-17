<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Laboratório Multimédia 4</title>
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



$id_cadeira=1;

$querry="SELECT cadeira.nome, ticket.titulo, ticket.corpo_mensagem, ticket.data_submissao, utilizador.nome, recursos.tipo_id_tipo, ticket.imagem, utilizador.id_utilizador FROM ticket INNER JOIN cadeira ON ticket.cadeira_id_cadeira=cadeira.id_cadeira INNER JOIN recursos ON recursos.ticket_id_ticket = ticket.id_ticket INNER JOIN utilizador ON ticket.utilizador_id_utilizador = utilizador.id_utilizador";





  if(mysqli_stmt_prepare($stmt,$querry)){
      echo "estou aqui";
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$cadeira, $titulo, $mensagem, $data, $utilizador, $tiporec, $imagem, $id_user);
  }

?>

<div class="container azul1b shadow borderElement p-5">
    <section class="row pt-3 ">
        <article class="col-12 text-center andabaixo">
            <img src="imgs/Artboard%201.png">
            <h3 class="titulo textoClaro font-weight-bold pt-5">Laboratório Multimédia 4</h3>
        </article>
    </section>

</div>

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

while(mysqli_stmt_fetch($stmt)) {


if($tiporec=="1"){
    $tipofic="png";
}


echo "<div class=\"container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98\">
    <div class=\"pl-3 py-4\">
        <img class=\"iconzito float-left pr-4\" src=\"imgs/iconn.png\">
        <div class=\"row\">
            <article class=\"col-9\">
                <h3 class=\"titulo\"><a href=\"topico.html\">" . $titulo . "</a></h3>
                <a href=\"http://localhost/github/perfil.php?id=" . $id_user ." \"><h5 class=\"titulo font-italic text-black-50\">" . $utilizador . "</h5></a>
            </article>
            <article class=\"col-3\">
                <div class=\"float-right\">
                    <i class=\"fas fa-angle-up fa-2x d-block\"></i>
                    <i class=\"fas fa-angle-down fa-2x d-block\"></i>
                </div>
            </article>
        </div>

        <hr>
        <p class=\"texto pt-3 px-4 mb-0\">" . $mensagem . "</p>
        
       
        <div class=\"text-center\">
        ";
    if(isset($imagem)){
        echo "<img class=\"w-75 h-auto py-5\" src=\"imgs/".$imagem.".".$tipofic."\">";
    }
    else{ echo "<div class='py-4'></div>";}

        echo "</div>
        <div class=\"text-secondary font-italic\">
            <span>73 Comentários</span>
            <i class=\"fas fa-comment\"></i>
            <div class=\"float-right pr-4\">Postado " . $data . "</div>
        </div>
    </div>
</div>";
}
?>
<!------------------>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98">
    <div class="pl-3 py-4">
        <img class="iconzito float-left pr-4" src="imgs/iconn.png">
        <div class="row">
            <article class="col-9">
                <h3 class="titulo">Arrays Multidimensionais</h3>
                <h5 class="titulo font-italic text-black-50">Nuno Silva</h5>
            </article>
            <article class="col-3">
                <div class="float-right">
                    <i class="fas fa-angle-up fa-2x d-block"></i>
                    <i class="fas fa-angle-down fa-2x d-block"></i>
                </div>
            </article>
        </div>
        <hr>
        <div class="">
            <p class="align-self-start px-4">
                Não estou a conseguir retirar elementos específicos de um array multidimensional. Surge um erro no PHP quanto tento usar...
            </p>
        </div>
        <div class="text-secondary font-italic">
            <span>134 Comentários</span>
            <i class="fas fa-comment"></i>
            <div class="float-right pr-4">Postado há 5 horas</div>
        </div>
    </div>
</div>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98">
    <div class="pl-3 py-4">
        <img class="iconzito float-left pr-4" src="imgs/iconn.png">
        <div class="row">
            <article class="col-9">
                <h3 class="titulo">Criação de tabelas no Workbench</h3>
                <h5 class="titulo font-italic text-black-50">Bruno Miguel</h5>
            </article>
            <article class="col-3">
                <div class="float-right">
                    <i class="fas fa-angle-up fa-2x d-block"></i>
                    <i class="fas fa-angle-down fa-2x d-block"></i>
                </div>
            </article>
        </div>

        <hr>
        <div>
            <p class="align-self-start px-4">Decidi praticar mais para Laboratório Multimédia 4 por iniciativa própria através de projetos extra e, por isso, desenvolvi uma...</p>
        </div>
        <div class="text-secondary font-italic">
            <span>3 Comentários</span>
            <i class="fas fa-comment"></i>
            <div class="float-right pr-4">Postado há 8 horas</div>
        </div>
    </div>
</div>






<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>
</body>
</html>

