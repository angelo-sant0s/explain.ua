<?php

require_once "../connections/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>explain.ua ADMIN</title>

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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Utilizadores totais
                                        </div>
                                        <?php

                                        $link = new_db_connection();


                                        /* create a prepared statement */
                                        $stmt = mysqli_stmt_init($link);



                                        $query = "SELECT COUNT(utilizador.id_utilizador)FROM utilizador";

                                        if (mysqli_stmt_prepare($stmt, $query)) {

                                            mysqli_stmt_execute($stmt);

                                            mysqli_stmt_bind_result($stmt,$user_count);

                                        }

                                        mysqli_stmt_store_result($stmt);
                                        while (mysqli_stmt_fetch($stmt)) { ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user_count?></div>
                                            <?php
                                        }

                                        mysqli_stmt_close($stmt);

                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Utilizadores Ativos
                                        </div>
                                        <?php

                                        $stmt1 = mysqli_stmt_init($link);



                                        $query1 = "SELECT COUNT(utilizador.id_utilizador)FROM utilizador WHERE utilizador.ativo = 1";

                                        if (mysqli_stmt_prepare($stmt1, $query1)) {

                                            mysqli_stmt_execute($stmt1);

                                            mysqli_stmt_bind_result($stmt1,$active_user_count);

                                        }



                                        mysqli_stmt_store_result($stmt1);
                                        while (mysqli_stmt_fetch($stmt1)) { ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $active_user_count?></div>
                                            <?php
                                        }

                                        mysqli_stmt_close($stmt1);

                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Novos Utilizadores (Mensal) </div>
                                        <?php

                                        $stmt2 = mysqli_stmt_init($link);



                                        $query2 = "SELECT COUNT(utilizador.username)
                                                   FROM utilizador 
                                                   WHERE DATEDIFF(NOW(), utilizador.data_registo) <= 30";

                                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                                            mysqli_stmt_execute($stmt2);

                                            mysqli_stmt_bind_result($stmt2,$active_user_count_month);

                                        }



                                        mysqli_stmt_store_result($stmt2);
                                        while (mysqli_stmt_fetch($stmt2)) { ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $active_user_count_month?></div>
                                            <?php
                                        }

                                        mysqli_stmt_close($stmt2);

                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pedidos Ticket (por Responder)</div>
                                        <?php

                                        $stmt3 = mysqli_stmt_init($link);



                                        $query3 = "SELECT COUNT(ticket.id_ticket) 
                                                   FROM ticket 
                                                   WHERE ticket.estado_id_estado = 2";

                                        if (mysqli_stmt_prepare($stmt3, $query3)) {

                                            mysqli_stmt_execute($stmt3);

                                            mysqli_stmt_bind_result($stmt3,$ticket_pedidos);

                                        }

                                        mysqli_stmt_store_result($stmt3);
                                        while (mysqli_stmt_fetch($stmt3)) { ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $ticket_pedidos ?></div>
                                            <?php
                                        }

                                        mysqli_stmt_close($stmt3);

                                        ?>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

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
