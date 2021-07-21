<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>explain.ua - Gestão de tickets</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once "../components/cp_navbars_side.php";
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include_once "../components/cp_navbars_top.php";
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão de tickets</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tickets
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form action="tickets.php" method="get">
                                    <div class="input-group">
                                        <input type="text" class="bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="search_submit">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Titulo</th>
                                            <th>Cadeira</th>
                                            <th>Username</th>
                                            <th>Data Submissão</th>
                                            <th>Estado</th>
                                            <th>Operações</th>
                                        </tr>
                                        </thead>

                                            <?php

                                            require_once "../connections/connection.php";

                                            $link = new_db_connection();

                                            $stmt = mysqli_stmt_init($link);

                                            if(isset($_GET["search_submit"])){

                                                $search = $_GET["search_submit"];
                                                $query = "SELECT ticket.id_ticket, ticket.titulo, cadeira.nome, utilizador.username, data_submissao, estado.nome FROM `ticket`
                                                          INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                                                          INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
                                                          INNER JOIN estado ON estado.id_estado = ticket.estado_id_estado
                                                          WHERE utilizador.username LIKE '%".$search."%' OR ticket.titulo LIKE '%".$search."%' OR estado.nome LIKE '%".$search."%' OR cadeira.nome LIKE '%".$search."%'";
                                            }else{
                                            $query = "SELECT ticket.id_ticket, ticket.titulo, cadeira.nome, utilizador.username, data_submissao, estado.nome FROM `ticket`
                                                      INNER JOIN cadeira ON cadeira.id_cadeira = ticket.cadeira_id_cadeira
                                                      INNER JOIN utilizador ON utilizador.id_utilizador = ticket.utilizador_id_utilizador
                                                      INNER JOIN estado ON estado.id_estado = ticket.estado_id_estado";
                                            }

                                            if (mysqli_stmt_prepare($stmt, $query)) {
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_bind_result($stmt, $id, $titulo, $cadeira_nome, $username, $date, $estado);
                                            };

                                            while (mysqli_stmt_fetch($stmt)){

                                                                  echo "<tbody>
                                                                        <tr>
                                                                        <td>".$id."</td>
                                                                        <td>".$titulo."</td>
                                                                        <td>".$cadeira_nome."</td>
                                                                        <td>".$username."</td>
                                                                        <td>".$date."</td>
                                                                        <td>".$estado."</td>
                                                                        <td><a href='tickets_edit.php?id=$id' class='btn'><i class='fas fa-edit'></i></a></td>
                                                                        </tr>
                                                                        </tbody>";
                                            }
                                            ?>

                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>explain.ua &copy; 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>

