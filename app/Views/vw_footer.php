
<?php $vbaseurl=base_url() ?>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear());</script> <a href="#">Meraki TD</a>.</strong> All rights
    reserved.
  </footer>
</div>

<!-- overlayScrollbars -->
<!-- <script src="<?php echo $vbaseurl ?>resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="<?php echo $vbaseurl ?>resources/plugins/fastclick/fastclick.js"></script> -->
<!-- AdminLTE App -->
<script src="<?php echo $vbaseurl ?>js/adminlte.min.js"></script>


<script>
  
$(document).ready(function() {
   $("#s-cargando").hide();
   $('[data-toggle="tooltip"]').tooltip()

   $('.tbdatatable tbody').on('click', 'tr', function () {
        $('.tbdatatable tbody tr').removeClass('table-primary');
        $(this).addClass('table-primary');
    });
});

function fn_conectarSede(btn) {
    var vCodSede=btn.data("codsede");
    $.ajax({
        url: base_url + 'auth/usuarios/usuario/conectar-a-sede',
        type: 'post',
        dataType: 'json',
        data: {codsede:vCodSede},
        success: function(e) {
            if (e.status == false) {
                Swal.fire({
                      title: e.msg,
                      icon: 'error',
                })
            } 
            else {
                location.reload();
            }
        },
        error: function(jqXHR, exception) {
            var msgf = errorAjax(jqXHR, exception,'text');
            Swal.fire({
                  title: msgf,
                  icon: 'error',
            })
        }
    });

};
</script>
</body>
</html>
