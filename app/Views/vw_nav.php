<body class="sidebar-mini layout-fixed text-sm control-sidebar-slide-open layout-navbar-fixed">
  <?php 
  $vbaseurl=base_url();
  $ss=session();
  ?>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        
      </ul>
      <ul class="navbar-nav ml-auto">
       
        <li class="nav-item dropdown user user-menu">
          <a href="#" class="nav-link dropdown-toogle" data-toggle="dropdown"><i class="fas fa-th"></i></a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <div class="row m-0">
              <div class="col-4  p-2">
                <a href="<?php echo $vbaseurl ?>"  data-toggle="tooltip" title="ERP" class="d-block border text-center py-2">
                  <i class="fas fa-globe-europe fa-3x"></i>
                </a>
              </div>

              <div class="col-4  p-2">
                <a href="<?php echo $vbaseurl ?>admision" data-toggle="tooltip" title="" class="d-block border text-center py-2" data-original-title="Admisión">
                  <i class="fas fa-user-graduate fa-3x"></i>
                </a>
              </div>
              
              <div class="col-4  p-2">
                <a href="<?php echo $vbaseurl ?>portal"  data-toggle="tooltip" title="Portal Web" class="d-block border text-center py-2">
                  <i class="fas fa-pager fa-3x"></i>
                </a>
              </div>
              <div class="col-4  p-2">
                <a href="<?php echo $vbaseurl ?>bienestar-del-estudiante/" data-toggle="tooltip" title="" class="d-block border text-center py-2" data-original-title="Bienestar">
                  <i class="fas fa-id-card fa-3x"></i>
                </a>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown user user-menu">
          <a class="nav-link dropdown-toogle" data-toggle="dropdown" href="#">
            
            <img src="././img/user.png" class="user-image" alt="User">
            <small><span class="d-none d-sm-inline-block"><?php echo $ss->usuario->apellidos; ?></span></small>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header user-header">
              
              <p>
                <small><?php echo $ss->usuario->apellidos; ?></small>
              
              </p>
            </span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo $vbaseurl ?>auth/mi-perfil" class="dropdown-item">
              Mi Perfil
            </a>
            <a href='#' class="dropdown-item">
              Actualizar Permisos
            </a>
            <div class="dropdown-divider"></div>
          
            <a href="<?php echo $vbaseurl ?>usuario/cerrar-sesion" class="dropdown-item">Cerrar sesión</a>
           
          </div>
        </li>
      </ul>
    </nav>
