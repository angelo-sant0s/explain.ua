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

    <title>explain.ua</title>
</head>
<body>


<header class="container justify-content-end" id="header">
    <div class="row">
        <section class="col-6 col-md-8">
            <a href="index.html"><img src="imgs/logo.svg" alt="logo" height="175px" width="150px"></a>
        </section>
        <section class="col-6 col-md-4 text-right pt-5">
            <article class="pt-3">
                <button class="btn btn_sign_in rounded-pill shadow mx-1 my-1" data-toggle="modal" data-target="#exampleModalCenter">Sign In</button>
                <button class="btn btn_login rounded-pill shadow mx-1 my-1" data-toggle="modal" data-target="#loginmodal">Login</button>
            </article>
        </section>
    </div>
</header>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header text-center">
                <img src="imgs/logo.svg" alt="logo" height="100px" width="100px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2 justify-content-center">
                <div class="modalinputs">
                    <i class="fas fa-envelope-open"></i>
                    <input type="text" placeholder="e-mail" >
                </div>
                <div class="modalinputs">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="username" >
                </div>
                <div class="modalinputs">
                    <i class="fas fa-key"></i>
                    <input type="text" placeholder="password">
                </div>
            </div>
            <div class="modal-footer pt-4 justify-content-center">
                <button class="btn btn_sign_in rounded-pill shadow mx-1 my-1 px-5" onclick="location.href = 'home.html';">Sign In</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header text-center">
                <img src="imgs/logo.svg" alt="logo" height="100px" width="100px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="modalinputs">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="username" >
                </div>
                <div class="modalinputs">
                    <i class="fas fa-key"></i>
                    <input type="text" placeholder="password">
                </div>
                <input type="checkbox" id="savepassword" name="savepassword" value="xd" class="mt-2">
                <label for="savepassword" class="text-black-50 titulo">guardar password</label><br>
            </div>
            <div class="modal-footer pt-4 justify-content-center">
                <button class="btn btn_login rounded-pill shadow mx-1 my-1 px-5" onclick="location.href = 'home.html';">Login</button>
            </div>
        </div>
    </div>
</div>


<div class="index_div1 text-center text-lg-left mt-2" id="index_div1">
    <div class="container">
        <section class="row">
            <article class="col-12 col-lg-6 pt-5">
                <div class="index_div1_border pl-4">
                    <h1 class="titulo pt-4">explain.ua</h1>
                    <p class="texto text-black-50 mb-0 mt-4">Esta plataforma vai salvar-te das tuas dúvidas.</p>
                    <p class="texto text-black-50">Embarca nesta jornada.</p>
                </div>
                <button class="btn bgEscuro rounded-pill shadow px-5 textoClaro text-center" onclick="location.href = '';">Começar</button>
            </article>
            <article class="col-12 col-lg-6 px-4">
                <img src="imgs/landing1.svg" class="img-fluid" width="700px" alt="svg1">
            </article>
        </section>
    </div>
</div>


<div class="waves">
    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#998DC5" fill-opacity="1" d="M0,96L26.7,80C53.3,64,107,32,160,53.3C213.3,75,267,149,320,160C373.3,171,427,117,480,90.7C533.3,64,587,64,640,69.3C693.3,75,747,85,800,112C853.3,139,907,181,960,208C1013.3,235,1067,245,1120,224C1173.3,203,1227,149,1280,138.7C1333.3,128,1387,160,1413,176L1440,192L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path></svg>
    <div class="container-fluid index_div2 text-center">
        <section class="row justify-content-center d-flex">
            <article class="col-12 col-lg-5 px-5 pt-5 mt-5 text-center text-lg-left">
                <h1 class="titulo"><b>Videochamadas com antigos alunos</b></h1>
                <p class="texto">Caso precises de uma sessão de esclarecimento a sós, não te preocupes que nós pensámos em ti.</p>
            </article>
            <article class="col-12 col-lg-6 text-center">
                <img src="imgs/landing2.svg" class="img-fluid" height="700px" width="700px" alt="svg1">
            </article>
        </section>
    </div>
    <svg class="cor5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319"><path fill="#998DC5" fill-opacity="1" d="M0,96L26.7,80C53.3,64,107,32,160,53.3C213.3,75,267,149,320,160C373.3,171,427,117,480,90.7C533.3,64,587,64,640,69.3C693.3,75,747,85,800,112C853.3,139,907,181,960,208C1013.3,235,1067,245,1120,224C1173.3,203,1227,149,1280,138.7C1333.3,128,1387,160,1413,176L1440,192L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
</div>


<div class="container-fluid cor5b index_div3 pb-4 text-center text-lg-right">
    <section class="row">
        <article class="col-12 col-lg-6 text-center">
            <img src="imgs/landing3.svg" class="img-fluid" height="700px" width="700px" alt="svg1">
        </article>
        <article class="col-12 col-lg-5 cor5 p-5 textoClaro">
            <h1 class="titulo">Fóruns por cadeira</h1>
            <p class="texto">Aqui temos tudo organizado por cadeiras e anos para facilitar a tua procura da solução que tanto desejas.</p>
        </article>
    </section>
</div>

<div class="waves cor5">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
        <path fill="#F4F4F4" fill-opacity="1" d="M0,288L40,272C80,256,160,224,240,224C320,224,400,256,480,266.7C560,277,640,267,720,234.7C800,203,880,149,960,138.7C1040,128,1120,160,1200,176C1280,192,1360,192,1400,192L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>
    <div class="container-fluid index_div4 pb-5">
        <section class="row text-center justify-content-center">
            <article class="col-12 col-lg-5 px-5 pt-5 mt-5 text-lg-left">
                <h1 class="titulo"><b>Candidata-te a mentor</b></h1>
                <p class="texto">Tens os conhecimentos e a disponibilidade? Torna-te um mentor e ajuda aqueles que precisam das tuas skills.</p>
            </article>
            <article class="col-12 col-lg-6">
                <img src="imgs/landing4.svg" class="img-fluid" height="700px" width="700px" alt="svg1">
            </article>
        </section>
        <section class="row text-center p-5 mt-5">
            <article class="col-12">
                <a href="#header"><button class="btn bgEscuro rounded-pill shadow px-5 textoClaro text-center"><i class="fas fa-chevron-up"></i><span class="pl-3">Voltar ao topo</span></button></a>
            </article>
        </section>
    </div>
</div>


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