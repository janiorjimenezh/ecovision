<?php
	$vbaseurl=base_url();
	if (!isset($menu_padre)) $menu_padre="";
	if (!isset($menu_hijo))  $menu_hijo="";
	$ss=session();
?>
<aside class="main-sidebar elevation-4 sidebar-dark-olive">
	<!-- Brand Logo -->
	<a href="<?php echo $vbaseurl ?>" class="brand-link">
		<img src="././img/logo.png" alt="Logo Institucional" class="brand-image img-circle elevation-3 bg-white" >
		<span class="brand-text font-weight-light"><b>PORTAL</b></span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		
		<div class="user-panel mt-3 pb-2 mb-2 d-flex">
			<div class="image">
				<img src="././img/user.png" class="img-circle elevation-2" alt="User">
			</div>
			<div class="info">
				<a href="<?php echo $vbaseurl ?>auth/mi-perfil" class="d-block small" data-toggle="tooltip" data-placement="right" title="Mi Perfil">
					<?php echo $ss->usuario->apellidos; ?>
				</a>
			</div>
		</div>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- <li class="nav-item">
					<a href="<?php echo $vbaseurl ?>auth/mi-perfil" class="nav-link <?php echo ($menu_padre=='miperfil') ? 'active' : '' ?>">
						<i class="fas fa-user nav-icon"></i><p>Mi perfil</p>
					</a>
				</li> -->
				<li class="nav-item">
					<a href="<?php echo $vbaseurl ?>auth/usuarios" class="nav-link <?php echo ($menu_padre=='usuarios') ? 'active' : '' ?>">
						<i class="fas fa-user nav-icon"></i><p>Usuarios</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo $vbaseurl ?>mapa" class="nav-link <?php echo ($menu_padre=='mapa') ? 'active' : '' ?>">
						<i class="fas fa-user nav-icon"></i><p>Mapa de Contaminación</p>
					</a>
				</li>
				
		        
			</ul>
		</nav>
	</div>
</aside>