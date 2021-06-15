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

    <title>Chat</title>
</head>
<body>

<?php include_once "components/cp_nav.php"; ?>




<main class="container-fluid texto cor5" id="mainchat">
    <section class="row">
        <!-- conversas -->
        <article id="conversaSection" class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 bg-person1">
            <section class="row  borders4" id="conversatitle">
                <article class="col-12 text-center p-3 bg-inputzone" >Conversa</article>
            </section>

            <section id="Conversas" class="row overflow-auto borders4">
                <article class="col-12">
                    <section id="joao" class="row p-2 custom-borderb cursorPointer">
                        <article class="col-2 p-0 please ">
                            <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                        </article>

                        <article class="col-10 p-0 pl-1 justify-content-between">
                            <section class="row m-0 h-100">
                                <article class="col-8 p-0">
                                    <div class="">João</div>
                                </article>

                                <article class="col-4 p-0">
                                    <div class=" text-right">14:20</div>
                                </article>

                                <article class="col-12 p-0">
                                    <div class="">LAB4 - Funções globais</div>
                                </article>
                            </section>
                        </article>
                    </section>




                </article>


            </section>
        </article>

        <!-- chat -->
        <article id="chatSection" class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 bg-light  ">
            <section class="row  borders4 bg-inputzone" id="chattitle">
                <article class="col-1 align-items-center d-flex text-right" id="backtbn"><i class="d-inline-block d-lg-none fas fa-chevron-left arrowsize"></i></article>
                <article class="col-10 text-center p-3" > Chat</article>
            </section>

            <section id="chatRow" class="row chatRow justify-content-center p-3 bg-chat-format">

                <!-- resumo topioc -->
                <article class="col-7">
                    <div class="resumoTop textoClaro bg-roxo borderElement font-italic text-center p-3 mx-5">
                        As minhas dúvidas são as seguintes: em primeiro lugar, qual é a diferença entre scope de bloco e scope de função? E já agora, o conceito de scope de bloco sempre exisitu ou surgiu no EcmaScript6 com o aparecimento do let e do const?
                    </div>
                </article>

                <!-- divisao de 24h -->
                <article class="col-7 text-center font-italic text-secondary">
                    <hr>
                    Ontem às 14:10
                </article>

                <!-- corpo da mensagem -->
                <article class="col-12">


                    <section class="row mt-2">
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                        </article>
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person1 borderElement">Olá Mafalda como estás? Quando estás disponivel para marcarmos uma videochamada?</div>
                        </article>
                    </section>


                    <section class="row mt-2 justify-content-end">
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person2 borderElement">Olá João. Obrigada pela ajuda! Posso agora se tu puderes!</div>
                        </article>
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face2.jpg" class="img-fluid faceIcon">
                        </article>
                    </section>

                    <section class="row mt-2">
                        <article class="col-1 p-1 text-center">
                            <img src="imgs/face1.jpg" class="img-fluid faceIcon">
                        </article>
                        <article class="col-8 p-1">
                            <div class="p-2 bg-person1 borderElement">Pode ser! vamos então.</div>
                        </article>
                    </section>

                </article>


                <!-- Indicação de chamada -->
                <article class="col-12 my-3 text-center">
                    <hr>
                    <a href="videochamada.html" class="textoClaro"><span class="py-2 px-3 mt-2 bg-azul2 borderElement d-inline-block">Chamada iniciada</span></a>
                </article>

            </section>

            <section id="inputZone" class="row py-2 px-3 bg-inputzone">
                <article class="col-9">
                    <input id="chatInput" class="borderElement p-1 pl-3 borderPic Valign">
                </article>
                <article class="col-1">
                    <i class="fas fa-arrow-alt-circle-right iconsSize Valign"></i>
                </article>
                <article class="col-1">
                    <i class="fas fa-images iconsSize Valign"></i>
                </article>
                <article class="col-1">
                    <i class="fas fa-video iconsSize Valign"></i>
                </article>


            </section>

        </article>


    </section>

</main>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- js nossos -->
<script src="js/js.js"></script>
</body>
</html>

