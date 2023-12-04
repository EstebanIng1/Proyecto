<!-- Modal para registrar un colegio --> 
<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarLabel">Registrar Colegio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="registroColegioForm" action="registrar_colegios.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombreColegio">Nombre del Colegio</label>
                            <input type="text" class="form-control" id="nombreColegio" name="nombreColegio" placeholder="Nombre del Colegio" required oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="totalEstudiantes">Total Estudiantes</label>
                            <input type="number" class="form-control" id="totalEstudiantes" name="totalEstudiantes" placeholder="Total Estudiantes" required >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tipoColegio">Tipo de Colegio</label>
                            <select class="form-control" id="tipoColegio" name="tipoColegio" required>
                                <option value="">SELECCIONA</option>
                                <option value="OFICIAL">OFICIAL</option>
                                <option value="NO OFICIAL">NO OFICIAL</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="logo">Logo (Subir imagen)</label>
                        <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estudiantesManana">Estudiantes Jornada Mañana</label>
                            <input type="number" class="form-control" id="estudiantes_manana" name="estudiantes_manana" placeholder="Estudiantes Jornada Mañana">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estudiantesTarde">Estudiantes Jornada Tarde</label>
                            <input type="number" class="form-control" id="estudiantes_tarde" name="estudiantes_tarde" placeholder="Estudiantes Jornada Tarde">
                        </div>
                    </div>   
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estudiantesCompleta">Estudiantes Jornada Completa</label>
                            <input type="number" class="form-control" id="estudiantes_completa" name="estudiantes_completa" placeholder="Estudiantes Jornada Completa">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="estudiantesNoche">Estudiantes Jornada Noche</label>
                            <input type="number" class="form-control" id="estudiantes_noche" name="estudiantes_noche" placeholder="Estudiantes Jornada Noche">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estudiantesSabatina">Estudiantes Jornada Sabatina</label>
                        <input type="number" class="form-control" id="estudiantes_sabatina" name="estudiantes_sabatina" placeholder="Estudiantes Jornada Sabatina">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" onclick="registrarColegio()">Registrar</button>
                </form>
            </div>
            <div class="modal-footer">
                
                <!-- <input type="submit" value="Enviar Datos" class="btn btn-primary"> -->

            </div>
        </div>
    </div>
</div>