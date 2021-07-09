<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Videochamada</title>
</head>
<body>
<main class="container-fluid vh-100 bg-dark d-flex flex-column justify-content-between texto">
    <section id="videoChamada" class="row position-absolute h-100 w-100 " >

    </section>

    <section class="row">
        <article class="col-8 col-sm-9 col-md-9 col-lg-10 col-xl-10 mt-5 pl-5">
            <i class="fas fa-compact-disc iconsSize text-danger"></i><span class="iconsSize textoClaro font-italic">  a gravar</span>
        </article>
        <article class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-2  mt-5">
            <img id="userCam" src="imgs/lmao.jpg" class="img-fluid borderPic borderElement ">
        </article>
    </section>

    <section class="row mb-5 justify-content-center">
        <article class="col-12 text-center  mb-5">
            <div class="iconCircle m-auto bg-danger cursorPointer" id="videoChamadaBtn1">
                <a href="chat.html"><i class="fas fa-phone-slash iconsSize textoClaro m-auto"></i></a>
            </div>
        </article>
        <article class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1 text-center position-relative p-0">
            <div class="iconCircle m-auto bg-azul2 cursorPointer" id="videoChamadaBtn2">
                <i class="fas fa-camera iconsSize textoClaro"></i>
                <i class="fas fa-retweet position-absolute changeCam textoClaro"></i>
            </div>

        </article>
        <article class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1 text-center p-0">
            <div class="iconCircle m-auto bg-azul2 cursorPointer" id="videoChamadaBtn3">
                <i class="fas fa-video-slash iconsSize textoClaro"></i>
            </div>

        </article>
        <article class="col-3 col-sm-2 col-md-2 col-lg-2 col-xl-1 text-center p-0">
            <div class="iconCircle m-auto bg-azul2 cursorPointer" id="videoChamadaBtn4">
                <i class="fas fa-microphone iconsSize textoClaro"></i>
            </div>

        </article>
    </section>

</main>




<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>

<!-- js nossos -->
<script src="js/js.js"></script>
</body>
</html>

