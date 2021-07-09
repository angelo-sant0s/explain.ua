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

$query = "SELECT * FROM users";

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

            <button class="btn rounded-pill shadow bgClaro roxinho mr-3" onclick="clica('recente')"><i class="fas fa-clock fa-2x px-1"></i><span class="pb-2">Recente</span></button>
            <button class="btn rounded-pill shadow bgClaro roxinho mr-3" onclick="clica('popular')"><i class="fas fa-fire fa-2x px-1"></i><span class="pb-2">Popular</span></button>
            <button class="btn rounded-pill shadow bgClaro roxinho mr-3" onclick="clica('top')"><i class="fas fa-arrow-up fa-2x px-1"></i><span class="pb-2">Top</span></button>
            <script>
                function clica(option){
                    escolha = option;
                    switch (option){
                        case "recente":
                            <?php $query = "SELECT * FROM users"; ?>
                        break;
                        case "popular":
                            <?php $query = "SELECT * FROM users"; ?>
                            break;
                        case "top":
                             <?php $query = "SELECT * FROM users"; ?>
                            break;
                    }
                }
            </script>

        </article>
        <article class="col-12 col-lg-6 text-center position-relative mt-lg-0 mt-4 search_box">
            <input type="text" placeholder="Search" class="pl-3 shadow">
            <i class="fas fa-search lupa roxinho"></i>
        </article>
    </section>
</div>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98">
    <?php
    if (mysqli_stmt_prepare($stmt,$query)){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $titulo, $texto);
    }
    while (mysqli_stmt_fetch($stmt)){
        ?>
    <div class="pl-3 py-4">
        <img class="iconzito float-left pr-4" src="imgs/iconn.png">
        <div class="row">
            <article class="col-9">
                <h3 class="titulo">Parâmetros em funções</h3>
                <h5 class="titulo font-italic text-black-50">Joana Almeida</h5>
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
            <p class="align-self-start px-4">Ao estudar Laboratório Multimédia 3 nos meus tempos livres surgiu-me uma questão acerca das funções em JavaScript e dos seus parâmetros...</p>
        </div>
        <div class="text-secondary font-italic">
            <span>5 Comentários</span>
            <i class="fas fa-comment"></i>
            <div class="float-right pr-4">Postado há 2 horas</div>
        </div>
    </div>
        <?php
    }
    ?>
</div>

<!--<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98">
    <div class="pl-3 py-4">
        <img class="iconzito float-left pr-4" src="imgs/iconn.png">
        <div class="row">
            <article class="col-9">
                <h3 class="titulo">Domínios de broadcast</h3>
                <h5 class="titulo font-italic text-black-50">Marco Paulo</h5>
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
            <p class="align-self-start px-4">Alguém me sabe dizer quantos domínios de broadcast existem nesta imagem?</p>
        </div>
        <div class="text-center">
            <img class="w-75 h-auto py-5" src="imgs/broadcast.png">
        </div>
        <div class="text-secondary font-italic">
            <span>3 Comentários</span>
            <i class="fas fa-comment"></i>
            <div class="float-right pr-4">Postado há 32 minutos</div>
        </div>
    </div>
</div>

<div class="container-lg container-fluid bkk-color borderElement  py-3 my-5 w-98">
    <div class="pl-3 py-4">
        <img class="iconzito float-left pr-4" src="imgs/iconn.png">
        <div class="row">
            <article class="col-9">
                <h3 class="titulo">Eventos em Comunicação Institucional</h3>
                <h5 class="titulo font-italic text-black-50">Ivone Costa</h5>
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
            <p class="align-self-start px-4">Tenho uma dúvida relativa ao funcionamento de eventos. Alguém me pode ajudar? Como vamos precisar de fazer um evento online no...</p>
        </div>
        <div class="text-secondary font-italic">
            <span>5 Comentários</span>
            <i class="fas fa-comment"></i>
            <div class="float-right pr-4">Postado há 2 horas</div>
        </div>
    </div>
</div>
-->
<a href="#" class="text-center text-secondary small cursor mt-4 ml-3 mb-0"><span class="mb-4">carregar mais tópicos...</span></a>

<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>
</body>
</html>

