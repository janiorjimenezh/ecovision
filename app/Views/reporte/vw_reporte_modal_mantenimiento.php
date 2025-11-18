<div class="modal fade" id="modalReporte" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <form action="<?= base_url('/reporte/guardar') ?>" method="post" enctype="multipart/form-data">

        <!-- HEADER -->
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white mb-0">
            <i class="fa-solid fa-leaf mr-2"></i> Nuevo Reporte Ambiental
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <!-- BODY -->
        <div class="modal-body">

          <div class="row">

            <!-- TÍTULO -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Título</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-heading"></i>
                    </span>
                  </div>
                  <input type="text" name="rep_titulo" class="form-control" required>
                </div>
              </div>
            </div>

            <!-- TIPO -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Tipo</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-leaf"></i>
                    </span>
                  </div>
                  <select name="rep_tipo" class="form-control" required>
                    <?php foreach ($tipocontamina as $key => $tc): ?>
                      <option value="<?php echo $tc->tip_id ?>">
                        <?php echo $tc->tip_nombre ?>
                      </option>
                    <?php endforeach ?>
                    
                    
                  </select>
                </div>
              </div>
            </div>

            <!-- DESCRIPCIÓN -->
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripción</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-align-left"></i>
                    </span>
                  </div>
                  <textarea name="rep_descripcion" rows="3" class="form-control" required></textarea>
                </div>
              </div>
            </div>

            <!-- NIVEL -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Nivel</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-signal"></i>
                    </span>
                  </div>
                  <select name="rep_nivel" class="form-control">
                    <?php foreach ($nivelcontamina as $key => $tc): ?>
                      <option value="<?php echo $tc->niv_id ?>">
                        <?php echo $tc->niv_nombre ?>
                      </option>
                    <?php endforeach ?>
                    
                  </select>
                </div>
              </div>
            </div>

            <!-- IMAGEN -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Imagen</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-image"></i>
                    </span>
                  </div>
                  <input type="file" name="rep_imagen" class="form-control" accept="image/*">
                </div>
              </div>
            </div>

            <!-- LATITUD -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Latitud</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-location-crosshairs"></i>
                    </span>
                  </div>
                  <input type="text" name="rep_latitud" id="lat" class="form-control" required>
                </div>
              </div>
            </div>

            <!-- LONGITUD -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Longitud</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-location-crosshairs"></i>
                    </span>
                  </div>
                  <input type="text" name="rep_longitud" id="lng" class="form-control" required>
                </div>
              </div>
            </div>

          </div>

        </div>

        <!-- FOOTER -->
        <div class="modal-footer">
          <button class="btn btn-success">
            <i class="fa-solid fa-check mr-1"></i> Guardar
          </button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa-solid fa-xmark mr-1"></i> Cerrar
          </button>
        </div>

      </form>

    </div>
  </div>
</div>

<script>
navigator.geolocation.getCurrentPosition(pos => {
  document.getElementById('lat').value = pos.coords.latitude.toFixed(6);
  document.getElementById('lng').value = pos.coords.longitude.toFixed(6);
});
</script>
