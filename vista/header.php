<?php 
    
    session_start();

    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
    $id_usuario = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['id_rol'];

 
    
    if (!isset($_SESSION['id_usuario'])) {
        header("location:login.php");
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Panel Administrativo</title>
    
    <!-- Main CSS-->
    <link href="Assets/css/main.css" rel="stylesheet" />
    <link href="Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href=">Assets/css/select2.min.css" rel="stylesheet" />
	<link href="Assets/css/estilos.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">

    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="Assets/css/font-awesome.min.css">
 
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
        <a class="app-header__logo" href="index.php">Infocenter</a>
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!--Notification Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">Libros no entregados.</li>
                    <div class="app-notification__content">
                        <li id="nombre_estudiante">

                        </li>
                    </div>
                    <li class="app-notification__footer"><a href="Configuracion/libros" target="_blank">Generar Reporte.</a></li>
                </ul>
            </li>
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i> <?php echo $nombre . ' ' . $apellidos; ?></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="Assets/img/user.jpg" alt="User Image" width="50">
            <div>
                <p class="app-sidebar__user-name"><?php echo $_SESSION['nombre'] ?></p>
                <p class="app-sidebar__user-designation"><?php echo $_SESSION['id_rol'] ?>Usuario</p>
            </div>
        </div> -->
        <hr>
        <ul class="app-menu">
            <!-- Link de Libros -->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Libros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="crearlibro.php"><i class="icon fa fa-circle-o"></i> Crear Libros</a></li>
                    <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-tags"></i> Editorial</a></li> -->
                    <li><a class="treeview-item" href="listarLibro.php"><i class="icon fa fa fa-circle-o"></i> Listar Libros</a></li>
                </ul>
            </li>
            <!-- Link de Autores -->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-id-card"></i><span class="app-menu__label">Autores</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="crearAutor.php"><i class="icon fa fa-circle-o"></i> Crear Autores</a></li>
                    <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-tags"></i> Editorial</a></li> -->
                    <li><a class="treeview-item" href="listarAutor.php"><i class="icon fa fa fa-circle-o"></i> Listado De Autores</a></li>
                </ul>
            </li>
            <!-- Link de Estudiantes -->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-graduation-cap"></i><span class="app-menu__label">Estudiantes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="crearEstudiante.php"><i class="icon fa fa-circle-o"></i> Crear Estudiantes</a></li>
                    <!-- <li><a class="treeview-item" href="#"><i class="icon fa fa-tags"></i> Editorial</a></li> -->
                    <li><a class="treeview-item" href="listarEstudiante.php"><i class="icon fa fa fa-circle-o"></i> Listar Estudiantes</a></li>
                </ul>
            </li>
            <!-- link de Usuario-->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="crearUsuario.php"><i class="icon fa fa-circle-o"></i> Crear Usuarios</a></li>
                    <li><a class="treeview-item" href="listarUsuario.php"><i class="icon fa fa-circle-o"></i>Listar Usuarios</a></li>
                </ul>
            </li>

            <!-- Link de Prestamos -->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-hourglass-start"></i><span class="app-menu__label">Prestamos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="crearPrestamo.php"><i class="icon fa fa fa-circle-o"></i> Crear Prestamo</a></li>
                    <li><a class="treeview-item" href="listarPrestamo.php"><i class="icon fa fa fa-circle-o"></i>Listar Prestamos</a></li>
                </ul>
            </li>

            <!-- Libros Prestados -->
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Reportes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" target="_blank" href="#"><i class="icon fa fa-file-pdf-o"></i> Libros Prestados</a></li>
                </ul>
            </li>
            <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-wrench"></i><span class="app-menu__label">Administración</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="#"><i class="icon fa fa-cogs"></i> Configuración</a></li>
                </ul>
            </li> -->
            <!-- Section Logo -->
            <li>
                <div class="logo">
                <img class="sidebar-card-illustration mb-2 img-fluid" src="Assets/img/Logo/Logo_1.png" alt="User Image" width="90%">
                </div>
            </li>
        </ul>
    </aside>
    <main class="app-content">