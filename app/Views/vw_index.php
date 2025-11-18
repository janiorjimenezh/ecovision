<?php
	$vbaseurl = base_url()."/";
	$institucion=session()->userInstitucion;
	$vcarpeta=$institucion->carpeta;
?>

<style>
	.divcard_img {
		display: block;
	    margin-bottom: 20px;
	    position: relative;
	}

	.divcard_img .divcontent_img {
		border-radius: 0.25rem;
	    -ms-flex-align: center;
	    align-items: center;
/*	    background-color: rgba(255,255,255,.7);*/
	    display: -ms-flexbox;
	    display: flex;
	    -ms-flex-pack: center;
	    justify-content: center;
	    z-index: 50;
	}

	.divcard_img> .divcontent_img {
		height: 100%;
	    left: 0;
	    position: absolute;
	    top: 0;
	    width: 100%;
	}
</style>
<div class="content-wrapper">
	<section class="content pt-2">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div id="divboxIndex" class="card">
						<div class="card-body">
							<div class="divcard_img">
								<img src="<?php echo "{$vbaseurl}public/img/bolsa-laboral.jpg" ?>" alt="" class="img-fluid">
								<div class="divcontent_img">
									<!-- <h2 class="text-white w-100">Bolsa Laboral</h2> -->
									<div class="w-50">
										<img src="<?php echo "{$vbaseurl}public/img/{$vcarpeta}/logo_login_h80.png" ?>" alt="" class="img-fluid">
									</div>
									
								</div>
							</div>
							
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
</div>