<div class="content-wrapper">
    <section class="content pt-2">

            <div class="container">
        <h2>Listado de Usuarios</h2>

        <button class="btn btn-primary mb-3" id="btnNuevo">Nuevo Usuario</button>

        <table id="tablaUsuarios" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- MODAL CREAR / EDITAR -->
    <div class="modal fade" id="modalForm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="tituloModal"></h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formUsuario">

                        <input type="hidden" id="usu_codigo">

                        <div class="mb-2">
                            <label>Apellidos</label>
                            <input type="text" id="usu_apellidos" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Nombres</label>
                            <input type="text" id="usu_nombres" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" id="usu_email" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Clave</label>
                            <input type="text" id="usu_clave" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Rol</label>
                            <select id="usu_rol" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="cliente">Cliente</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Activo</label>
                            <select id="usu_activo" class="form-select">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalDelete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Confirmar Eliminación</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>¿Desea eliminar este usuario?</p>
                    <input type="hidden" id="delete_id">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" id="btnDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</section>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let tabla;

        $(document).ready(function(){

            tabla = $('#tablaUsuarios').DataTable({
                ajax: "<?= base_url('users/list'); ?>",
                columns: [
                    {data: 'usu_codigo'},
                    {data: 'usu_apellidos'},
                    {data: 'usu_nombres'},
                    {data: 'usu_email'},
                    {data: 'usu_rol'},
                    {data: 'usu_activo'},
                    {
                    data: 'usu_codigo',
                        render: function(data){
                            return `
                                <button class="btn btn-warning btn-sm" onclick="editar(${data})">Editar</button>
                                <button class="btn btn-danger btn-sm" onclick="eliminar(${data})">Eliminar</button>
                            `;
                        }
                    }
                ]
            });

            $("#btnNuevo").click(function(){
                $("#tituloModal").text("Nuevo Usuario");
                $("#formUsuario")[0].reset();
                $("#usu_codigo").val("");
                $("#modalForm").modal("show");
            });

            $("#btnGuardar").click(function(){
                let id = $("#usu_codigo").val();
                let url = id ? "users/update/" + id : "users/create";

                $.post(url, $("#formUsuario").serialize(), function(){
                    $("#modalForm").modal("hide");
                    tabla.ajax.reload();
                });
            });

            $("#btnDelete").click(function(){
                let id = $("#delete_id").val();
                $.get("users/delete/" + id, function(){
                    $("#modalDelete").modal("hide");
                    tabla.ajax.reload();
                });
            });
        });

        function editar(id){
            $.get("users/get/" + id, function(data){
                let u = JSON.parse(data);

                $("#tituloModal").text("Editar Usuario");
                $("#usu_codigo").val(u.usu_codigo);
                $("#usu_apellidos").val(u.usu_apellidos);
                $("#usu_nombres").val(u.usu_nombres);
                $("#usu_email").val(u.usu_email);
                $("#usu_clave").val(u.usu_clave);
                $("#usu_rol").val(u.usu_rol);
                $("#usu_activo").val(u.usu_activo);

                $("#modalForm").modal("show");
            });
        }

        function eliminar(id){
            $("#delete_id").val(id);
            $("#modalDelete").modal("show");
        }

    </script>