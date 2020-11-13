<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="upload-form-view">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Subir Archivos</strong></div>
                        <div class="panel-body">

                            <!-- Standar Form -->
                            <h4>Seleccione Archivos desde el computador</h4>
                            <form action="/admin/recursos/subir" method="post" enctype="multipart/form-data">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="file" name="file" >
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Añadir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /container -->
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />
        <div class="row">
             <?= $mensaje ?>
        </div>
        <!--Galeria-->
        <div class="row ">
           
            <?= $galeria ?>
        </div>

        <!-- /. ROW  -->           
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

<!-- /. WRAPPER  -->