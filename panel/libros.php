<?php
	require('php_lib/include-pagina-restringida.php'); //el incude para vericar que estoy logeado. Si falla salta a la pÃÂ¡gina de login.php
	{
	  include_once('php_lib/config.ini.php');
      include('php_lib/conv.php');
      
      $link =  mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);
    if (!$link) {
        trigger_error('Error al conectar al servidor mysql: ');
    }
    // Seleccionar la base de datos activa
    $db_selected = mysqli_select_db($link,BASE_DATOS);
    if (!$db_selected) {
        trigger_error ('Error al conectar a la base de datos: ');
    }
	mysqli_set_charset($link,"utf8");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="ligth" data-header-styles="color" data-width="fullwidth" data-menu-styles="color" data-toggled="close" style="--primary-rgb: 222, 30, 20;">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Uber-Sex </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Wcsrm Software Private Limited">
	<meta name="keywords" content="bootstrap template, admin panel bootstrap, bootstrap dashboard, admin, admin dashboard template, dashboard template, html css templates, dashboard, template dashboard,  bootstrap dashboard template, dashboard html css, bootstrap admin dashboard,  bootstrap admin, dashboard template, bootstrap5 admin template">
    
    <!-- Favicon -->
    <link rel="icon" href="img/icon.png" type="image/x-icon">
    
    <!-- Choices JS -->
    <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="../assets/js/main.js"></script>
    
    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="../assets/css/styles.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="../assets/css/icons.css" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="../assets/libs/node-waves/waves.min.css" rel="stylesheet" > 

    <!-- Simplebar Css -->
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet" >
    
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="../assets/libs/choices.js/public/assets/styles/choices.min.css">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="../assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">


</head>

<body>

     <!-- Loader -->
<div id="loader" >
    <img src="img/iconBannerMain.png" alt="">
</div>
<!-- Loader -->

<div class="page">
         <!-- app-header -->
<header class="app-header sticky" id="header">

    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="dashboard.php" class="header-logo">
                        <img src="img/iconBannerMain.png" alt="logo" class="desktop-logo">
                        <img src="img/iconBannerMain.png" alt="logo" class="toggle-logo">
                        <img src="img/iconBannerMain.png" alt="logo" class="desktop-dark">
                        <img src="img/iconBannerMain.png" alt="logo" class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link" data-bs-toggle="sidebar"
                    href="javascript:void(0);">
                    <svg style="color: white !important;fill: white;" xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn" width="32" height="32"
                        fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z">
                        </path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn-close" width="32"
                        height="32" fill="#000000" viewBox="0 0 256 256">
                        <path
                            d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z">
                        </path>
                    </svg>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->


        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">


          
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <li class="header-element dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div class="me-xl-2 me-0">
                            <img src="img/user.png" alt="img" class="avatar avatar-sm avatar-rounded">
                        </div>
                        <div class="d-xl-block d-none lh-1">
                            <span class="fw-medium lh-1">Usuario</span>
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <li>
                        <div class="py-2 px-3 text-center"> <span class="fw-semibold"> Usuario </span> <span
                                class="d-block fs-12 text-muted">Administrador</span> </div>
                    </li>
                     <li><a class="dropdown-item d-flex align-items-center" href="administrador.php"><i
                                class="ti ti-user text-primary me-2 fs-16"></i>Administradores</a>
                    </li>
                    
                    <li class="py-2 px-3"><a class="btn btn-primary btn-sm w-100" href="logout.php">Cerrar sesión</a>
                    </li>
                </ul>
            </li>
            <!-- End::header-element -->

          
            <!-- End::header-element -->

        </ul>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->
         <!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="dashboard.php" class="header-logo" style="display: flex;">
            <img src="img/logous.png" alt="logo" class="desktop-logo" style="width: 170px;height: 49px;">
            <img src="img/iconBannerMain.png" alt="logo" class="toggle-dark" style="width: 34px;height: 34px;">
            <img src="img/logous.png" alt="logo" class="desktop-dark" style="width: 170px;height: 49px;">
            <img src="img/iconBannerMain.png" alt="logo" class="toggle-logo" style="width: 34px;height: 34px;">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Dashboards</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="dashboard.php" class="side-menu__item">
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M104,216V152h48v64h64V120a8,8,0,0,0-2.34-5.66l-80-80a8,8,0,0,0-11.32,0l-80,80A8,8,0,0,0,40,120v96Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                    <ul class="slide-menu child1">
                       
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Web Apps</span></li>
                <!-- End::slide__category -->
<li class="slide has-sub">
                    <a href="administrador.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Administradores</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="clientes.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Clientes</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="profesionales.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Profesionales</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Ajustes</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Ajustes</a>
                        </li>
                        <li class="slide">
                            <a href="detalles.php" class="side-menu__item">Sexo</a>
                        </li>
                        <li class="slide">
                            <a href="edad.php" class="side-menu__item">Edad</a>
                        </li>
                        <li class="slide">
                            <a href="cabello.php" class="side-menu__item">Color Cabello</a>
                        </li>
                        <li class="slide">
                            <a href="piel.php" class="side-menu__item">Tipo Piel</a>
                        </li>
                        <li class="slide">
                            <a href="complexion.php" class="side-menu__item">Complexion</a>
                        </li>
                        <li class="slide">
                            <a href="peso.php" class="side-menu__item">Peso</a>
                        </li>
                        <li class="slide">
                            <a href="altura.php" class="side-menu__item">Altura</a>
                        </li>
                        <li class="slide">
                            <a href="medidap.php" class="side-menu__item">Medida Pechos</a>
                        </li>
                       
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="categorias.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Tarifas</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                
                <li class="slide has-sub">
                    <a href="libros.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Galeria</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                 <li class="slide has-sub">
                    <a href="provincia.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Pais</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="tags.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Ciudades</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="traducciones.php" class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        <span class="side-menu__label">Traducciones</span>
                        <i style="display:none" class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
              
                <!-- End::slide__category -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h1 class="page-title fw-medium fs-18 mb-2">Galeria</h1>
                        <div class="">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Galeria</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="btn-list">
                        <button class="btn btn-primary-light btn-wave me-2" data-bs-toggle="modal" data-bs-target="#create-product">
                            <i class="bx bx-category align-middle"></i> Agregar Detalles
                        </button>
                    </div>
                    <div class="modal fade" id="create-product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="form" action="procesar2_product.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar Producto</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="row gy-2">
                        <div class="col-xl-12">
                            <label for="category_id" class="form-label">Categoría</label>
                         
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="" selected>Seleccione</option>
                                <?php
                                $query = "SELECT * FROM categories where status = '1'";
                                $result = mysqli_query($link, $query);
                                $numero = 1;
                                while ($row = mysqli_fetch_assoc($result)) 
                                {
                                   $idus = $row["id"];
                                   $nombres = $row["name"];
                                   echo'<option value="'.$idus.'">'.$nombres.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="tag_id" class="form-label">Etiqueta</label>
                        
                            <select class="form-control" name="tag_id" id="tag_id">
                                <option value="" selected>Seleccione</option>
                                <?php
                                $query = "SELECT * FROM tags where status = '1'";
                                $result = mysqli_query($link, $query);
                                $numero = 1;
                                while ($row = mysqli_fetch_assoc($result)) 
                                {
                                   $idus = $row["id"];
                                   $nombres = $row["name"];
                                   echo'<option value="'.$idus.'">'.$nombres.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-control" name="type" id="type">
                                <option value="book" selected>Book</option>
                                <option value="audio">Audio</option>
                            </select>
                           
                        </div>
                        <div class="col-xl-12">
                            <label for="language_id" class="form-label">ID de Lenguaje</label>
                            <input type="number" class="form-control" id="language_id" name="language_id" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="city" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="col-xl-12">
                            <label for="audio_link" class="form-label">Enlace de Audio</label>
                            <input type="text" class="form-control" id="audio_link" name="audio_link">
                        </div>
                        <div class="col-xl-12">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="col-xl-12">
                            <label for="author_name" class="form-label">Nombre del Autor</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="cover_image" class="form-label">Imagen de Portada</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image">
                        </div>
                        <div class="col-xl-12">
                            <label for="p_length" class="form-label">Longitud del Producto</label>
                            <input type="text" class="form-control" id="p_length" name="p_length" required>
                        </div>
                        <div class="col-xl-12">
                            <label for="upload_data" class="form-label">Subir PDF</label>
                            <input type="file" class="form-control" id="upload_data" name="upload_data" accept=".pdf">
                        </div>
                        <div class="col-xl-12">
                            <label for="book_count" class="form-label">Cantidad de Libros</label>
                            <input type="text" class="form-control" id="book_count" name="book_count" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <table id="responsivemodal-DataTable" class="table table-bordered text-nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                      
                            
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Imagen de Portada</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($link, $query);
                        $numero = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Obtener los valores de los campos de la tabla products
                            $id = $row["id"];
                            $category_id = $row["category_id"];
                            $tag_id = $row["tag_id"];
                            $name = $row["name"];
                            $status = $row["status"];
                            $type = $row["type"];
                            $language_id = $row["language_id"];
                            $city = $row["city"];
                            $audio_link = $row["audio_link"];
                            $description = $row["description"];
                            $author_name = $row["author_name"];
                            $cover_image = $row["cover_image"];
                            $p_length = $row["p_length"];
                            $upload_data = $row["upload_data"];
                            $currentFile = $row['upload_data'];
                            $book_count = $row["book_count"];
                            
                            // Cambiar estado de "status" para mostrar "Sí" o "No"
                            $status_display = ($status == 1) ? "Sí" : "No";
                            
                            echo '<tr>
                                <td>'.$id.'</td>
                                <td>'.$name.'</td>';
                                $query3 = "SELECT name FROM categories WHERE id = '$category_id'";
                                $result3 = mysqli_query($link, $query3);
                                $row3 = mysqli_fetch_assoc($result3);
                                $category_name = $row3['name'];
                               echo'<td>'.$category_name.'</td>
                                <td>'.$status_display.'</td>
                                <td>'.$type.'</td>
                                <td>';
                                if ($cover_image) {
                                    $imagePath = '../../ebook/uploads/product/' . $cover_image;
                                    if (file_exists($imagePath)) {
                                        echo '<img src="' . $imagePath . '" style="width: 100px;" alt="Imagen de portada">';
                                    } else {
                                        echo 'Imagen no encontrada.';
                                    }
                                } else {
                                    echo 'No hay imagen asociada.';
                                }
                            echo '</td>
                                
                              
                               
                                <td><div class="btn-list">
                                        <a href="javascript:void(0)" title="Editar" class="btn btn-icon btn-sm btn-primary-light" data-bs-toggle="modal" data-bs-target="#edit-product'.$numero.'"><i class="ti ti-edit"></i></a>
                                        <a href="javascript:void(0)" title="Eliminar" onclick="confirmDelete('.$id.')" class="btn btn-icon btn-sm btn-secondary-light"><i class="ti ti-trash"></i></a>
                                    </div></td>
                            </tr>';
                            
                            // Modal de edición
                            echo '<div class="modal fade" id="edit-product'.$numero.'" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form class="form" action="procesar_product.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                            <input type="hidden" class="form-control" name="id" value="'.$id.'" required>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Editar Detalles</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-4">
                                                    <div class="row gy-2">
                                                        <!-- Inputs de edición -->
                                                        <div class="col-xl-12">
                                                            <label for="category_id" class="form-label">Categoría</label>
                                                       
                                                            <select class="form-control" name="category_id" id="category_id">';
                                                            // Asumimos que $category_id es el valor actual de la categoría seleccionada
                                                            // Este valor podría ser un valor previamente guardado en la base de datos para editar el producto
                                                            $query2 = "SELECT * FROM categories WHERE status = '1'";
                                                            $result2 = mysqli_query($link, $query2);
                                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                $idus = $row2["id"];
                                                                $nombres = $row2["name"];
                                                        
                                                                // Comprobamos si el valor de la categoría es igual al valor guardado (esto hará que se seleccione la opción)
                                                                echo '<option value="' . $idus . '" ' . ($idus == $category_id ? 'selected' : '') . '>' . $nombres . '</option>';
                                                            }
                                                        
                                                        echo'</select>
                                                            
                                                            
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="tag_id" class="form-label">Etiqueta</label>
                                                          
                                                            <select class="form-control" name="tag_id" id="tag_id">';
                                                          
                                                            $query22 = "SELECT * FROM tags WHERE status = '1'";
                                                            $result22 = mysqli_query($link, $query22);
                                                            while ($row22 = mysqli_fetch_assoc($result22)) {
                                                                $idus2 = $row22["id"];
                                                                $nombres2 = $row22["name"];
                                                        
                                                                // Comprobamos si el valor de la categoría es igual al valor guardado (esto hará que se seleccione la opción)
                                                                echo '<option value="' . $idus2 . '" ' . ($idus2 == $tag_id ? 'selected' : '') . '>' . $nombres2 . '</option>';
                                                            }
                                                        
                                                        echo'</select>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" name="name" value="'.$name.'" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="status" class="form-label">Estado</label>
                                                            <select class="form-control" name="status">
                                                                <option value="1" '.($status == 1 ? 'selected' : '').'>Sí</option>
                                                                <option value="0" '.($status == 0 ? 'selected' : '').'>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="type" class="form-label">Tipo</label>
                                                            <select class="form-control" name="type">
                                                                <option value="book" '.($type == 'book' ? 'selected' : '').'>Book</option>
                                                                <option value="audio" '.($type == 'audio' ? 'selected' : '').'>Audio</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="language_id" class="form-label">ID de Idioma</label>
                                                            <input type="number" class="form-control" name="language_id" value="'.$language_id.'" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="city" class="form-label">Ciudad</label>
                                                            <input type="text" class="form-control" name="city" value="'.$city.'" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="audio_link" class="form-label">Enlace de Audio</label>
                                                            <input type="text" class="form-control" name="audio_link" value="'.$audio_link.'">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <textarea class="form-control" name="description" required>'.$description.'</textarea>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="author_name" class="form-label">Nombre del Autor</label>
                                                            <input type="text" class="form-control" name="author_name" value="'.$author_name.'" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="cover_image" class="form-label">Cambiar Imagen de Portada</label>
                                                            <input type="file" class="form-control" name="cover_image">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="p_length" class="form-label">Longitud del Producto</label>
                                                            <input type="text" class="form-control" name="p_length" value="'.$p_length.'" required>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label for="upload_data" class="form-label">Subir PDF</label>
                                                            <input type="file" class="form-control" name="upload_data" accept="application/pdf">
                                                        </div>';
                                                        if (!empty($currentFile)) {
                                                                echo '<div class="mt-2">
                                                                        <a href="../../ebook/uploads/pdf/' . $currentFile . '" class="btn btn-secondary" download>Descargar PDF</a>
                                                                      </div>';
                                                            }
                                                        echo'<div class="col-xl-12">
                                                            <label for="book_count" class="form-label">Conteo de Libros</label>
                                                            <input type="text" class="form-control" name="book_count" value="'.$book_count.'" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>';
                            $numero++;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                <!--End::row-1 -->

            </div>
        </div>
        <!-- End::app-content -->
<script>
    function confirmDelete(idProducto) {
        const message = `¿Desea eliminar el producto con ID: ${idProducto}?`;
        const confirmation = confirm(message);
        
        if (confirmation) {
            // Redirigir al archivo PHP para eliminar el producto
            window.location.href = "procesar_product_delete.php?id_producto=" + encodeURIComponent(idProducto);
        } else {
            console.log("Eliminación cancelada.");
        }
    }
</script>
        
        <!-- Footer Start -->
<footer class="footer mt-auto py-3 bg-white text-center">
    <div class="container">
        <span class="text-muted"> Copyright © <span id="year">2024</span> Todos los derechos reservados
        </span>
    </div>
</footer>
<!-- Footer End -->
         <div class="modal fade" id="header-responsive-search" tabindex="-1" aria-labelledby="header-responsive-search" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                        aria-label="Search Anything ..." aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button"
                        id="button-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

   
<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow lh-1"><i class="ti ti-arrow-big-up fs-16"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->
 <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- Popper JS -->
<script src="../assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="../assets/js/defaultmenu.min.js"></script>

<!-- Node Waves JS-->
<script src="../assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="../assets/js/sticky.js"></script>

<!-- Simplebar JS -->
<script src="../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../assets/js/simplebar.js"></script>

<!-- Auto Complete JS -->
<script src="../assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>

<!-- Color Picker JS -->
<script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- Date & Time Picker JS -->
<script src="../assets/libs/flatpickr/flatpickr.min.js"></script>

 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Internal Datatables JS -->
    <script src="../assets/js/datatables.js"></script>
   
<!-- Custom-Switcher JS -->
<script src="../assets/js/custom-switcher.min.js"></script>

    <!-- Custom JS -->
    <script src="../assets/js/custom.js"></script>

</body>

</html>
<?php 
}	
?>