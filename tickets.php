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

    <title>Tickets</title>
</head>
<body class="cinzaClaroBg">

<!-- Nav provisória -->
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
                <a class="nav-link" href="cadeiras.html">Cadeiras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link corazul" href="tickets.html">Ticket</a>
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
<!-- ############################# -->

<main id="ticketsMain" class="container textoEscuro texto fundoClaro borderElement my-5 p-4 p-xl-5">
    <section class="row justify-content-center">
        <article class="col-12 mt-3">
            <h3 class="titulo font-weight-bold text-center mb-4">Tickets</h3>
            <p class="small font-italic  ml-2 mb-0">Tickets ativos: <span class="font-weight-bold textoAzul1">1</span></p>
            <p class="small font-italic  ml-2">Tickets pendentes: <span class="font-weight-bold textoAzul1">2</span></p>
        </article>

        <!-- Falta trocar as arrows nos collapses quando abre e fecha -->
        <article class="col-12 col-lg-6 mt-xl-4">
            <div class="cinzaClaroBg textoEscuro borderElement p-0">
                <div class="azul1 textoClaro borderElement px-3 py-4">
                    Funções próprias em JavaScript
                    <i class="fas fa-exclamation-circle ml-3"></i>
                </div>
                <div class="pt-3 pb-4 px-5">
                    <p class=" d-flex justify-content-between">
                        <span class="text-left text-success"><i class="fas fa-spinner fa-sm mr-2"></i> ativo</span>
                    </p>
                    <p class="font-weight-bold">Dúvida de <span class="textoLab3">Laboratório Multimédia 3</span></p>
                    <p class="collapse font-italic" id="ticket1">Comecei agora a estudar funções em JavaScript e fiquei com uma pequena dúvida quanto ao uso de funções próprias como, por exemplo, o toString e o parseInt. Porque é que o toString() se encontra no final da variável e o parseInt() tem a variável lá dentro?</p>
                    <p class="small font-italic">Pedido a 03-02-2021</p>
                </div>
            </div>
            <div class="text-center botaoMais">
                <button id="botaoFora1" class=" btn rounded-circle borderElement azul1b moreTicket" type="button" data-toggle="collapse" data-target="#ticket1" aria-expanded="false" aria-controls="ticket1">
                    <i id="botaoDentro1" class=' fas fa-chevron-down textoClaro px-1 py-2'></i>
                </button>
            </div>
        </article>

        <article class="col-12 col-lg-6 mt-xl-4">
            <div class="cinzaClaroBg textoEscuro borderElement p-0">
                <div class="roxinhob textoClaro borderElement px-3 py-4">Homúnculo de Penfield</div>
                <div class="pt-3 pb-4 px-5">
                    <p class=" d-flex justify-content-between">
                        <span class="text-left text-info"><i class="fas fa-spinner fa-sm mr-2"></i> pendente</span>
                        <a class="text-right text-secondary cursor">cancelar pedido</a>
                    </p>
                    <p class="font-weight-bold">Dúvida de <span class="textoEC">Ergonomia Cognitiva</span></p>
                    <p class="collapse font-italic" id="ticket2">Encontrei informação ambígua acerca do Homúnculo de Penfield e da sua constituição. Este é constituído por duas partes - a motora e a sensorial - ou existem, de facto, dois Homúnculos? E qual a diferença entre eles?</p>
                    <p class="small font-italic">Pedido a 31-01-2021</p>
                </div>
            </div>
            <div class="text-center botaoMais">
                <button id="botaoFora2" class="btn rounded-circle borderElement azul1b moreTicket" type="button" data-toggle="collapse" data-target="#ticket2" aria-expanded="false" aria-controls="ticket2">
                    <i id="botaoDentro2" class='fas fa-chevron-down textoClaro px-1 py-2'></i>
                </button>
            </div>
        </article>

        <article class="col-12 col-lg-6 mt-xl-4">
            <div class="cinzaClaroBg textoEscuro borderElement p-0">
                <div class="rosinha textoClaro borderElement px-3 py-4">Em que consistem as filter bubbles</div>
                <div class="pt-3 pb-4 px-5">
                    <p class=" d-flex justify-content-between">
                        <span class="text-left text-info"><i class="fas fa-spinner fa-sm mr-2"></i> pendente</span>
                        <a class="text-right text-secondary cursor">cancelar pedido</a>
                    </p>
                    <p class="font-weight-bold">Dúvida de <span class="textoSC">Sociologia da Comunicação</span></p>
                    <p class="collapse font-italic" id="ticket3">Gostaria de obter uma explicação mais aprofundada sobre o que são os filtros digitais, quais as suas consequências e de que maneira afetam a nossa vida quotidiana, uma vez que nas aulas apenas nos foi mostrada a TED Talk do Eli Pariser.</p>
                    <p class="small font-italic">Pedido a 29-01-2021</p>
                </div>
            </div>
            <div class="text-center botaoMais">
                <button id="botaoFora3" class="btn rounded-circle borderElement azul1b moreTicket" type="button" data-toggle="collapse" data-target="#ticket3" aria-expanded="false" aria-controls="ticket3">
                    <i id="botaoDentro3" class='fas fa-chevron-down textoClaro px-1 py-2'></i>
                </button>
            </div>
        </article>

        <article class="col-12 col-lg-6 mt-xl-4">
            <div class="cinzaClaroBg textoEscuro borderElement p-0 overlayTicket">
                <div class="azul1 textoClaro borderElement px-3 py-4 overlayTicket">JavaScript scope</div>
                <div class="pt-3 pb-4 px-5">
                    <p class=" d-flex justify-content-between">
                        <span class="text-left"><i class="fas fa-lock fa-sm mr-2"></i> resolvido</span>
                        <a class="text-right text-secondary cursor" href="topico.html">consultar tópico</a>
                    </p>
                    <p class="font-weight-bold">Dúvida de <span class="textoLab3">Laboratório Multimédia 3</span></p>
                    <p class="collapse font-italic" id="ticket4">As minhas dúvidas são as seguintes: em primeiro lugar, qual é a diferença entre scope de bloco e scope de função? E já agora, o conceito de scope de bloco sempre exisitu ou surgiu no EcmaScript6 com o aparecimento do let e do const? </p>
                    <p class="small font-italic">Pedido a 23-12-2020</p>
                </div>
            </div>
            <div class="text-center botaoMais">
                <button id="botaoFora4" class="btn rounded-circle borderElement azul1b moreTicket" type="button" data-toggle="collapse" data-target="#ticket4" aria-expanded="false" aria-controls="ticket4">
                    <i id="botaoDentro4" class='fas fa-chevron-down textoClaro px-1 py-2'></i>
                </button>
            </div>
        </article>

    </section>

    <button class=" btn roxinhob textoClaro titulo font-weight-bold borderElement botaoNovo px-4 py-3" id="botaoNovo"><a class="cursor " href="pedido_tickets.html"><i class="fas textoClaro fa-plus fa-sm mr-2"></i><span class="textoClaro">Novo Ticket</span></a></button>

</main>

<!-- Footer -->
<footer id="footer" class="container-fluid bgEscuro p-3">
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

<script src="js/js.js"></script>

</body>
</html>
