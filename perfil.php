<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Perfil</title>
</head>
<body class="cinzaClaroBg">

<?php include_once "components/cp_nav.php"; ?>

<main class="container-fluid container-lg texto bg-light">
    <section class="row justify-content-center">
        <article class="col-12 vh-80">

        </article>

        <article id="profileJoin" class="col-12 vh-55 position-absolute bg-profile">
            <article class="col-12 text-center  profilePic">
                <img src="imgs/face1.jpg" class="borderElement img-fluid profilePicSize">
            </article>

            <article id="profileName" class="pt-4 col-12 text-centerfont-weight-bold rem2">
                <div class="text-center">Ricardo Manuel</div>
            </article>
        </article>




    </section>

    <section class="row mt-5 mb-4 mx-2 shadow borderElement bitgreyer">
        <article class="col-6 col-sm-6 col-md-8">
            <section class="row py-2">

                <article class="col-12 col-sm-12 col-md-6 text-center position-relative ">
                    <div class=" ">
                        <div class="mb-1 font-weight-bold rem1-3">Género</div>
                        <div>Masculino</div>
                    </div>
                </article>

                <article class="col-12 col-sm-12 col-md-6 text-center d-none d-sm-none d-md-block">
                    <div class="font-weight-bold rem1-3">Membro desde:</div>
                    <div class="position-relative mt-1">
                        <i class="fas fa-calendar rem4"><span class="position-absolute rem2 data-profile">31</span></i>
                    </div>
                    <div class="mt-1">abril 2020</div>
                </article>

            </section>
        </article>

        <article class="col-6 col-sm-6 col-md-4 text-center position-relative">
            <div class=" py-2">
                <div class="mb-1 font-weight-bold rem1-3">Idade</div>
                <div>21 anos</div>
            </div>
        </article>

        <article class="col-12 text-center d-block d-sm-block d-md-none position-relative mt-custom1">
            <div class=" py-2">
                <div class="font-weight-bold rem1-3">Membro desde:</div>
                <div class="position-relative mt-1">
                    <i class="fas fa-calendar rem4"><span class="position-absolute rem2 data-profile">31</span></i>
                </div>
                <div class="mt-1">Abril 2020</div>
            </div>
        </article>
    </section>

    <section class="row mt-5">
        <!--First section -->
        <article class="col-12 col-sm-12 col-md-4 mb-4 py-3">
            <div class="mx-2 borderSections p-2 bitgreyer shadow">
                <section class="row">
                    <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                        Area
                    </article>

                    <article class="col-12">
                        <section class="row mx-2 py-2">
                            <article class="col-2 p-0 text-right d-flex align-items-center justify-content-end ">
                                <div>
                                    <img src="imgs/ntc.png" class="img-fluid textIcon2">
                                </div>
                            </article>

                            <article class="col-10">
                                <section class="row">
                                    <article class="col-12 font-weight-bold">
                                        Licenciatura NTC
                                    </article>

                                    <article class="col-12">
                                        2º ano
                                    </article>
                                </section>
                            </article>
                        </section>
                    </article>
                </section>
            </div>
        </article>

        <!--Second section -->
        <article class="col-12 col-sm-12 col-md-4 mb-4 py-3">
            <div class="mx-2 borderSections p-2 bitgreyer shadow">
                <section class="row">
                    <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                        Cadeiras Frequentadas
                    </article>

                    <article class="col-4 col-sm-4 col-md-12 col-xl-4">
                        <section class="row  mx-2 py-2">
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 text-center text-md-right text-xl-center">
                                <img src="imgs/lab4.png" class="img-fluid faceIcon">
                            </article>
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 d-flex align-items-center justify-content-center justify-content-md-start justify-content-xl-center font-weight-bold">
                                <div>LAB 4</div>
                            </article>
                        </section>
                    </article>

                    <article class="col-4 col-sm-4 col-md-12 col-xl-4">
                        <section class="row  mx-2 py-2">
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 text-center text-md-right text-xl-center">
                                <img src="imgs/idf.png" class="img-fluid faceIcon">
                            </article>
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 d-flex align-items-center justify-content-center justify-content-md-start justify-content-xl-center font-weight-bold">
                                <div>IDF</div>
                            </article>
                        </section>
                    </article>

                    <article class="col-4 col-sm-4 col-md-12 col-xl-4">
                        <section class="row  mx-2 py-2">
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 text-center text-md-right text-xl-center">
                                <img src="imgs/sistemas.png" class="img-fluid faceIcon">
                            </article>
                            <article class="col-12 col-sm-12 col-md-6 col-xl-12 d-flex align-items-center justify-content-center justify-content-md-start justify-content-xl-center font-weight-bold">
                                <div>SCM 2</div>
                            </article>
                        </section>
                    </article>

                </section>
            </div>
        </article>

        <!--Third section -->
        <article class="col-12 col-sm-12 col-md-4 mb-4 py-3 ">
            <div class="mx-2 borderSections p-2 bitgreyer shadow">
                <section class="row">
                    <article class="col-12 mb-3 font-weight-bold rem1-3 text-left text-md-center">
                        Favoritos
                    </article>

                    <article class="col-12">
                        <section class="row mx-2 py-2 ">
                            <article class="col-2 col-sm-2 col-md-3 col-lg-4 col-xl-2 p-0 d-flex align-items-center justify-content-end">
                                <div>
                                    <img src="imgs/lab4.png" class="img-fluid textIcon">
                                </div>
                            </article>

                            <article class="col-10 col-sm-10 col-md-9 col-lg-8 col-xl-10 d-flex align-items-center  ">
                                <div>Funções próprias em JavaScript</div>
                            </article>
                        </section>
                        <!-- <div class="borderSectionsElement m-auto"></div> -->
                    </article>
                </section>
            </div>
        </article>
    </section>

</main>
<?php include_once "components/cp_footer.php"?>


<!-- jQuery first, then Popper.js,then Bootstrap JS -->
<?php include_once "helpers/js_helper.php"; ?>


</body>
</html>
