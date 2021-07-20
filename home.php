<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>
    <title>Home</title>
</head>
<body class="cinzaClaroBg">


<?php include_once "components/cp_nav.php";

require_once "connections/connections.php";

$local_link = new_db_connection();

$stmt = mysqli_stmt_init($local_link);

$stmt2 = mysqli_stmt_init($local_link);

if(isset($_GET['order'])){
    switch ($_GET['order']){
        case "recente":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username, HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), topico.pontuacao,cadeira.imagem
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
ORDER BY topico.data_publicacao DESC";
        break;
        case "popular":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username, HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), topico.pontuacao,cadeira.imagem
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
ORDER BY ticket.data_submissao ASC";
        break;
        case "top":
            $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username, HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), topico.pontuacao,cadeira.imagem
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador 
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
ORDER BY topico.pontuacao DESC";
        break;
    }
}else{
    $query = "SELECT ticket.titulo, ticket.corpo_mensagem, ticket.id_ticket, topico.id_topico, utilizador.username,HOUR(TIMEDIFF(NOW(), topico.data_publicacao)), MINUTE(TIMEDIFF(NOW(), topico.data_publicacao)), topico.pontuacao,cadeira.imagem
FROM ticket 
INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
INNER JOIN topico ON topico.id_topico = ticket.topico_id_topico
INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
ORDER BY topico.data_publicacao DESC";
}

$query2 = "SELECT COUNT(comentario.texto)
FROM `comentario` 
INNER JOIN topico ON topico_id_topico = id_topico 
WHERE id_topico = ?;";

?>

<div class="container bkk-color shadow borderElement p-5">
    <section class="row pt-3">
        <article class="col-12 text-center">
            <h1 class="titulo text-black-50 pb-0 mb-0">Bem-vindo</h1>
            <h3 class="titulo roxinho"><?=$_SESSION["username"]?></h3>
        </article>
    </section>
    <section class="row text-center pt-2">
        <article class="col-12">
            <p class="titulo text-black-50 text-left ml-5">Ordenar tópicos por:</p>
        </article>
    </section>
    <section class="row justify-content-between text-center p-2">
        <article class="col-12 col-lg-6 filtro">

            <a href="home.php?order=recente"> <button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-clock fa-2x px-1"></i><span class="pb-2">Recente</span></button></a>
            <a href="home.php?order=popular"><button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-fire fa-2x px-1"></i><span class="pb-2">Popular</span></button></a>
            <a href="home.php?order=top"><button class="btn rounded-pill shadow bgClaro roxinho mr-3"><i class="fas fa-arrow-up fa-2x px-1"></i><span class="pb-2">Top</span></button></a>

        </article>
        <article class="col-12 col-lg-6 text-center position-relative mt-lg-0 mt-4 search_box">
            <input type="text" placeholder="Search" class="pl-3 shadow">
            <i class="fas fa-search lupa roxinho"></i>
        </article>
    </section>
</div>

<div class="container" id="container">
    <?php
    if (mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $titulo, $texto, $id, $idtopico, $autor, $publishing_hour, $publishing_minute, $score, $cadeirapfp);
    }
    mysqli_stmt_store_result($stmt);
    while (mysqli_stmt_fetch($stmt)){
        ?>
     <div class='container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98' id="hometopic">
    <div class='pl-3 py-4'>
        <img class='iconzito float-left pr-4' src='imgs/<?=$cadeirapfp?>'>
        <div class='row'>
            <article class='col-9'>
                <a href='topico.php?id=<?=$id?>'> <h2 class='titulo corazul'> <?= $titulo ?></h2> </a>
<h5 class='titulo font-italic text-black-50'> Submetido  por <span class="textoAzul1"><?= $autor ?></span></h5>
</article>
<article class='col-3'>
    <div class='float-right'>
        <i class='fas fa-angle-up fa-2x d-block'></i>
        <?= $score ?>
        <i class='fas fa-angle-down fa-2x d-block'></i>
    </div>
</article>
</div>
<hr>
<a href='topico.php?id=<?=$id?>'>
    <div>
        <p class='align-self-start px-4'> <?= $texto ?> </p>
    </div>
</a>
<div class='text-secondary font-italic'>
<?php
    if (mysqli_stmt_prepare($stmt2,$query2)){
          mysqli_stmt_bind_param($stmt2, 'i' , $idtopico);
          mysqli_stmt_execute($stmt2);
          mysqli_stmt_bind_result( $stmt2, $count);
          while (mysqli_stmt_fetch($stmt2)) {
    ?>
    <span > <?= $count; } ?> Comentários</span >
    <i class='fas fa-comment' ></i >
    <div class='float-right pr-4' > Postado há
        <?php
        if ($publishing_hour == 0){
        echo $publishing_minute." minutos"; }
        else if ($publishing_hour > 0 && $publishing_hour < 24){
            echo $publishing_hour ." horas";}
        else if ($publishing_hour < 24*7 && $publishing_hour > 24){
            $publishing_day = intval(($publishing_hour / 24));
            echo $publishing_day." dias";
        }else{
            $publishing_week = intval(($publishing_hour / (24*7)));
            echo    $publishing_week." semanas";
        }
        ?>  </div >
</div >
</div >
</div >
        <?php
    }
    }
    ?>
</div>

<a href="#" class="text-center text-secondary small cursor mt-4 ml-3 mb-0"><span class="mb-4">carregar mais tópicos...</span></a>

<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>
</body>
</html>

