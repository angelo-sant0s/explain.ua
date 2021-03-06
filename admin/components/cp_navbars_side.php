<?php
// Verificação de credenciais de acesso à área de administração
require_once "../scripts/sc_check_admin.php";

?>

<!-- Sidebar -->

<ul class="navbar-nav bg-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img src="../../imgs/logobranco.svg" width="80px" alt="img2">
        </div>
        <div class="sidebar-brand-text mx-3">explain.ua</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestão
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="users.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Utilizadores</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tickets.php">
            <i class="fas fa-fw fa-ticket-alt"></i>
            <span>Tickets</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
