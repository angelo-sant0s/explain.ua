<!DOCTYPE html>
<html lang="pt">
<head>
    <?php
    include_once "helpers/meta_helper.php";
    include_once "helpers/css_helper.php";
    ?>

    <title>Submissão de ticket</title>
</head>
<body class="cinzaClaroBg">

<?php include_once "components/cp_nav.php";
require_once("connections/connections.php");?>

<main class="container textoEscuro texto fundoClaro borderElement my-5 p-4 p-xl-5">
    <section class="row justify-content-center">
        <article class="col-12 mt-3">
            <h3 class="titulo font-weight-bold text-center mb-4">Submissão de tickets</h3>
            <p class="small font-italic  ml-2 mb-0 text-center">Efetua aqui um pedido de esclarecimento de dúvidas que tenhas acerca de qualquer cadeira.<br>Posteriormente aguarda pela resposta de um dos mentores.</p>
        </article>

        <!-- Falta trocar as arrows nos collapses quando abre e fecha -->
        <article class="col-12 col-md-10 col-lg-8 mt-5">
            <select class="custom-select roxinhob textoClaro borderElement px-4 dropTicket" id="urgenciaEscolha">
                <option selected>Urgência...</option>
                <option value="1">Baixa</option>
                <option value="2">Média</option>
                <option value="3">Alta</option>
            </select>

            <select class="custom-select rosinha textoClaro mt-2 borderElement px-4 dropTicket" id="cadeiraEscolha">
                <option selected>Cadeira...</option>

                <?php
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                $query = "SELECT cadeira.nome, cadeira.id_cadeira FROM cadeira";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    //mysqli_stmt_bind_param($stmt, 'i', $userid);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt,$nome_cadeira, $id_cadeira);
                }

                mysqli_stmt_store_result($stmt);
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<option value='$id_cadeira'>$nome_cadeira</option>";
                }

                mysqli_stmt_close($stmt);

                ?>



            </select>
        </article>

        <article class="col-12 col-md-10 col-lg-8 mt-4">
            <div class="cinzaClaroBg borderElement py-4 px-3 p-sm-4 p-xl-5">
                <form>
                    <div class="form-group">
                        <label for="FormControlInput1" class="textoAzul1 font-weight-bold">Título</label>
                        <input type="text" class="form-control borderElement font-italic px-3 dropTicket" id="FormControlInput1" placeholder="Refere o assunto...">
                    </div>
                    <div class="form-group">
                        <label for="FormControlTextarea1" class="textoAzul1 font-weight-bold mt-2">Mensagem</label>
                        <textarea class="form-control borderElement font-italic p-3" id="FormControlTextarea1" maxlength="800" rows="8" placeholder="Descreve a dúvida detalhadamente..."></textarea>
                        <div class="d-flex justify-content-between small mt-2">
                            <a href="#" class="text-secondary cursor"><i class="fas fa-paperclip fa-sm mr-1"></i> anexar ficheiro</a>
                            <div id="count">
                                <span id="current_count">0</span>
                                <span id="maximum_count">/ 800</span>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-center mb-3 mt-5">
                    <button class="btn bg-danger submitCirculo mr-1" id="apagarTicket"><i class="fas fa-times fa-lg textoClaro"></i></button>
                    <button class="btn bg-success submitCirculo ml-1" id="enviarTicket"><i class="fas fa-chevron-right fa-lg textoClaro"></i></button>
                    <p class="small font-italic mt-2" id="acao">Ação.</p>
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

<script type="text/javascript">
    $('textarea').keyup(function() {
        var characterCount = $(this).val().length,
            current_count = $('#current_count'),
            maximum_count = $('#maximum_count'),
            count = $('#count');
        current_count.text(characterCount);
    });


    document.getElementById('apagarTicket').onmouseover = function () {
        document.getElementById('acao').style.visibility = "visible";
        document.getElementById('acao').innerHTML = "Apaga todos os campos preenchidos.";
    };
    document.getElementById('enviarTicket').onmouseover = function () {
        document.getElementById('acao').style.visibility = "visible";
        document.getElementById('acao').innerHTML = "Envia o ticket de esclarecimento.";
    };

    document.getElementById('apagarTicket').onmouseout = function () {
        document.getElementById('acao').style.visibility = "hidden";
    };
    document.getElementById('enviarTicket').onmouseout = function () {
        document.getElementById('acao').style.visibility = "hidden";
    };
</script>
<script src="js/js.js"></script>

</body>
</html>
