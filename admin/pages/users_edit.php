<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>explain.ua - Gestão de user</title>

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
                <?php
                if(isset($_GET["id"])){

                    $userid = $_GET["id"];

                    require_once("../connections/connection.php");

                    $idutilizador = $_SESSION["user_id"];


// Create a new DB connection
                    $link = new_db_connection();


                    /* create a prepared statement */
                    $stmt = mysqli_stmt_init($link);



                    $query = "SELECT utilizador.id_utilizador, utilizador.email,utilizador.username, utilizador.nome, utilizador.data_registo, perfil.tipo_perfil  FROM `utilizador`
                              INNER JOIN perfil ON utilizador.perfil_idperfil = perfil.id_perfil
                              WHERE utilizador.id_utilizador = ?";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_bind_param($stmt, 'i', $userid);

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt,$id,$email,$username,$nome,$data_registo,$role);

                    }



                    mysqli_stmt_store_result($stmt);
                    while (mysqli_stmt_fetch($stmt)) {

                    ?>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão de utilizadores</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edição de utilizador
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                            <form role="form" method="post" action="../scripts/sc_users_update.php">
                                                <input type="hidden" name="id_users" value="<?=$id?>">
                                                <div class="form-group">
                                                    <label>ID do utilizador</label>
                                                    <p class="form-control-static"><?=$id?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Data de criação</label>
                                                    <p class="form-control-static"><?= $data_registo ?></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input class="form-control" name="username"
                                                           value="<?=$username?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" value="<?=$email?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Perfil</label>
                                                    <select class="form-control" name="id_roles">
                                                        <?php
                                                        $stmt1 = mysqli_stmt_init($link);



                                                        $query1 = "SELECT perfil.tipo_perfil  FROM `perfil`";

                                                        if (mysqli_stmt_prepare($stmt1, $query1)) {

                                                            /* execute the prepared statement */
                                                            mysqli_stmt_execute($stmt1);

                                                            /* bind result variables */
                                                            mysqli_stmt_bind_result($stmt1,$perfil);

                                                        }


                                                        while (mysqli_stmt_fetch($stmt1)) {
                                                            ?>
                                                            <option value='<?=$perfil?>' <?php if ($perfil==$role){ echo "selected";}?>><?=$perfil?></option>
                                                        <?php
                                                        }

                                                        mysqli_stmt_close($stmt1);



                                                        ?>
                                                    </select>
                                                </div>
                                                <?php
                                                if( $idutilizador != $id ){
                                                    echo "<button type='submit' class='btn btn-info'>Submeter alterações</button>";
                                                }
                                                ?>
                                            </form>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>
                <?php

                }




                mysqli_stmt_close($stmt);


                }else{ header("location: users.php");}



                ?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>explain.ua &copy;  2019</span>
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