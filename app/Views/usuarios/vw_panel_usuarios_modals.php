<!--EDITAR ACCESO-->
  <div class="modal fade" id="modalAcceso" tabindex="-1" role="dialog" aria-labelledby="modalAcceso" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" id="divmodalAcceso">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Acceso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <input id="factxt-iduser" name="factxt-iduser" type="hidden" value="ADM">
              <div class="row">
                <div class="form-group has-float-label col-12 ">
                  <input class="form-control" id="factxt-user" name="factxt-user" type="text" placeholder="Usuario" minlength="4" required />
                  <label for="factxt-user"><span class="fas fa-user-tie"></span> Usuario</label>
                </div>
                <div class="form-group has-float-label col-12 ">
                  <input class="form-control" id="factxt-clave" name="factxt-clave" type="text" placeholder="Nueva contraseña" minlength="6" required />
                  <label for="factxt-clave"><span class="fas fa-user-tie"></span> Nueva contraseña</label>
                </div>
                 <div class="form-group has-float-label col-12 mt-3">
                  <input class="form-control" id="factxt-correo" name="factxt-correo" type="text" placeholder="Correo institucional *" minlength="4" required />
                  <label for="factxt-correo"><i class="fas fa-at"></i> Correo institucional *</label>

                </div>
                
                
                
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="mabtn-guardar" data-iduser='' class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="modalSedes" tabindex="-1" role="dialog" aria-labelledby="modalSedes" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">SEDES</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul id="list-sedes" data-default='0' class="todo-list" data-widget="todo-list">
            
            <?php
            foreach ($sedes as $sede) {
            if ($sede->activo=='SI'){
            $codsede=$sede->codsede;
            ?>
            <li>
              <div class="row">
              <div class="custom-control custom-switch col-8">
                <input type="checkbox" class="custom-control-input" data-existe='NO' data-defecto='NO' data-ndefecto='NO' value="<?php echo $codsede ?>" id="ss<?php echo $codsede ?>">
                <label class="custom-control-label" for="ss<?php echo $codsede ?>"><?php echo $sede->sede ?></label>
              </div>
              <div class="custom-control custom-radio col-4">
                <input type="radio" class="custom-control-input" name='sededef' value="<?php echo $codsede ?>" id="srd<?php echo $codsede ?>">
                <label class="custom-control-label" for="srd<?php echo $codsede ?>">Defecto</label>
              </div> 
              </div>
            </li>
            <?php }
            }
            ?>
            
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="msbtn-guardar" data-iduser='' class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
<script>

  function fn_cargarPermisosUsuario(btn) {
    $('#divboxbusqueda').append('<div id="divoverlay" class="overlay"><i class="fas fa-spinner fa-pulse fa-3x"></i></div>');
    tipous = $("#txttipo").val();
    tbcuentasadm = (tipous == "ADM") ? $('#tbmt_dtusuarios').DataTable() : $('#tbmt_dtusuariosalum').DataTable();
    fila = btn.closest('.cfila');
    
    var vCodUsuario64=fila.data("codusuario64");

  $("#divPermisos").html("");
   $("#mpbtn-guardar").data('iduser', vCodUsuario64)
    $.ajax({
        url: base_url + "usuario/vw_permisos_por_usuario",
        type: 'post',
        dataType: "json",
        data: {
            txtcoduser: icod
        },
        success: function(e) {
          $('#divboxbusqueda #divoverlay').remove();
          $("#divPermisos").html(e.rweb);
          //$("#mpbtn-guardar").data('idsede', icod)
          $("#modPermisos").modal("show");
          
        },
        error: function(jqXHR, exception) {
            var msgf = errorAjax(jqXHR, exception, 'div');
            $('#divboxbusqueda #divoverlay').remove();
            $("#modPermisos modal-body").html(msgf);
        } 
    });
    return false;
  }


  function fn_cargarSedesUsuario(vcodusuario64){
    $('#divboxbusqueda').append('<div id="divoverlay" class="overlay"><i class="fas fa-spinner fa-pulse fa-3x"></i></div>');
    $('#modalSedes input[type=checkbox]').prop('checked', false);
    $('#modalSedes input[type=radio]').prop('checked', false);
    $('#list-sedes').data('default', '0');
    $("#msbtn-guardar").data('iduser', vcodusuario64)

    $('#modalSedes input[type=checkbox]').data('existe', 'NO');
    $.ajax({
        url: base_url + "auth/usuarios/usuario/sedes",
        type: 'post',
        dataType: "json",
        data: {
            txtcodusuario64: vcodusuario64
        },
        success: function(e) {
          var sdf=0;
           $.each(e.vdata, function(key, val) {
              $('#ss' + val['codsede']).prop('checked', true)
              $('#ss' + val['codsede']).data('existe', 'SI')
              if (val['esdefecto']=='SI') sdf=val['codsede'];
            });
           $('#divboxbusqueda #divoverlay').remove();

            $('#modalSedes input[type=checkbox]').data('defecto', 'NO');
           if (sdf!=0){
              $('#list-sedes').data('default', sdf);
              $('#srd' + sdf).prop('checked', true);
              $('#ss' + sdf).data('defecto', 'SI');
           } 
           
          $("#modalSedes").modal("show");
        },
        error: function(jqXHR, exception) {
            var msgf = errorAjax(jqXHR, exception,'div' );
            $('#divboxbusqueda #divoverlay').remove();
            $("#modalSedes modal-body").html(msgf);
        } 
    });
    return false;
  }

  $("#msbtn-guardar").click(function(event) {
    /* Act on the event */
    arr_insert = [];
    arr_update = [];
    arr_delete = [];
    
    var iduser=$(this).data('iduser');
    var sd_curdef=$('#list-sedes').data('default');

    $('#modalSedes input[type=checkbox]').data('ndefecto', 'NO');
    var sd_newdef=$("#modalSedes input[name='sededef']:checked").val();
    sd_newdef=(sd_newdef===undefined)? 0 : sd_newdef;
    $('#ss' + sd_newdef).data('ndefecto', 'SI');

    $("#modalSedes input:checkbox").each(function() {
        var el=$(this);
        var is_checked=el.prop('checked');
        if (is_checked==true){
          if (el.data('existe')=='SI'){
            if (el.data('ndefecto')!=el.data('defecto')){
              var myvals = [el.data('ndefecto'), iduser, el.val()];
              arr_update.push(myvals);
            }
          }
          else{
              var myvals = [el.val(), iduser, el.data('ndefecto')];
              arr_insert.push(myvals);
          }
        }
        else{
          if (el.data('existe')=='SI'){
            var myvals = [el.val(),iduser];
            arr_delete.push(myvals);
          }
        }
    });

    $.ajax({
        url: base_url + "usuario/fn_asignar_sedes",
        type: 'post',
        dataType: "json",
        data: {
                finsertar: JSON.stringify(arr_insert),
                feditar: JSON.stringify(arr_update),
                feliminar: JSON.stringify(arr_delete),
        },
        success: function(e) {
          if (e.status==true){
            $("#modalSedes").modal("hide");
          }
        },
        error: function(jqXHR, exception) {
            var msgf = errorAjax(jqXHR, exception, 'div');
            $('#divboxbusqueda #divoverlay').remove();
            $("#modalSedes modal-body").html(msgf);
        } 
    });

  });

</script>
