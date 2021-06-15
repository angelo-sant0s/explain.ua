<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- java -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta content="Angelo Santos, André Domingues, Juliana Assis, Luis Simoes" name="author">
    <meta content="Explain, Universidade de Aveiro, UA, Explicações" name="keywords">
    <meta content="Website dedicado à entreajuda de estudantes do curso de NTC da Universidade de Aveiro" name="description">

    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free/css/all.css">

    <!-- estilos próprios -->
    <link href="css/os_meus_estilos.css" rel="stylesheet">

    <!--Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans&display=swap" rel="stylesheet">

    <title>Injeção de SQL em PHP</title>
</head>
<body class="cinzaClaroBg" id="topico">
<nav class="navbar sticky-top d-flex navbar-expand-md bgClaro">
    <a class="navbar-brand" href="home.html">
        <img src="imgs/logo.svg" alt="logo" class="img-fluid px-2" width="90px">
    </a>
    <div class="justify-content-center d-flex d-md-none justify-content-md-right">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.html"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-2x roxinho"></i>
    </button>
    <div class="collapse navbar-collapse d-md-flex justify-content-md-center" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
            <li class="nav-item">
                <a class="nav-link" href="home.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="perfil.html">Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link corazul" href="cadeiras.html">Cadeiras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tickets.html">Ticket</a>
            </li>
            <li class="nav-item d-md-none pt-2">
                <a href="index.html"><i class="fas fa-sign-out-alt fa-2x roxinho"></i></a>
            </li>
        </ul>
    </div>
    <div class="justify-content-center d-none d-md-flex justify-content-md-right">
        <button type="button" class="btn"><i class="fas fa-bell fa-2x roxinho mx-2"></i></button>
        <button type="button" class="btn"><a href="chat.html"><i class="fas fa-comment fa-2x roxinho mx-2"></i></a></button>
    </div>
</nav>
<main class="container textoEscuro texto fundoClaro p-4 p-xl-5">
    <section class="row justify-content-center mt-4">
        <article class="col-11 col-md-9 mt-3">
            <section class="row">
                <div class="col-12 col-sm-3 col-lg-2 text-center">
                    <img src="imgs/icon_lab4.png" height="100px" width="100px">
                </div>
                <!-- falta upvote/downvote -->
                <div class="col-10 col-sm-7 col-lg-8 mt-3 pt-3 pt-sm-0">
                    <h3 class="titulo font-weight-bold mb-2">Injeção de SQL em PHP</h3>
                    <p class="small font-italic  ml-2 mb-0">Submetido por <a href="#" class="text-secondary cursor">Ricardo Manuel</a><br>a 14-03-2021 às 16h32</p>
                </div>
                <div class="col-2 pt-4 pt-sm-3 text-right">
                    <i class="fas fa-angle-up fa-2x d-block cursor"></i>
                    <i class="fas fa-angle-down fa-2x d-block cursor"></i>
                </div>
            </section>
        </article>

        <article class="col-11 col-md-9 my-4 mt-sm-5">
            <p>Decidi praticar mais para Laboratório Multimédia 4 por iniciativa própria através de projetos extra e, por isso, desenvolvi uma página em PHP. Contudo, acredito que o meu código PHP não está protegido contra SQL injections, por exemplo:</p>
            <code class="textoRosinha">
                //----CONSULTA SQL----//<br>
                $busca = mysql_query ('insert into Produtos (coluna) values(' . $valor . ')');
            </code>
            <p class="mt-3">Digamos que o utilizador usa DROP TABLE Produtos para o campo valor, ele vai inserir um novo registo cujo campo coluna será 1 e logo de seguida vai remover a tabela Produtos.</p>
            <p>Como posso melhorar o meu código para prevenir esta situação?</p>
        </article>

    </section>

    <section class="row justify-content-center">
        <article class="col-12 col-md-11 mt-4">

            <div class="cinzaClaroBg borderElement pb-2">
                <div class="azul1 borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Esclarecimento do mentor</h5>
                </div>

                <div class="cinzaClaroBg borderElement py-4 px-3 p-sm-4 p-xl-5">
                    <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                    <p class="float-left font-weight-bold m-0 pt-2 pl-2">Jorge Santos<span class="small font-italic text-success ml-1">mentor</span></p>

                    <img class="img-fluid mt-4" src="imgs/videochamada_ilu.png">
                    <p class="font-weight-bold textoAzul1 mt-4 ml-2">NOTAS</p>
                    <p>Exemplo de prepared statements com mysqli:</p>
                    <code class="textoRosinha">
                        $db = new mysqli('localhost', 'usuario', 'senha', 'teste');<br>
                        $sql = 'INSERT INTO tabela(campo1, campo2, campo3) VALUES(?, ?, ?)';<br>
                        $stmt = $db->prepare($sql);<br>
                        $var1 = 1; $var2 = 'foo'; $var3 = 1.99;<br>
                        $stmt->bind_param('isd', $var1, $var2, $var3);<br>
                        $stmt->execute();<br>
                    </code>

                    <p class="font-weight-bold textoAzul1 mt-4 ml-2">ANEXOS</p>
                    <a class="font-italic text-secondary cursor" href="https://www.php.net/manual/en/mysqli-stmt.bind-param.php">Manual de PHP: bind_param</a>
                </div>
            </div>
        </article>
    </section>

    <section class="row justify-content-center">
        <article class="col-12 col-md-11 mt-4">

            <div class="cinzaClaroBg borderElement pb-3">
                <div class="roxinhob borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Comentário principal</h5>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2">Luísa Amaral</p>
                        </div>

                        <div class="col-12 mt-4">
                            <p>A título de curiosidade, também é possível através de prepared statements com PDO:</p>
                            <code class="textoRosinha">
                                $db = new PDO('mysql:host=localhost dbname=teste', 'usuario', 'senha');
                            </code>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">Postado há 5 horas</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="azul1 borderElement textoClaro titulo py-4 px-3 p-sm-4 p-xl-5">
                    <h5 class="m-0">Comentários</h5>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2">João Martins</p>
                        </div>

                        <div class="col-12 mt-4">
                            <p>Não percebi nada.</p>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">Postado há 3 minutos</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2">Mário Guerra</p>
                        </div>

                        <div class="col-12 mt-4">
                            <p>Por acaso também quis explorar coisas novas em PHP e mySQL e surgiu-me a mesma preocupação, já que a matéria dos exercícios práticos não se foca tanto nesta vertente.</p>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">Postado há 29 minutos</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2">Joana Silva</p>
                        </div>

                        <div class="col-12 mt-4">
                            <p>Posso utilizar Frameworks em vez da abordagem de PDO para prevenir SQL injections? Visto que as Frameworks geralmente são projetadas visando a segurança.</p>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">Postado há 5 horas</span>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="fundoClaro borderElement m-3 py-4 px-3 p-sm-4 p-xl-5">
                    <section class="row">
                        <div class="col-12">
                            <img class="float-left" src="imgs/icon_avatar.png" height="40px" width="40px">
                            <p class="float-left font-weight-bold m-0 pt-2 pl-2">Maria Miguel</p>
                        </div>

                        <div class="col-12 mt-4">
                            <p>Obrigada pela gravação da reunião. Muito bem explicado!</p>

                            <div class="mt-4 pr-2 mb-0 d-block">
                                <div class="float-right">
                                    <i class="fas fa-angle-up fa-sm d-block cursor"></i>
                                    <i class="fas fa-angle-down fa-sm d-block cursor"></i>
                                </div>
                                <span class="float-left font-italic small text-secondary pt-2">Postado há 2 dias</span>
                            </div>
                        </div>
                    </section>
                </div>

                <a href="#" class="text-secondary small cursor mt-4 ml-3 mb-0">carregar mais comentários...</a>
            </div>
        </article>
    </section>

    <section class="row justify-content-center">
        <article class="col-12 col-md-11 mt-4 mb-5">
            <div class="cinzaClaroBg borderElement py-1">
                <div class="form-group p-3 mt-3">
                    <div>
                        <img class="float-left mb-3 ml-2" src="imgs/icon_avatar.png" height="40px" width="40px">
                        <p class="float-left font-weight-bold m-0 pt-2 pl-2 mb-3">Ricardo Manuel</p>
                    </div>
                    <textarea class="form-control borderElement font-italic p-3" id="FormControlTextarea1" rows="2" placeholder="Escreve um comentário..."></textarea>

                    <div class="d-flex justify-content-between small mt-3">
                        <a href="pedido_tickets.html"><button class="btn borderElement textoClaro comentAnexo titulo ml-1 azul1">Anexar ticket</button></a>
                        <span><button class="btn rosinhab comentCirculo ml-1" id="enviarTicket"><i class="fas fa-chevron-right fa-lg textoClaro"></i></button></span>
                    </div>
                </div>
            </div>
        </article>
    </section>


</main>

<!-- Footer -->
<footer class="container-fluid bgEscuro p-3">
    <section class="row justify-content-md-between">
        <article class="col-md-2 pt-4 pl-2 pl-md-5 text-white text-center text-md-left">
            <h5 class="footer-brand pl-2 pb-3 "><img src="imgs/logobranco.svg" width="80px" alt="img2">
            </h5>
        </article>
        <article class="col-md-7 pt-0 pt-md-4 pl-2 pl-md-0 text-white text-center text-md-left">
            <a href="#"><i class="fab fa-facebook-f p-3"></i></a>
            <a href="#"><i class="fab fa-twitter p-3"></i></a>
            <a href="#"><i class="fab fa-instagram p-3"></i></a>
        </article>
        <article class="col-md-3 text-white">
            <section class="row">
                <article class="col-12 col-md-6 p-1 font-weight-normal text-center pt-5">
                    <a href="#" class="tamanho">
                        <h4>Sobre</h4>
                    </a>
                </article>
                <article class="col-12 col-md-6 p-1 font-weight-normal text-center py-5">
                    <a href="#" class="tamanho">
                        <h4>Contactos</h4>
                    </a>
                </article>
            </section>
        </article>
    </section>
    <section class="row">
        <article class="col-12 text-white">
            <p class="text-right h4 font-weight-normal pt-4 tamanho ">&commat; 2021 explain.ua, All Rights Reserved</p>
        </article>
    </section>
</footer>

<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
